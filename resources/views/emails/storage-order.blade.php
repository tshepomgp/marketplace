<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #FFCB05; color: #000; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; margin-top: 20px; }
        .details { background: #fff; padding: 15px; margin: 10px 0; border-left: 4px solid #FFCB05; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .label { font-weight: bold; width: 40%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Storage Order Received</h1>
        </div>
        
        <div class="content">
            <h2>Order Details</h2>
            
            <div class="details">
                <table>
                    <tr>
                        <td class="label">Order Number:</td>
                        <td>{{ $storageOrder->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Customer:</td>
                        <td>{{ $storageOrder->user->company_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Contact:</td>
                        <td>{{ $storageOrder->user->contact_name }}<br>{{ $storageOrder->user->email }}<br>{{ $storageOrder->user->phone }}</td>
                    </tr>
                </table>
            </div>
            
            <h3>Storage Specifications</h3>
            <div class="details">
                <table>
                    <tr>
                        <td class="label">Storage Type:</td>
                        <td>{{ $storageOrder->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Type:</td>
                        <td>{{ $storageOrder->storage_type }}</td>
                    </tr>
                    <tr>
                        <td class="label">Size:</td>
                        <td>{{ $storageOrder->size }} GB</td>
                    </tr>
                    <tr>
                        <td class="label">Billing Cycle:</td>
                        <td>{{ $storageOrder->billing_cycle }}</td>
                    </tr>
                    @if($storageOrder->storage_name)
                    <tr>
                        <td class="label">Storage Name:</td>
                        <td>{{ $storageOrder->storage_type }}</td>
                    </tr>
                    @endif
                    @if($storageOrder->notes)
                    <tr>
                        <td class="label">Notes:</td>
                        <td>{{ $storageOrder->special_requirements }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            
            <h3>Pricing</h3>
            <div class="details">
                <table>
                    <tr>
                        <td class="label">Monthly Cost:</td>
                        <td><strong>{{ number_format($storageOrder->monthly_cost, 0) }} {{ $storageOrder->currency }}</strong></td>
                    </tr>
                </table>
            </div>
            
            <p style="margin-top: 20px;">
                <strong>Action Required:</strong> Please review and provision this storage order.
            </p>
        </div>
        
        <div class="footer">
            <p>MTN Cameroon Azure HCI<br>This is an automated notification</p>
        </div>
    </div>
</body>
</html>
