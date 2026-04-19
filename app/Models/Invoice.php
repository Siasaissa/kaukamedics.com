<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_address',
        'customer_phone',
        'customer_email',
        'invoice_date',
        'due_date',
        'reference',
        'subtotal',
        'shipping_charges',
        'tax_rate',
        'tax_amount',
        'grand_total',
        'balance',
        'paid_amount',
        'status',
        'note',
        'terms',
        'payment_date',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'payment_date' => 'datetime',
        'subtotal' => 'decimal:2',
        'shipping_charges' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'balance' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    /**
     * Get the items for the invoice
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Update invoice status based on payment and due date
     */
    public function updateStatus()
    {
        if ($this->balance <= 0) {
            $this->status = 'paid';
        } elseif ($this->due_date->isPast() && $this->balance > 0) {
            $this->status = 'overdue';
        } elseif ($this->status === 'cancelled') {
            // Keep cancelled status
            $this->status = 'cancelled';
        } else {
            $this->status = 'pending';
        }
        
        $this->save();
    }

    /**
     * Check if invoice is overdue
     */
    public function isOverdue()
    {
        return $this->due_date->isPast() && $this->balance > 0 && $this->status !== 'paid';
    }

    /**
     * Get formatted grand total
     */
    public function getFormattedGrandTotalAttribute()
    {
        return 'Tsh ' . number_format($this->grand_total, 2);
    }

    /**
     * Get formatted balance
     */
    public function getFormattedBalanceAttribute()
    {
        return 'Tsh ' . number_format($this->balance, 2);
    }

    /**
     * Get formatted paid amount
     */
    public function getFormattedPaidAmountAttribute()
    {
        return 'Tsh ' . number_format($this->paid_amount, 2);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'paid' => 'success',
            'pending' => 'warning',
            'overdue' => 'danger',
            'cancelled' => 'secondary',
            default => 'info'
        };
    }

    /**
     * Get days until due or days overdue
     */
    public function getDaysUntilDueAttribute()
    {
        if ($this->status === 'paid') {
            return null;
        }

        $now = Carbon::now();
        $dueDate = Carbon::parse($this->due_date);
        
        if ($dueDate->isFuture()) {
            $days = $now->diffInDays($dueDate);
            return "Due in {$days} days";
        } else {
            $days = $dueDate->diffInDays($now);
            return "Overdue by {$days} days";
        }
    }

    /**
     * Scope to get paid invoices
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Scope to get pending invoices
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get overdue invoices
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('invoice_date', [$startDate, $endDate]);
    }

    /**
     * Calculate payment percentage
     */
    public function getPaymentPercentageAttribute()
    {
        if ($this->grand_total <= 0) {
            return 0;
        }
        
        return round(($this->paid_amount / $this->grand_total) * 100, 2);
    }

    /**
     * Check if invoice is fully paid
     */
    public function isFullyPaid()
    {
        return $this->balance <= 0;
    }

    /**
     * Check if invoice is partially paid
     */
    public function isPartiallyPaid()
    {
        return $this->paid_amount > 0 && $this->balance > 0;
    }

    /**
     * Get invoice age in days
     */
    public function getAgeInDaysAttribute()
    {
        return $this->invoice_date->diffInDays(Carbon::now());
    }

    /**
     * Auto-update status on save - FIXED VERSION
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($invoice) {
            // Only auto-update status if balance, due_date, or paid_amount changed
            // AND status is not being manually set
            if ($invoice->isDirty(['balance', 'due_date', 'paid_amount']) && !$invoice->isDirty('status')) {
                if ($invoice->balance <= 0) {
                    $invoice->status = 'paid';
                } elseif ($invoice->due_date instanceof Carbon && $invoice->due_date->isPast() && $invoice->balance > 0) {
                    $invoice->status = 'overdue';
                } elseif (is_string($invoice->due_date) && Carbon::parse($invoice->due_date)->isPast() && $invoice->balance > 0) {
                    $invoice->status = 'overdue';
                } elseif ($invoice->status !== 'cancelled') {
                    $invoice->status = 'pending';
                }
            }
        });
    }
}