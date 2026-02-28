<!DOCTYPE html>
<html>
<head>
    <title>New VM Order</title>
</head>
<body>
    <h2>New VM Order Placed</h2>
    <p>A new VM order has been placed by a customer for MTN Cameroon.</p>

    <h3>Order Details:</h3>
    <ul>
        <li><strong>Order Number:</strong> {{ $order->order_number }}</li>
        <li><strong>Customer:</strong> {{ $order->user->name }} ({{ $order->user->email }})</li>
        <li><strong>Organization:</strong> {{ $order->order_data['organization_name'] ?? '-' }}</li>
        <li><strong>Product:</strong> {{ $orderItem->product_name }}</li>
        <li><strong>Quantity:</strong> {{ $orderItem->quantity }}</li>
        <li><strong>Total Amount:</strong> {{ number_format($orderItem->total_price, 2) }} XAF</li>
        <li><strong>Special Requirements:</strong> {{ $order->order_data['special_requirements'] ?? '-' }}</li>
    </ul>
</body>
</html>
