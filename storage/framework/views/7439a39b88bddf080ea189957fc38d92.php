<?php $__env->startSection('title', 'Shopping Cart'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Shopping Cart</h1>
    <p class="text-gray-600">Review items before checkout</p>
</div>

<?php if(session('success')): ?>
<div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="mb-8 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>

<?php $cart = session()->get('cart', []); ?>


<?php if(!empty($cart) && count($cart) > 0): ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b-2 border-gray-300">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Product</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Quantity</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Unit Price</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Total</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $subtotal = 0; ?>
                            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productId => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $itemTotal = $item['price'] * $item['quantity']; $subtotal += $itemTotal; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-6">
                                    <div>
                                        <p class="font-semibold text-gray-900"><?php echo e($item['name']); ?></p>
                                        <p class="text-sm text-gray-500">Product ID: <?php echo e($productId); ?></p>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <form action="<?php echo e(route('cart.update')); ?>" method="POST" class="flex items-center justify-center">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="product_id" value="<?php echo e($productId); ?>">
                                        <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1" max="100" 
                                               class="w-20 px-3 py-2 border border-gray-300 rounded text-center text-sm"
                                               onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="px-6 py-6 text-right text-gray-900 font-semibold">
                                    <?php echo e(number_format($item['price'], 0)); ?><br>
                                    <span class="text-xs text-gray-500"><?php echo e($item['currency'] ?? 'XAF'); ?></span>
                                </td>
                                <td class="px-6 py-6 text-right">
                                    <p class="text-lg font-bold text-mtn-yellow">
                                        <?php echo e(number_format($itemTotal, 0)); ?>

                                    </p>
                                    <p class="text-xs text-gray-500"><?php echo e($item['currency'] ?? 'XAF'); ?></p>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <form action="<?php echo e(route('cart.remove')); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="product_id" value="<?php echo e($productId); ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm px-3 py-1 hover:bg-red-100 rounded transition">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Continue Shopping -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <a href="<?php echo e(route('customer.products.licence-ordering')); ?>" class="inline-flex items-center text-mtn-yellow hover:text-mtn-orange font-semibold transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-8 sticky top-24">
                <h2 class="text-2xl font-bold text-mtn-black mb-6">Order Summary</h2>
                
                <!-- Items Count -->
                <div class="flex justify-between mb-4">
                    <span class="text-gray-700">Items (<span class="font-semibold"><?php echo e(count($cart)); ?></span>):</span>
                </div>
                
                <!-- Subtotal -->
                <div class="flex justify-between mb-2">
                    <span class="text-gray-700">Subtotal:</span>
                    <span class="font-semibold"><?php echo e(number_format($total, 0)); ?> XAF</span>
                </div>
                
                <!-- Shipping -->
                <div class="flex justify-between mb-2">
                    <span class="text-gray-700">Shipping:</span>
                    <span class="font-semibold">Free</span>
                </div>
                
                <!-- Tax -->
                <div class="flex justify-between mb-4 pb-4 border-b-2 border-gray-200">
                    <span class="text-gray-700">Tax:</span>
                    <span class="font-semibold">0 XAF</span>
                </div>
                
                <!-- Total -->
                <div class="flex justify-between mb-8">
                    <span class="text-xl font-bold text-mtn-black">Total:</span>
                    <span class="text-3xl font-bold text-mtn-yellow"><?php echo e(number_format($total, 0)); ?> XAF</span>
                </div>
                
                <!-- Checkout Button -->
                <a href="<?php echo e(route('checkout.index')); ?>" class="block w-full bg-mtn-yellow text-black text-center py-4 rounded-lg font-bold text-lg hover:bg-mtn-orange transition mb-3">
                    Proceed to Checkout
                </a>
                
                <!-- Continue Shopping Button -->
                <a href="<?php echo e(route('customer.products.licence-ordering')); ?>" class="block w-full bg-gray-300 text-black text-center py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                    Continue Shopping
                </a>
                
                <!-- Trust Badges -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-xs text-gray-600 text-center mb-4">We're committed to your security</p>
                    <div class="flex justify-center space-x-4">
                        <div class="text-center">
                            <svg class="w-6 h-6 text-green-600 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs text-gray-600 mt-1">Secure</p>
                        </div>
                        <div class="text-center">
                            <svg class="w-6 h-6 text-green-600 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs text-gray-600 mt-1">Support</p>
                        </div>
                        <div class="text-center">
                            <svg class="w-6 h-6 text-green-600 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                            <p class="text-xs text-gray-600 mt-1">Verified</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <!-- Empty Cart -->
    <div class="bg-white rounded-lg shadow-lg p-20 text-center">
        <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
            <path d="M16 16a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
            <path d="M6.5 17.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
        </svg>
        
        <h2 class="text-4xl font-bold text-mtn-black mb-2">Your Cart is Empty</h2>
        <p class="text-gray-600 text-lg mb-8">Start shopping to add items to your cart</p>
        
        <a href="<?php echo e(route('customer.products.licence-ordering')); ?>" class="inline-block bg-mtn-yellow text-black px-8 py-4 rounded-lg font-bold text-lg hover:bg-mtn-orange transition">
            Start Shopping
        </a>
    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/cart/index.blade.php ENDPATH**/ ?>