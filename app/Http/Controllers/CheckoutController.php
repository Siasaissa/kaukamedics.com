<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderPlacedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('checkout', compact('cart'));
    }

    public function process(Request $request)
{
    $cart = session('cart', []);
    if (empty($cart)) {
        return back()->with('error', 'Your cart is empty.');
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'city' => 'required|string|max:255',
        'address' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

    $order = \App\Models\Order::create([
        ...$validated,
        'total' => $total,
        'items' => $cart,
    ]);

    // Notify admin by email
    \Mail::to('info@kaukamedics.com')->send(new \App\Mail\OrderPlacedMail($order));

    // Clear cart after order
    session()->forget('cart');

    // Return back with payment data to trigger popup
    return back()->with([
        'success' => 'Order placed successfully!',
        'show_instructions' => true,
        'payment_method' => $validated['payment_method'],
        'total' => $total,
    ]);
}

//for mobile
public function getCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        return response()->json([
            'success' => true,
            'data' => $cart
        ]);
    }

    // --- Process checkout ---
   public function apiProcess(Request $request)
{
    // Get cart from session (or from request)
    $cart = $request->input('cart', session('cart', []));
    if (empty($cart)) {
        return response()->json([
            'success' => false,
            'message' => 'Your cart is empty.'
        ], 400);
    }

    // Validate request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'city' => 'required|string|max:255',
        'address' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    // Calculate total
    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

    // Create order
    $order = \App\Models\Order::create([
        ...$validated,
        'total' => $total,
        'items' => $cart,
    ]);

    // Send email to admin (optional, will not break API)
    try {
        \Mail::to('info@kaukamedics.com')->send(new \App\Mail\OrderPlacedMail($order));
    } catch (\Exception $e) {
        // Log email errors but don't fail API
        \Log::error('Failed to send order email: '.$e->getMessage());
    }

    // Clear session cart if exists
    if ($request->hasSession()) {
        $request->session()->forget('cart');
    }

    // Return JSON for API
    return response()->json([
        'success' => true,
        'message' => 'Order placed successfully!',
        'order' => $order,
        'total' => $total,
        'payment_method' => $validated['payment_method'],
    ]);
}

}
