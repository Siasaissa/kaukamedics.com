<?php
// app/Http/Controllers/InvoiceController.php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\CompanySetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices
     */
    public function index(Request $request)
    {
        $query = Invoice::with('items')->orderBy('created_at', 'desc');

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply date filter
        if ($request->filled('date_filter')) {
            $dateFilter = $request->date_filter;
            switch ($dateFilter) {
                case 'today':
                    $query->whereDate('invoice_date', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('invoice_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('invoice_date', Carbon::now()->month)
                          ->whereYear('invoice_date', Carbon::now()->year);
                    break;
                case 'year':
                    $query->whereYear('invoice_date', Carbon::now()->year);
                    break;
            }
        }

        // Apply search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('invoice_number', 'LIKE', "%{$search}%")
                  ->orWhere('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('customer_phone', 'LIKE', "%{$search}%")
                  ->orWhere('reference', 'LIKE', "%{$search}%");
            });
        }

        $invoices = $query->paginate(15);

        // Calculate statistics
        $stats = [
            'total_invoices' => Invoice::count(),
            'total_amount' => Invoice::sum('grand_total'),
            'outstanding' => Invoice::sum('balance'),
            'paid_invoices' => Invoice::where('status', 'paid')->count(),
        ];

        return view('admin.invoice.index', compact('invoices', 'stats'));
    }

    /**
     * Show the form for creating a new invoice
     */
    public function create()
    {
        return view('admin.invoice.create');
    }

    /**
     * Store a newly created invoice
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'reference' => 'nullable|string|max:100',
            'shipping_charges' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'note' => 'nullable|string',
            'terms' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product' => 'required|string|max:255',
            'items.*.qty' => 'required|numeric|min:0.01',
            'items.*.rate' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Generate invoice number
            $lastInvoice = Invoice::latest('id')->first();
            $nextNumber = $lastInvoice ? $lastInvoice->id + 1 : 1;
            $invoiceNumber = 'INV-' . date('Y') . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            // Calculate subtotal
            $subtotal = collect($validated['items'])->sum(function($item) {
                return $item['qty'] * $item['rate'];
            });

            $shippingCharges = $validated['shipping_charges'] ?? 0;
            $taxRate = $validated['tax_rate'] ?? 0;
            $taxAmount = ($subtotal * $taxRate) / 100;
            $grandTotal = $subtotal + $taxAmount + $shippingCharges;

            // Determine status based on due date
            $status = 'pending';
            if (Carbon::parse($validated['due_date'])->isPast()) {
                $status = 'overdue';
            }

            // Create invoice
            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'customer_name' => $validated['customer_name'],
                'customer_address' => $validated['customer_address'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? null,
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'],
                'reference' => $validated['reference'] ?? null,
                'subtotal' => $subtotal,
                'shipping_charges' => $shippingCharges,
                'tax_rate' => $taxRate,
                'tax_amount' => $taxAmount,
                'grand_total' => $grandTotal,
                'balance' => $grandTotal,
                'paid_amount' => 0,
                'status' => $status,
                'note' => $validated['note'] ?? null,
                'terms' => $validated['terms'] ?? null,
            ]);

            // Create invoice items
            foreach ($validated['items'] as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product' => $item['product'],
                    'qty' => $item['qty'],
                    'rate' => $item['rate'],
                    'amount' => $item['qty'] * $item['rate'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.Invoice.index')
                ->with('success', 'Invoice created successfully! Invoice Number: ' . $invoiceNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to create invoice: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified invoice
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('items');
        $company = CompanySetting::first();
        
        return view('admin.invoice.show', compact('invoice', 'company'));
    }

    /**
     * Show the form for editing the specified invoice
     */
    public function edit(Invoice $invoice)
    {
        $invoice->load('items');
        return view('admin.invoice.edit', compact('invoice'));
    }

    /**
     * Update the specified invoice
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'reference' => 'nullable|string|max:100',
            'shipping_charges' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'note' => 'nullable|string',
            'terms' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product' => 'required|string|max:255',
            'items.*.qty' => 'required|numeric|min:0.01',
            'items.*.rate' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Calculate subtotal
            $subtotal = collect($validated['items'])->sum(function($item) {
                return $item['qty'] * $item['rate'];
            });

            $shippingCharges = $validated['shipping_charges'] ?? 0;
            $taxRate = $validated['tax_rate'] ?? 0;
            $taxAmount = ($subtotal * $taxRate) / 100;
            $grandTotal = $subtotal + $taxAmount + $shippingCharges;
            $balance = $grandTotal - $invoice->paid_amount;

            // Determine new status based on balance and due date
            $newStatus = 'pending';
            if ($balance <= 0) {
                $newStatus = 'paid';
            } elseif (Carbon::parse($validated['due_date'])->isPast() && $balance > 0) {
                $newStatus = 'overdue';
            }

            // Update invoice
            $invoice->update([
                'customer_name' => $validated['customer_name'],
                'customer_address' => $validated['customer_address'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? null,
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'],
                'reference' => $validated['reference'] ?? null,
                'subtotal' => $subtotal,
                'shipping_charges' => $shippingCharges,
                'tax_rate' => $taxRate,
                'tax_amount' => $taxAmount,
                'grand_total' => $grandTotal,
                'balance' => $balance,
                'status' => $newStatus,
                'note' => $validated['note'] ?? null,
                'terms' => $validated['terms'] ?? null,
            ]);

            // Delete old items and create new ones
            $invoice->items()->delete();
            foreach ($validated['items'] as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product' => $item['product'],
                    'qty' => $item['qty'],
                    'rate' => $item['rate'],
                    'amount' => $item['qty'] * $item['rate'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.Invoice.index')
                ->with('success', 'Invoice updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to update invoice: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified invoice
     */
    public function destroy(Invoice $invoice)
    {
        DB::beginTransaction();
        try {
            $invoiceNumber = $invoice->invoice_number;
            
            // Delete items first
            $invoice->items()->delete();
            
            // Delete invoice
            $invoice->delete();

            DB::commit();

            return redirect()->route('admin.Invoice.index')
                ->with('success', "Invoice {$invoiceNumber} deleted successfully!");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete invoice: ' . $e->getMessage());
        }
    }

    /**
     * Export invoice to PDF
     */
    public function print(Invoice $invoice)
    {
        $invoice->load('items');
        $company = CompanySetting::first();
        
        $data = [
            'invoice' => $invoice,
            'company' => $company,
            'banks' => $company ? json_decode($company->bank_details, true) : [],
            'terms' => $company && $company->payment_terms ? explode("\n", $company->payment_terms) : []
        ];

        $pdf = Pdf::loadView('admin.Invoice.pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        $filename = 'Invoice_' . $invoice->customer_name . '_' . date('Ymd') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Mark invoice as paid
     */
    public function markAsPaid(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . $invoice->balance,
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string',
            'payment_note' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $paidAmount = $invoice->paid_amount + $validated['amount'];
            $balance = $invoice->grand_total - $paidAmount;
            
            $invoice->update([
                'paid_amount' => $paidAmount,
                'balance' => $balance,
                'status' => $balance <= 0 ? 'paid' : 'pending',
                'payment_date' => $validated['payment_date'] ?? now(),
            ]);

            DB::commit();

            return back()->with('success', 'Payment of Tsh ' . number_format($validated['amount'], 2) . ' recorded successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to record payment: ' . $e->getMessage());
        }
    }

    /**
     * Update invoice status
     */
    public function updateStatus(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,overdue,cancelled',
        ]);

        $invoice->update(['status' => $validated['status']]);

        return back()->with('success', 'Invoice status updated to ' . ucfirst($validated['status']));
    }

    /**
     * Duplicate an invoice
     */
    public function duplicate(Invoice $invoice)
    {
        DB::beginTransaction();
        try {
            $lastInvoice = Invoice::latest('id')->first();
            $nextNumber = $lastInvoice->id + 1;
            $newInvoiceNumber = 'INV-' . date('Y') . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            // Create duplicate invoice
            $newInvoice = $invoice->replicate();
            $newInvoice->invoice_number = $newInvoiceNumber;
            $newInvoice->invoice_date = Carbon::today();
            $newInvoice->due_date = Carbon::today()->addDays(30);
            $newInvoice->status = 'pending';
            $newInvoice->paid_amount = 0;
            $newInvoice->balance = $newInvoice->grand_total;
            $newInvoice->save();

            // Duplicate items
            foreach ($invoice->items as $item) {
                $newItem = $item->replicate();
                $newItem->invoice_id = $newInvoice->id;
                $newItem->save();
            }

            DB::commit();

            return redirect()->route('admin.Invoice.edit', $newInvoice->id)
                ->with('success', 'Invoice duplicated successfully! New Invoice Number: ' . $newInvoiceNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to duplicate invoice: ' . $e->getMessage());
        }
    }
}
