

<?php $__env->startSection('title', 'Email Hosting Plans'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8 flex justify-between items-center">
    <h1 class="text-4xl font-bold text-mtn-black">Email Hosting Plans</h1>
    <a href="<?php echo e(route('admin.email-hosting-plans.create')); ?>" class="bg-mtn-yellow text-black px-6 py-2 rounded-lg font-bold">
        + New Plan
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left">Name</th>
                <th class="px-6 py-4 text-left">SKU Code</th>
                <th class="px-6 py-4 text-right">Price/Mailbox</th>
                <th class="px-6 py-4 text-right">Domain Price</th>
                <th class="px-6 py-4 text-left">Storage</th>
                <th class="px-6 py-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-semibold"><?php echo e($plan->name); ?></td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($plan->sku_code); ?></td>
                <td class="px-6 py-4 text-right font-bold"><?php echo e(number_format($plan->price_per_mailbox, 0)); ?> XAF</td>
                <td class="px-6 py-4 text-right font-bold"><?php echo e(number_format($plan->domain_price, 0)); ?> XAF</td>
                <td class="px-6 py-4"><?php echo e($plan->storage_gb); ?> GB</td>
                <td class="px-6 py-4 text-center space-x-2">
                    <a href="<?php echo e(route('admin.email-hosting-plans.edit', $plan)); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.email-hosting-plans.destroy', $plan)); ?>" style="display:inline;">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" onclick="return confirm('Delete?')" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">No plans yet</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/admin/email-hosting-plans/index.blade.php ENDPATH**/ ?>