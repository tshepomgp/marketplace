<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full">
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-mtn-black mb-2">Storage Order Confirmed!</h1>
            <p class="text-gray-600">Your cloud storage has been provisioned</p>
        </div>
        
        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-lg font-bold text-mtn-black mb-4">Storage Details</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Order Number:</span>
                    <span class="font-bold text-mtn-yellow"><?php echo e($order->order_number); ?></span>
                </div>
                
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Plan:</span>
                    <span class="font-semibold capitalize"><?php echo e(str_replace('_', ' ', $order->storage_type)); ?></span>
                </div>
                
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Storage Size:</span>
                    <span class="font-semibold"><?php echo e($order->storage_size); ?> TB</span>
                </div>
                
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Monthly Cost:</span>
                    <span class="font-bold text-lg"><?php echo e(number_format($order->monthly_cost, 0)); ?> XAF</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Renewal Date:</span>
                    <span class="font-semibold">  <?php echo e(optional($order->renewal_date)->format('M d, Y') ?? 'N/A'); ?></span>
                    
                </div>
            </div>
        </div>
        
        <!-- Access Information -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
            <h3 class="font-bold text-green-900 mb-3">✓ Storage is Ready!</h3>
            <p class="text-green-800 text-sm mb-3">Your cloud storage is now active and ready to use.</p>
            
            <div class="bg-white rounded p-3 text-sm">
                <p class="text-gray-600 mb-1">Access Details:</p>
                <p class="font-mono text-mtn-yellow"><?php echo e($order->access_endpoint); ?></p>
                <p class="text-gray-600 text-xs mt-2">Credentials sent to your email</p>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="space-y-3">
            <a href="<?php echo e(route('customer.dashboard')); ?>" 
               class="block w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition text-center">
                Access Storage Dashboard
            </a>
            <a href="<?php echo e(route('customer.orders.show', $order)); ?>" 
               class="block w-full bg-gray-200 text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                View Order Details
            </a>
            <a href="<?php echo e(route('customer.dashboard')); ?>" 
               class="block w-full bg-gray-100 text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition text-center">
                Back to Dashboard
            </a>
        </div>
        
        <!-- Documentation -->
        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-sm mb-3">📚 Quick Start Resources:</p>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="text-mtn-yellow hover:text-mtn-orange text-sm">
                        Getting Started Guide →
                    </a>
                </li>
                <li>
                    <a href="#" class="text-mtn-yellow hover:text-mtn-orange text-sm">
                        Security Best Practices →
                    </a>
                </li>
                <li>
                    <a href="" class="text-mtn-yellow hover:text-mtn-orange text-sm">
                        Contact Support →
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/orders/storage-success.blade.php ENDPATH**/ ?>