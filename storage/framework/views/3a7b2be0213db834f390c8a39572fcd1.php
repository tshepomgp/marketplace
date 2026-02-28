<?php $__env->startSection('title', 'Email Hosting'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Professional Email Hosting</h1>
    <p class="text-gray-600 text-lg">Get a professional email address with your domain @yourcompany.cm</p>
</div>

<!-- Features Section -->
<div class="bg-gradient-to-r from-mtn-yellow to-mtn-orange rounded-lg p-8 mb-12 text-black">
    <h2 class="text-2xl font-bold mb-6">Why Choose Our Email Hosting?</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-bold">Professional Brand</p>
                <p class="text-sm">Your own domain email</p>
            </div>
        </div>
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-bold">Secure & Reliable</p>
                <p class="text-sm">99.9% uptime SLA</p>
            </div>
        </div>
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-bold">Easy Setup</p>
                <p class="text-sm">Works with any email client</p>
            </div>
        </div>
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-bold">24/7 Support</p>
                <p class="text-sm">Expert help anytime</p>
            </div>
        </div>
    </div>
</div>

<!-- Email Hosting Plans -->
<div class="mb-12">
    <h2 class="text-2xl font-bold text-mtn-black mb-8">Choose Your Plan</h2>
    
    <?php if($plans->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2 <?php echo e($plan->name === 'Professional' ? 'border-4 border-mtn-yellow' : ''); ?>">
                <!-- Header -->
                <div class="bg-gradient-to-r from-mtn-black to-gray-800 text-white p-6">
                    <?php if($plan->name === 'Professional'): ?>
                    <div class="inline-block bg-mtn-yellow text-black px-3 py-1 rounded-full text-sm font-bold mb-2">
                        RECOMMENDED
                    </div>
                    <?php endif; ?>
                    <h3 class="text-2xl font-bold"><?php echo e($plan->name); ?></h3>
                    <p class="text-sm opacity-90 mt-1"><?php echo e($plan->description); ?></p>
                </div>

                <!-- Pricing -->
                <div class="p-6">
                    <div class="mb-6">
                        <p class="text-gray-600 text-sm">Per Mailbox (Monthly)</p>
                        <p class="text-4xl font-bold text-mtn-yellow"><?php echo e(number_format($plan->price_per_mailbox, 0)); ?><span class="text-lg"> XAF</span></p>
                    </div>

                    <div class="mb-6 pb-6 border-b-2 border-gray-200">
                        <p class="text-gray-600 text-sm">Domain Registration (1st Year)</p>
                        <p class="text-2xl font-bold text-mtn-black"><?php echo e(number_format($plan->domain_price, 0)); ?> XAF</p>
                    </div>

                    <!-- Features -->
                    <div class="space-y-3 mb-6">
                        <h4 class="font-bold text-mtn-black">Features:</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <?php echo e($plan->storage_gb); ?> GB Storage
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <?php echo e($plan->mailboxes_included); ?> Mailbox(es)
                            </li>
                            <?php
                                $features = is_array($plan->features) ? $plan->features : json_decode($plan->features, true);
                            ?>

                            <?php if($features): ?>
                                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <?php echo e($feature); ?>

                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- CTA Button -->
                    <a href="<?php echo e(route('customer.email-hosting.domain-search', ['plan_id' => $plan->id])); ?>" 
                       class="block w-full text-center bg-mtn-yellow text-black py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
                        Get Started
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-600">No email hosting plans available at the moment.</p>
        </div>
    <?php endif; ?>
</div>

<!-- FAQ Section -->
<div class="bg-white rounded-lg shadow p-8 mb-8">
    <h2 class="text-2xl font-bold text-mtn-black mb-6">Frequently Asked Questions</h2>
    
    <div class="space-y-6">
        <div>
            <h3 class="font-bold text-mtn-black mb-2">What email clients can I use?</h3>
            <p class="text-gray-600">Our email hosting works with Outlook, Gmail, Apple Mail, Thunderbird, and any IMAP/SMTP compatible client.</p>
        </div>
        
        <div>
            <h3 class="font-bold text-mtn-black mb-2">Can I add more mailboxes later?</h3>
            <p class="text-gray-600">Yes! You can upgrade your plan or add additional mailboxes anytime. Charges will be prorated.</p>
        </div>
        
        <div>
            <h3 class="font-bold text-mtn-black mb-2">What happens when my domain expires?</h3>
            <p class="text-gray-600">Your domain auto-renews by default. You'll receive renewal reminders 60 days before expiration.</p>
        </div>
        
        <div>
            <h3 class="font-bold text-mtn-black mb-2">Do you provide domain registration?</h3>
            <p class="text-gray-600">Yes! You can register a new domain or use an existing domain with our email hosting.</p>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/email-hosting/index.blade.php ENDPATH**/ ?>