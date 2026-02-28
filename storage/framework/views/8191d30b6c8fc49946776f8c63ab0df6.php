

<?php $__env->startSection('title', 'Domain Not Available'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">❌ Domain Not Available</h1>
</div>

<div class="bg-red-50 border-2 border-red-500 rounded-lg p-8 text-center mb-8">
    <svg class="w-24 h-24 text-red-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    
    <p class="text-3xl font-bold text-red-900 mb-2"><?php echo e($domain); ?></p>
    <p class="text-red-700 mb-6 text-lg">Sorry, this domain is already taken or unavailable.</p>
</div>

<!-- Suggested Domains -->
<div class="bg-white rounded-lg shadow p-8 mb-8">
    <h2 class="text-2xl font-bold text-mtn-black mb-6">Try These Alternatives:</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Option 1: pro -->
        <form method="POST" action="<?php echo e(route('customer.email-hosting.check-availability')); ?>" class="block">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="domain" value="<?php echo e($domainInput); ?>pro">
            <input type="hidden" name="tld" value="<?php echo e($tld); ?>">
            <button type="submit" class="w-full border-2 border-gray-300 rounded-lg p-4 hover:border-mtn-yellow hover:bg-yellow-50 transition text-left">
                <p class="font-bold text-mtn-black"><?php echo e($domainInput); ?>pro<?php echo e($tld); ?></p>
                <p class="text-sm text-gray-600">Check availability</p>
            </button>
        </form>
        
        <!-- Option 2: the -->
        <form method="POST" action="<?php echo e(route('customer.email-hosting.check-availability')); ?>" class="block">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="domain" value="the<?php echo e($domainInput); ?>">
            <input type="hidden" name="tld" value="<?php echo e($tld); ?>">
            <button type="submit" class="w-full border-2 border-gray-300 rounded-lg p-4 hover:border-mtn-yellow hover:bg-yellow-50 transition text-left">
                <p class="font-bold text-mtn-black">the<?php echo e($domainInput); ?><?php echo e($tld); ?></p>
                <p class="text-sm text-gray-600">Check availability</p>
            </button>
        </form>
        
        <!-- Option 3: get -->
        <form method="POST" action="<?php echo e(route('customer.email-hosting.check-availability')); ?>" class="block">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="domain" value="get<?php echo e($domainInput); ?>">
            <input type="hidden" name="tld" value="<?php echo e($tld); ?>">
            <button type="submit" class="w-full border-2 border-gray-300 rounded-lg p-4 hover:border-mtn-yellow hover:bg-yellow-50 transition text-left">
                <p class="font-bold text-mtn-black">get<?php echo e($domainInput); ?><?php echo e($tld); ?></p>
                <p class="text-sm text-gray-600">Check availability</p>
            </button>
        </form>
        
        <!-- Option 4: 2024 -->
        <form method="POST" action="<?php echo e(route('customer.email-hosting.check-availability')); ?>" class="block">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="domain" value="<?php echo e($domainInput); ?>2024">
            <input type="hidden" name="tld" value="<?php echo e($tld); ?>">
            <button type="submit" class="w-full border-2 border-gray-300 rounded-lg p-4 hover:border-mtn-yellow hover:bg-yellow-50 transition text-left">
                <p class="font-bold text-mtn-black"><?php echo e($domainInput); ?>2024<?php echo e($tld); ?></p>
                <p class="text-sm text-gray-600">Check availability</p>
            </button>
        </form>
    </div>
</div>

<!-- Back to Search -->
<div class="text-center">
    <a href="<?php echo e(route('customer.email-hosting.domain-search')); ?>" class="inline-block bg-mtn-yellow text-black px-8 py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
        ← Search Another Domain
    </a>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/email-hosting/domain-unavailable.blade.php ENDPATH**/ ?>