<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 3px solid #FFCB05; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { color: #000; margin: 0; }
        .header .company { color: #666; }
        .info-section { margin-bottom: 30px; }
        .info-section h3 { color: #000; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th { background-color: #FFCB05; color: #000; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .total-row { font-weight: bold; font-size: 1.2em; }
        .footer { margin-top: 50px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 0.9em; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="background: #FFCB05; color: #000; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
            Print Invoice
        </button>
        <a href="{{ route('orders.show', $order) }}" style="margin-left: 10px; color: #0066cc;">← Back to Order</a>
    </div>

    <div class="header">
        <h1>INVOICE</h1>
        <p class="company"><strong>MTN Microsoft Store</strong></p>
        <p class="company">Cameroon</p>
    </div>

    <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
        <div class="info-section">
            <h3>Bill To:</h3>
            <p>
                <strong>{{ $order->customer->company_name }}</strong><br>
                {{ $order->customer->contact_name }}<br>
                {{ $order->customer->address }}<br>
                {{ $order->customer->city }}, {{ $order->customer->country }}<br>
                {{ $order->customer->email }}<br>
                {{ $order->customer->phone }}
            </p>
        </div>
        
        <div class="info-section" style="text-align: right;">
            <h3>Invoice Details:</h3>
            <p>
                <strong>Invoice #:</strong> {{ $order->order_number }}<br>
                <strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}<br>
                @if($order->paid_at)
                <strong>Paid:</strong> {{ $order->paid_at->format('F d, Y') }}<br>
                @endif
                <strong>Status:</strong> <span style="color: {{ $order->payment_status === 'paid' ? 'green' : 'orange' }}">{{ ucfirst($order->payment_status) }}</span>
            </p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 0) }} XAF</td>
                <td>{{ number_format($item->total_price, 0) }} XAF</td>
            </tr>
            @endforeach
            
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Subtotal:</strong></td>
                <td><strong>{{ number_format($order->subtotal, 0) }} XAF</strong></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Tax:</strong></td>
                <td><strong>{{ number_format($order->tax, 0) }} XAF</strong></td>
            </tr>
            <tr class="total-row" style="background-color: #FFF9E6;">
                <td colspan="3" style="text-align: right;">TOTAL:</td>
                <td>{{ number_format($order->total, 0) }} XAF</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
        <p>Thank you for your business!</p>
        <p style="font-size: 0.8em;">This is a computer-generated invoice. For questions, contact support@mtn.cm</p>
    </div>
</body>
</html>
