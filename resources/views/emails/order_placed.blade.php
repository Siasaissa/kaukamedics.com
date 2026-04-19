<h2>New Order Received</h2>

<p><strong>Customer:</strong> {{ $order->name }}</p>
<p><strong>Email:</strong> {{ $order->email }}</p>
<p><strong>Phone:</strong> {{ $order->phone }}</p>
<p><strong>City:</strong> {{ $order->city }}</p>
<p><strong>Address:</strong> {{ $order->address }}</p>
<p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>

<h4>Order Details</h4>
<ul>
    @foreach($order->items as $item)
        <li>{{ $item['name'] }} — {{ $item['quantity'] }} × Tsh {{ number_format($item['price'],2) }}</li>
    @endforeach
</ul>

<p><strong>Total:</strong> Tsh {{ number_format($order->total,2) }}</p>
<p>Received at: {{ $order->created_at->format('d M Y, H:i A') }}</p>
