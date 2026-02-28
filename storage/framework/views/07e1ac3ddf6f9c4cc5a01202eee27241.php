<?php $__env->startSection('title', 'Email Hosting Checkout'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Complete Your Order</h1>
    <p class="text-gray-600">Set up your professional email</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Form -->
    <div class="lg:col-span-2">
        <form action="<?php echo e(route('customer.email-hosting.process')); ?>" method="POST" id="checkoutForm">
            <?php echo csrf_field(); ?>

            <!-- Domain Details -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                <h2 class="text-xl font-bold text-mtn-black mb-6">Domain Details</h2>
                
                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-6">
                    <p class="text-blue-900"><strong>Domain:</strong> <span id="displayDomain" class="font-bold"><?php echo e($domain); ?></span></p>
                    <p class="text-blue-900 text-sm mt-2">New domain registration for 1 year</p>
                </div>

                <input type="hidden" name="domain" value="<?php echo e($domain); ?>">
                <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
            </div>

            <!-- Email Hosting Plan -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                <h2 class="text-xl font-bold text-mtn-black mb-6">Email Hosting Plan</h2>
                
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <p class="text-gray-600 text-sm">Selected Plan</p>
                    <p class="text-2xl font-bold text-mtn-black"><?php echo e($plan->name); ?></p>
                    <p class="text-gray-600 text-sm mt-2"><?php echo e($plan->description); ?></p>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div>
                        <p class="text-gray-600 text-sm">Storage/Mailbox</p>
                        <p class="text-xl font-bold text-mtn-black"><?php echo e($plan->storage_gb); ?> GB</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Default Mailboxes</p>
                        <p class="text-xl font-bold text-mtn-black"><?php echo e($plan->mailboxes_included); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Price/Mailbox</p>
                        <p class="text-xl font-bold text-mtn-yellow"><?php echo e(number_format($plan->price_per_mailbox, 0)); ?> XAF</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Number of Additional Mailboxes *</label>
                    <input type="number" name="mailbox_count" value="<?php echo e($plan->mailboxes_included); ?>" min="1" max="100" required
                           onchange="updateTotal()"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <p class="text-xs text-gray-600 mt-1">Total cost = Domain + (Price per mailbox × number of mailboxes)</p>
                </div>
            </div>

            <!-- Email Setup -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                <h2 class="text-xl font-bold text-mtn-black mb-6">Email Setup</h2>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Main Email Address *</label>
                    <div class="flex items-center">
                        <input type="text" id="mainMailbox" placeholder="admin" 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                        
                        <span class="px-3 py-2 bg-gray-100 border border-gray-300 border-l-0 rounded-r-lg">@<span id="domainDisplay"><?php echo e($domain); ?></span></span>
                    </div>
                    <p id="mainEmailPreview" class="text-sm text-gray-600 mt-2">Email: <strong>@<span id="domainDisplay"><?php echo e($domain); ?></strong></p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Admin Password *</label>
                    <input type="password" name="admin_password" id="adminPassword" placeholder="Minimum 8 characters" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                    <p class="text-xs text-gray-600 mt-1">You can change this password after setup</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password *</label>
                    <input type="password" id="confirmPassword" placeholder="Confirm password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4">
                    <p class="text-yellow-900 text-sm"><strong>Note:</strong> Make sure your password is strong and write it down in a safe place.</p>
                </div>
            </div>

            <!-- Contact Email for Confirmatio -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                <h2 class="text-xl font-bold text-mtn-black mb-6">Confirmation Email</h2>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Where should we send your credentials? *</label>
                    <input type="email" name="admin_email" value="<?php echo e(Auth::user()->email); ?>" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                <h2 class="text-xl font-bold text-mtn-black mb-6">Payment Method</h2>

                <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
    <input type="radio" name="payment_method" value="credit" required class="w-4 h-4">
    <span class="ml-3">
        <span class="block font-semibold">Credit Limit</span>
        <span class="text-sm text-gray-600">Available: <?php echo e(number_format(Auth::user()->getAvailableCredit(), 0)); ?> XAF</span>
    </span>
</label>
                
                <div class="space-y-3">
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                        <input type="radio" name="payment_method" value="mtn_momo" required class="w-4 h-4">
                        <span class="ml-3">
                            <span class="block font-semibold">MTN Mobile Money</span>
                            <span class="text-sm text-gray-600">Pay with MTN +237</span>
                        </span>
                    </label>
                    
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                        <input type="radio" name="payment_method" value="orange_money" required class="w-4 h-4">
                        <span class="ml-3">
                            <span class="block font-semibold">Orange Money</span>
                            <span class="text-sm text-gray-600">Pay with Orange +237</span>
                        </span>
                    </label>
                    
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                        <input type="radio" name="payment_method" value="card" required class="w-4 h-4">
                        <span class="ml-3">
                            <span class="block font-semibold">Credit/Debit Card</span>
                            <span class="text-sm text-gray-600">Visa, Mastercard, Amex</span>
                        </span>
                    </label>
                </div>
            </div>

            <!-- Terms -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                <label class="flex items-start">
                    <input type="checkbox" name="agree_terms" required class="mt-1">
                    <span class="ml-3 text-sm text-gray-700">
                        I agree to the <a href="#" class="text-mtn-yellow hover:text-mtn-orange font-semibold">Terms & Conditions</a> and 
                        <a href="#" class="text-mtn-yellow hover:text-mtn-orange font-semibold">Privacy Policy</a>
                    </span>
                </label>
            </div>

            <button type="submit" class="w-full bg-mtn-yellow text-black py-4 rounded-lg font-bold text-lg hover:bg-mtn-orange transition">
                Complete Order
            </button>
        </form>
    </div>

    <!-- Order Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-lg p-8 sticky top-24">
            <h2 class="text-xl font-bold text-mtn-black mb-6">Order Summary</h2>

            <div class="space-y-4 mb-6 pb-6 border-b-2 border-gray-200">
                <div class="flex justify-between">
                    <span class="text-gray-700">Domain (<?php echo e($domain); ?>)</span>
                    <span class="font-semibold"><?php echo e(number_format($domainPrice, 0)); ?> XAF</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-700">Email Hosting (1st Month)</span>
                    <span class="font-semibold" id="hostingCost"><?php echo e(number_format($hostingPrice, 0)); ?> XAF</span>
                </div>
            </div>

            <div class="flex justify-between mb-6">
                <span class="text-xl font-bold text-mtn-black">Total</span>
                <span class="text-3xl font-bold text-mtn-yellow" id="totalCost"><?php echo e(number_format($totalPrice, 0)); ?> XAF</span>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg text-sm text-blue-900">
                <p><strong>Plan:</strong> <?php echo e($plan->name); ?></p>
                <p><strong>Storage:</strong> <?php echo e($plan->storage_gb); ?> GB/mailbox</p>
                <p class="mt-2 text-xs">Renewal after 1 year: <?php echo e(number_format($domainPrice + $hostingPrice, 0)); ?> XAF/year</p>
            </div>
        </div>
    </div>
</div>

<script>
function updateTotal() {
    const mailboxCount = parseInt(document.querySelector('input[name="mailbox_count"]').value) || 1;
    const planPrice = <?php echo e($plan->price_per_mailbox); ?>;
    const domainPrice = <?php echo e($domainPrice); ?>;
    
    const hostingCost = mailboxCount * planPrice;
    const total = domainPrice + hostingCost;
    
    document.getElementById('hostingCost').textContent = number_format(hostingCost) + ' XAF';
    document.getElementById('totalCost').textContent = number_format(total) + ' XAF';
}

document.getElementById('mainMailbox').addEventListener('input', function() {
    const email = (this.value || 'admin') + '{{ $domain }}';
    document.getElementById('mainEmailPreview').textContent = 'Email: ' + email;
});

document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const password = document.getElementById('adminPassword').value;
    const confirm = document.getElementById('confirmPassword').value;
    
    if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match!');
        return false;
    }
    
    if (password.length < 8) {
        e.preventDefault();
        alert('Password must be at least 8 characters long!');
        return false;
    }
});

function number_format(num) {
    return new Intl.NumberFormat('fr-FR').format(num);
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/email-hosting/checkout.blade.php ENDPATH**/ ?>