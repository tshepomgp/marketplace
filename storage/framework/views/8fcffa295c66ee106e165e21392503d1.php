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
        <li><strong>Order Number:</strong> <?php echo e($order->order_number); ?></li>
        <li><strong>Customer:</strong> <?php echo e($order->user->name); ?> (<?php echo e($order->user->email); ?>)</li>
        <li><strong>Organization:</strong> <?php echo e($order->order_data['organization_name'] ?? '-'); ?></li>
        <li><strong>Product:</strong> <?php echo e($orderItem->product_name); ?></li>
        <li><strong>Quantity:</strong> <?php echo e($orderItem->quantity); ?></li>
        <li><strong>Total Amount:</strong> <?php echo e(number_format($orderItem->total_price, 2)); ?> XAF</li>
        <li><strong>Special Requirements:</strong> <?php echo e($order->order_data['special_requirements'] ?? '-'); ?></li>
    </ul>
</body>
</html>
<?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/emails/new-vm-order.blade.php ENDPATH**/ ?>