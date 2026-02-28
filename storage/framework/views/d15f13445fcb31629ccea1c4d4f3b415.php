

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h2 class="text-4xl font-bold text-mtn-black mb-2">Welcome, <?php echo e(Auth::user()->name); ?>!</h2>
    <p class="text-gray-600">Manage your Microsoft licenses and cloud storage</p>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Active Licenses</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">0</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2H2a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2V5a1 1 0 100 2 1 1 0 011 1v9a1 1 0 001 1h1a1 1 0 100-2h-.5a2 2 0 01-2-2V4zm3 4a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Storage Allocated</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">0 TB</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Orders</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">0</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                    <path d="M16 16a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                    <path d="M6.5 17.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Monthly Spend</p>
                <p class="text-3xl font-bold text-mtn-yellow mt-2">0 XAF</p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.16 2.75a.75.75 0 00-1.08.6v.26h-.5A2.75 2.75 0 003.75 6.16v7.68A2.75 2.75 0 006.5 16.59h7a2.75 2.75 0 002.75-2.75V6.16a2.75 2.75 0 00-2.75-2.75h-.5V3.35a.75.75 0 00-1.5 0v.26H8.16V2.75z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <a href="<?php echo e(route('customer.products.licence-ordering')); ?>" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-mtn-black">Order Microsoft Licenses</h3>
            <svg class="w-6 h-6 text-mtn-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <p class="text-gray-600 text-sm">Browse and purchase Microsoft 365, Office 365, and other licenses</p>
    </a>

     <a href="<?php echo e(route('customer.products.vm-ordering')); ?>" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-mtn-black">Order Virtual Machine</h3>
            <svg class="w-6 h-6 text-mtn-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
        </div>
        <p class="text-gray-600 text-sm">Get Virtual machine - choose you OS, Size etc</p>
    </a>

    <a href="<?php echo e(route('customer.products.storage-ordering')); ?>" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-mtn-black">Order Storage</h3>
            <svg class="w-6 h-6 text-mtn-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
        </div>
        <p class="text-gray-600 text-sm">Get cloud storage plans with automatic backups and geo-redundancy</p>
    </a>

    <a href="#" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-mtn-black">Manage Orders</h3>
            <svg class="w-6 h-6 text-mtn-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-gray-600 text-sm">View, track, and manage all your active orders and subscriptions</p>
    </a>
</div>

<!-- RecAent Orders -->
<!-- MS Licences Orders -->
    <div class="bg-white rounded-lg shadow p-6">
       <!-- Recent Orders -->
        <?php if($recentOrders->count() > 0): ?>
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold">Recent Microsoft Licences and VM Orders</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4"><?php echo e($order->order_number); ?></td>
                            <td class="px-6 py-4"><?php echo e($order->user->company_name); ?></td>
                                                       <td class="px-6 py-4">
    <?php
        $item = $order->orderItems->first();
        
    ?>

    <?php if($item && !str_contains($item->product_name, 'Microsoft')): ?>
        <a href="<?php echo e(route('customer.vm.control', $order->id)); ?>" 
           class="text-blue-600 hover:underline">
           <?php echo e($item->product_name); ?>

        </a>
    <?php else: ?>
        <?php echo e($item->product_name ?? '-'); ?>

    <?php endif; ?>
</td>
                            <td class="px-6 py-4 font-semibold"><?php echo e(optional($order->orderItems->first())->unit_price * optional($order->orderItems->first())->quantity ?? '-'); ?> XAF</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded <?php echo e($order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                    <?php echo e(ucfirst($order->payment_status)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- VM Orders -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-mtn-black mb-4">Recent VM Orders</h3>
        
        <?php if(count($vmOrders) > 0): ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $vmOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                        <div>
                            <p class="font-semibold text-sm"></p>
                            <p class="text-xs text-gray-500"><?php echo e($order->order_number); ?></p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                </svg>
                <p class="text-gray-500 mb-3">No VM orders yet</p>
                <a href="<?php echo e(route('customer.products.vm-ordering')); ?>" class="inline-block bg-mtn-yellow text-black px-4 py-2 rounded-lg font-semibold hover:bg-mtn-orange transition">
                    Order Now
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Storage Orders -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-mtn-black mb-4">Recent Storage Orders</h3>
        
        <?php if(count($storageOrders) > 0): ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $storageOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                        <div>
                            <p class="font-semibold text-sm"><?php echo e($order->storage_size); ?> TB - <?php echo e(ucfirst($order->storage_type)); ?></p>
                            <p class="text-xs text-gray-500"><?php echo e($order->order_number); ?></p>
                            <p class="text-xs text-gray-500"><?php echo e($order->monthly_cost); ?> XAF</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
                <p class="text-gray-500 mb-3">No storage orders yet</p>
                <a href="<?php echo e(route('customer.products.storage-ordering')); ?>" class="inline-block bg-mtn-yellow text-black px-4 py-2 rounded-lg font-semibold hover:bg-mtn-orange transition">
                    Order Now
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>