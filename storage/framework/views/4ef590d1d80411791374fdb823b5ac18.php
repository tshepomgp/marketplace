<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Checkout</h1>
    <p class="text-gray-600">Review your cart and complete your order</p>
</div>
<?php if(session('error')): ?>
    <div class="bg-red-500 text-white p-3 rounded mb-3">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Cart Items (Left Side - 2 columns) -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-mtn-black mb-6">Order Summary</h2>
            
            <?php if(!empty($cart) && count($cart) > 0): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b-2 border-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Quantity</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Unit Price</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Total</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $subtotal = 0; ?>
                            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productId => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $itemTotal = $item['price'] * $item['quantity']; $subtotal += $itemTotal; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4">
                                    <p class="font-semibold text-gray-800"><?php echo e($item['name']); ?></p>
                                    <p class="text-sm text-gray-500">Product ID: <?php echo e($productId); ?></p>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <form action="<?php echo e(route('cart.update')); ?>" method="POST" class="flex items-center justify-center space-x-2">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="product_id" value="<?php echo e($productId); ?>">
                                        <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1" max="100" 
                                               class="w-16 px-2 py-1 border border-gray-300 rounded text-center"
                                               onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <?php echo e(number_format($item['price'], 0)); ?> <?php echo e($item['currency'] ?? 'XAF'); ?>

                                </td>
                                <td class="px-4 py-4 text-right font-semibold text-mtn-yellow">
                                    <?php echo e(number_format($itemTotal, 0)); ?> <?php echo e($item['currency'] ?? 'XAF'); ?>

                                </td>
                                <td class="px-4 py-4 text-center">
                                    <form action="<?php echo e(route('cart.remove')); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="product_id" value="<?php echo e($productId); ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">
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
                <div class="mt-6">
                    <a href="<?php echo e(route('customer.products.licence-ordering')); ?>" class="text-mtn-yellow hover:text-mtn-orange font-semibold">
                        ← Continue Shopping
                    </a>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-600 mb-4">Your cart is empty</p>
                    <a href="<?php echo e(route('customer.products.licence-ordering')); ?>" class="inline-block bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                        Start Shopping
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Checkout Form (Right Side) -->
    <?php if(!empty($cart) && count($cart) > 0): ?>
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-lg p-8 sticky top-24">
            <h2 class="text-xl font-bold text-mtn-black mb-6">Billing Details</h2>
            
            <form method="POST" action="<?php echo e(route('checkout.process')); ?>" id="checkoutForm">
                <?php echo csrf_field(); ?>
                
                <!-- Subtotal -->
                <div class="flex justify-between mb-4">
                    <span class="text-gray-700">Subtotal:</span>
                    <span class="font-semibold"><?php echo e(number_format($total, 0)); ?> XAF</span>
                </div>
                
                <!-- Tax (optional) -->
                <div class="flex justify-between mb-4 pb-4 border-b-2 border-gray-200">
                    <span class="text-gray-700">Tax:</span>
                    <span class="font-semibold">0 XAF</span>
                </div>
                
                <!-- Total -->
                <div class="flex justify-between mb-6">
                    <span class="text-xl font-bold text-mtn-black">Total:</span>
                    <span class="text-2xl font-bold text-mtn-yellow"><?php echo e(number_format($total, 0)); ?> XAF</span>
                </div>
                
                <hr class="mb-6">
                
                <!-- Contact Information -->
                <h3 class="text-lg font-bold text-mtn-black mb-4">Contact Information</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Company Name *</label>
                    <input type="text" name="company_name" value="<?php echo e(Auth::user()->company_name); ?>" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Contact Name *</label>
                    <input type="text" name="contact_name" value="<?php echo e(Auth::user()->name); ?>" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <?php $__errorArgs = ['contact_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                    <input type="email" name="email" value="<?php echo e(Auth::user()->email); ?>" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                    <input type="tel" name="phone" value="<?php echo e(Auth::user()->phone); ?>" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Address *</label>
                    <input type="text" name="address" placeholder="Street address" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">City *</label>
                    <input type="text" name="city" placeholder="City name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Country *</label>
                    <input type="text" name="country" placeholder="Country name" value="Cameroon" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <hr class="mb-6">
                
                <!-- Microsoft Tenant Type -->
                <h3 class="text-lg font-bold text-mtn-black mb-4">Microsoft Tenant</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tenant Type *</label>
                    <select name="tenant_type" id="tenant_type" required onchange="toggleExistingTenantId()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                        <option value="">Select Tenant Type</option>
                        <option value="new">New Tenant</option>
                        <option value="existing">Existing Tenant</option>
                    </select>
                    <?php $__errorArgs = ['tenant_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div id="existingTenantField" class="mb-6 hidden">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Existing Tenant ID</label>
                    <input type="text" name="existing_tenant_id" placeholder="Enter your tenant ID"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <?php $__errorArgs = ['existing_tenant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <hr class="mb-6">
                
                <!-- Payment Method -->
                <h3 class="text-lg font-bold text-mtn-black mb-4">Payment Method</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Select Payment Method *</label>
                    
                    <div class="space-y-3">
                        <!-- MTN MoMo -->
                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50 transition">
                            <input type="radio" name="payment_method" value="mtn_momo" required class="w-4 h-4 text-mtn-yellow">
                            <span class="ml-3">
                                <span class="block font-semibold text-gray-800">MTN Mobile Money</span>
                                <span class="text-sm text-gray-600">Pay using your MTN phone number</span>
                            </span>
                        </label>
                  
                   <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                    <input type="radio" name="payment_method" value="credit" required class="w-4 h-4">
                    <span class="ml-3">
                        <span class="block font-semibold">Credit Limit</span>
                        <span class="text-sm text-gray-600">Available: <?php echo e(number_format(Auth::user()->getAvailableCredit(), 0)); ?> XAF</span>
                    </span>
                </label>    
                        <!-- Orange Money -->
                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50 transition">
                            <input type="radio" name="payment_method" value="orange_money" required class="w-4 h-4 text-mtn-yellow">
                            <span class="ml-3">
                                <span class="block font-semibold text-gray-800">Orange Money</span>
                                <span class="text-sm text-gray-600">Pay using your Orange phone number</span>
                            </span>
                        </label>
                        
                        <!-- Card Payment -->
                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50 transition">
                            <input type="radio" name="payment_method" value="card" required class="w-4 h-4 text-mtn-yellow">
                            <span class="ml-3">
                                <span class="block font-semibold text-gray-800">Credit/Debit Card</span>
                                <span class="text-sm text-gray-600">Pay with Visa, Mastercard, or American Express</span>
                            </span>
                        </label>
                    </div>

                    
                    <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <hr class="mb-6">
                
                <!-- Agree to Terms -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="agree_terms" required class="w-4 h-4 text-mtn-yellow rounded">
                        <span class="ml-2 text-sm text-gray-700">
                            I agree to the <a href="#" class="text-mtn-yellow hover:text-mtn-orange font-semibold">Terms & Conditions</a>
                        </span>
                    </label>
                    <?php $__errorArgs = ['agree_terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-mtn-yellow text-black py-4 rounded-lg font-bold text-lg hover:bg-mtn-orange transition">
                    Complete Purchase (<?php echo e(number_format($total, 0)); ?> XAF)
                </button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
function toggleExistingTenantId() {
    const tenantType = document.getElementById('tenant_type').value;
    const existingTenantField = document.getElementById('existingTenantField');
    
    if (tenantType === 'existing') {
        existingTenantField.classList.remove('hidden');
        existingTenantField.querySelector('input').required = true;
    } else {
        existingTenantField.classList.add('hidden');
        existingTenantField.querySelector('input').required = false;
    }
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/checkout/index.blade.php ENDPATH**/ ?>