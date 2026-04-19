<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = (float) Order::sum('total');
        $totalProducts = Product::count();
        $recentOrders = Order::latest()->take(5)->get();

        $topProducts = Order::query()
            ->get()
            ->flatMap(fn ($order) => collect($order->items ?? []))
            ->groupBy('name')
            ->map(fn ($items, $name) => [
                'name' => $name,
                'total_sold' => $items->sum('quantity'),
                'total_earned' => $items->sum(fn ($item) => ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0))),
            ])
            ->sortByDesc('total_sold')
            ->take(5)
            ->values();

        $startMonth = now()->startOfMonth()->subMonths(5);
        $endMonth = now()->endOfMonth();

        $rawSalesData = Order::query()
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as sale_month, SUM(total) as total")
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->groupBy('sale_month')
            ->orderBy('sale_month')
            ->get()
            ->keyBy('sale_month');

        $salesMonths = [];
        $salesValues = [];

        for ($month = $startMonth->copy(); $month->lte($endMonth); $month->addMonth()) {
            $key = $month->format('Y-m');
            $salesMonths[] = $month->format('M Y');
            $salesValues[] = (float) optional($rawSalesData->get($key))->total ?: 0;
        }

        return view('dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'recentOrders',
            'topProducts',
            'salesMonths',
            'salesValues'
        ));
    }

}
