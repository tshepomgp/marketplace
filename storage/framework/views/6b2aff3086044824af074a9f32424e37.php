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
            <h1 class="text-3xl font-bold text-mtn-black mb-2">Order Successful!</h1>
            <p class="text-gray-600">Your order has been placed successfully</p>
        </div>
        
        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-lg font-bold text-mtn-black mb-4">Order Details</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Order Number:</span>
                    <span class="font-bold text-mtn-yellow"><?php echo e($order->order_number); ?></span>
                </div>
                
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Product:</span>
                    <span class="font-semibold"><?php echo e($product); ?></span>
                </div>
                
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Quantity:</span>
                    <span class="font-semibold"><?php echo e($order->quantity); ?></span>
                </div>
                
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="font-bold text-lg"><?php echo e(number_format($order->total, 0)); ?> XAF</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Order Date:</span>
                    <span class="font-semibold"><?php echo e($order->created_at->format('M d, Y H:i')); ?></span>
                </div>
            </div>
        </div>
        
        <!-- Next Steps -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <h3 class="font-bold text-blue-900 mb-3">What happens next?</h3>
            <ol class="text-blue-800 text-sm space-y-2">
                <li class="flex">
                    <span class="font-bold mr-2">1.</span>
                    <span>Check your email for confirmation and invoice</span>
                </li>
                <li class="flex">
                    <span class="font-bold mr-2">2.</span>
                    <span>Wait for payment processing (usually within 1 hour)</span>
                </li>
                <li class="flex">
                    <span class="font-bold mr-2">3.</span>
                    <span>Receive Microsoft tenant and admin credentials</span>
                </li>
                <li class="flex">
                    <span class="font-bold mr-2">4.</span>
                    <span>Start using your licenses immediately</span>
                </li>
            </ol>
        </div>
        
        <!-- Actions -->
        <div class="space-y-3">
            <a href="<?php echo e(route('customer.orders.show', $order)); ?>" 
               class="block w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition text-center">
                View Order Details
            </a>
            <a href="<?php echo e(route('customer.dashboard')); ?>" 
               class="block w-full bg-gray-200 text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                Back to Dashboard
            </a>
        </div>
        
        <!-- Support -->
        <div class="mt-8 text-center">
            <p class="text-gray-600 text-sm mb-2">Need help?</p>
            <a href="" class="text-mtn-yellow hover:text-mtn-orange font-semibold">
                Contact our support team →
            </a>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/orders/success.blade.php ENDPATH**/ ?>