

<?php $__env->startSection('title', 'Create Email Hosting Plan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black">Create Email Hosting Plan</h1>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form method="POST" action="<?php echo e(route('admin.email-hosting-plans.store')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        
        <div>
            <label class="block text-sm font-semibold mb-2">Plan Name *</label>
            <input type="text" name="name" required value="<?php echo e(old('name')); ?>"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">SKU Code *</label>
            <input type="text" name="sku_code" required value="<?php echo e(old('sku_code')); ?>"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            <?php $__errorArgs = ['sku_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Price per Mailbox (XAF) *</label>
                <input type="number" name="price_per_mailbox" required step="0.01" value="<?php echo e(old('price_per_mailbox')); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Domain Price (XAF) *</label>
                <input type="number" name="domain_price" required step="0.01" value="<?php echo e(old('domain_price')); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Storage (GB) *</label>
                <input type="number" name="storage_gb" required value="<?php echo e(old('storage_gb')); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Mailboxes Included *</label>
                <input type="number" name="mailboxes_included" required value="<?php echo e(old('mailboxes_included')); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Description</label>
            <textarea name="description" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"><?php echo e(old('description')); ?></textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-mtn-yellow text-black px-8 py-2 rounded-lg font-bold">Create Plan</button>
            <a href="<?php echo e(route('admin.email-hosting-plans.index')); ?>" class="bg-gray-300 text-black px-8 py-2 rounded-lg font-bold">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/admin/email-hosting-plans/create.blade.php ENDPATH**/ ?>