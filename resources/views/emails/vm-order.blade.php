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
            <h1>New VM Order Received</h1>
        </div>
        
        <div class="content">
            <h2>Order Details</h2>
            
            <div class="details">
                <table>
                    <tr>
                        <td class="label">Order Number:</td>
                        <td>{{ $vmOrder->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Customer:</td>
                        <td>{{ $vmOrder->customer->company_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Contact:</td>
                        <td>{{ $vmOrder->customer->contact_name }}<br>{{ $vmOrder->customer->email }}<br>{{ $vmOrder->customer->phone }}</td>
                    </tr>
                </table>
            </div>
            
            <h3>VM Specifications</h3>
            <div class="details">
                <table>
                    <tr>
                        <td class="label">VM SKU:</td>
                        <td>{{ $vmOrder->vmSku->name }}</td>
                    </tr>
                    <tr>
                        <td class="label">vCPUs:</td>
                        <td>{{ $vmOrder->vmSku->vcpus }}</td>
                    </tr>
                    <tr>
                        <td class="label">RAM:</td>
                        <td>{{ $vmOrder->vmSku->ram_gb }} GB</td>
                    </tr>
                    <tr>
                        <td class="label">Operating System:</td>
                        <td>{{ $vmOrder->operatingSystem->name }} {{ $vmOrder->operatingSystem->version }}</td>
                    </tr>
                    <tr>
                        <td class="label">Disk Size:</td>
                        <td>{{ $vmOrder->disk_size_gb }} GB</td>
                    </tr>
                    <tr>
                        <td class="label">Quantity:</td>
                        <td>{{ $vmOrder->quantity }}</td>
                    </tr>
                    @if($vmOrder->vm_name)
                    <tr>
                        <td class="label">VM Name:</td>
                        <td>{{ $vmOrder->vm_name }}</td>
                    </tr>
                    @endif
                    @if($vmOrder->notes)
                    <tr>
                        <td class="label">Notes:</td>
                        <td>{{ $vmOrder->notes }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            
            <h3>Pricing</h3>
            <div class="details">
                <table>
                    <tr>
                        <td class="label">Monthly Cost:</td>
                        <td><strong>{{ number_format($vmOrder->monthly_cost, 0) }} {{ $vmOrder->currency }}</strong></td>
                    </tr>
                    @if($vmOrder->setup_fee > 0)
                    <tr>
                        <td class="label">Setup Fee:</td>
                        <td>{{ number_format($vmOrder->setup_fee, 0) }} {{ $vmOrder->currency }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            
            <p style="margin-top: 20px;">
                <strong>Action Required:</strong> Please review and provision this VM order.
            </p>
        </div>
        
        <div class="footer">
            <p>MTN Cameroon Azure HCI<br>This is an automated notification</p>
        </div>
    </div>
</body>
</html>
