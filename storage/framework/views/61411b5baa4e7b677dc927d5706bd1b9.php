<?php $__env->startSection('title', 'Customer Details - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 min-h-screen">
    <div class="bg-mtn-black text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold"><?php echo e($customer->company_name); ?></h1>
                    <p class="text-gray-400">Customer Details</p>
                </div>
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="bg-white text-black px-4 py-2 rounded font-semibold hover:bg-gray-100">
                    ← Back to Customers
                </a>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Orders</p>
                <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total_orders']); ?></p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Active Licenses</p>
                <p class="text-3xl font-bold text-green-600"><?php echo e($stats['active_licenses']); ?></p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Spent</p>
                <p class="text-3xl font-bold text-gray-900"><?php echo e(number_format($stats['total_spent'], 0)); ?></p>
                <p class="text-xs text-gray-600">XAF</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Pending Orders</p>
                <p class="text-3xl font-bold text-yellow-600"><?php echo e($stats['pending_orders']); ?></p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Customer Information -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4">Company Information</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Company Name</p>
                            <p class="font-semibold"><?php echo e($customer->company_name); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Contact Person</p>
                            <p class="font-semibold"><?php echo e($customer->contact_name); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-semibold"><?php echo e($customer->email); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Phone</p>
                            <p class="font-semibold"><?php echo e($customer->phone); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Address</p>
                            <p class="font-semibold"><?php echo e($customer->address); ?></p>
                            <p class="font-semibold"><?php echo e($customer->city); ?>, <?php echo e($customer->country); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold <?php echo e($customer->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                                <?php echo e(ucfirst($customer->status)); ?>

                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Registered</p>
                            <p class="font-semibold"><?php echo e($customer->created_at->format('M d, Y')); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold mb-4">Microsoft Tenant</h3>
                    <?php if($customer->domain): ?>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Tenant Domain</p>
                            <p class="font-mono bg-gray-100 px-3 py-2 rounded"><?php echo e($customer->domain); ?></p>
                        </div>
                        <?php if($customer->tenant_id): ?>
                        <div>
                            <p class="text-sm text-gray-600">Tenant ID</p>
                            <p class="font-mono text-xs bg-gray-100 px-3 py-2 rounded break-all"><?php echo e($customer->tenant_id); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if($customer->microsoft_customer_id): ?>
                        <div>
                            <p class="text-sm text-gray-600">Microsoft Customer ID</p>
                            <p class="font-mono text-xs bg-gray-100 px-3 py-2 rounded break-all"><?php echo e($customer->microsoft_customer_id); ?></p>
                        </div>
                        <?php endif; ?>
                        <a href="https://admin.microsoft.com" target="_blank" class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700">
                            Open Admin Center
                        </a>
                    </div>
                    <?php else: ?>
                    <p class="text-gray-600">No tenant configured</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Orders and Licenses -->
            <div class="lg:col-span-2">
                <!-- Active Licenses -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">Active Licenses</h3>
                        <a href="<?php echo e(route('admin.customers.licenses', $customer)); ?>" class="text-blue-600 hover:text-blue-800 font-semibold">
                            View All →
                        </a>
                    </div>
                    <?php if($customer->subscriptions->where('status', 'active')->count() > 0): ?>
                    <div class="space-y-3">
                        <?php $__currentLoopData = $customer->subscriptions->where('status', 'active')->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                            <div>
                                <p class="font-semibold"><?php echo e($subscription->product->name); ?></p>
                                <p class="text-sm text-gray-600"><?php echo e($subscription->quantity); ?> licenses</p>
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                Active
                            </span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php else: ?>
                    <p class="text-gray-600">No active licenses</p>
                    <?php endif; ?>
                </div>
                
                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">Recent Orders</h3>
                        <a href="<?php echo e(route('admin.orders.vm', $customer)); ?>" class="text-blue-600 hover:text-blue-800 font-semibold">
                            View All →
                        </a>
                    </div>
                    <?php if($customer->orders->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <?php $__currentLoopData = $customer->orders->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-4 py-3 text-sm"><?php echo e($order->order_number); ?></td>
                                    <td class="px-4 py-3 text-sm"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                                    <td class="px-4 py-3 text-sm font-semibold"><?php echo e(number_format($order->total, 0)); ?> XAF</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold <?php echo e($order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                            <?php echo e(ucfirst($order->payment_status)); ?>

                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <p class="text-gray-600">No orders yet</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/admin/customers/show.blade.php ENDPATH**/ ?>