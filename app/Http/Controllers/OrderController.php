<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id','Desc')->paginate(3);
        return view('admin.orders.index', compact('orders'));
    }
        public function show(Order $order)
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.show', compact('order'));
    }

    // Delete an order
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
