<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
public function index()
{
    $customers = Order::select('email', DB::raw('COUNT(*) as orders_count'))
        ->groupBy('email')
        ->orderByDesc('orders_count')
        ->paginate(10); // Show 10 customers per page

    return view('admin.customers.index', compact('customers'));
}
}