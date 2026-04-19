<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id','Desc')->paginate(3);
        return view('admin.Report.index', compact('orders'));
    }

   public function download(Request $request)
{
    $from = $request->input('from');
    $to = $request->input('to');

    $orders = Order::when($from && $to, function($query) use ($from, $to) {
        $query->whereDate('created_at', '>=', $from)
              ->whereDate('created_at', '<=', $to);
    })->get();

    $filename = 'orders-report-' . now()->format('Y-m-d_H-i-s') . '.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $columns = ['ID', 'Customer', 'Phone', 'Items', 'Total', 'Status', 'Created At'];

    $callback = function() use ($orders, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($orders as $order) {
            fputcsv($file, [
                $order->id,
                $order->name,
                $order->phone,
                !empty($order->items) ? collect($order->items)->pluck('name')->join(', ') : 'N/A',
                number_format($order->total, 2),
                ucfirst($order->status),
                $order->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}


}
