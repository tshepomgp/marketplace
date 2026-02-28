

<?php $__env->startSection('title', 'Credit Limit'); ?>



<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Credit Limit</h1>
</div class="mb-8">

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Total Credit Limit</p>
        <p class="text-3xl font-bold text-mtn-yellow"><?php echo e(number_format($user->credit_limit, 0)); ?> XAF</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Used</p>
        <p class="text-3xl font-bold text-red-600"><?php echo e(number_format($user->credit_used, 0)); ?> XAF</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Available</p>
        <p class="text-3xl font-bold text-green-600"><?php echo e(number_format($user->getAvailableCredit(), 0)); ?> XAF</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left">Date</th>
                <th class="px-6 py-4 text-left">Description</th>
                <th class="px-6 py-4 text-right">Amount</th>
                <th class="px-6 py-4 text-right">Balance</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="px-6 py-4"><?php echo e($tx->created_at->format('M d, Y')); ?></td>
                <td class="px-6 py-4"><?php echo e($tx->description); ?></td>
                <td class="px-6 py-4 text-right">-<?php echo e(number_format($tx->amount, 0)); ?> XAF</td>
                <td class="px-6 py-4 text-right font-bold"><?php echo e(number_format($tx->balance_after, 0)); ?> XAF</td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    
</div><br>
<div><a class="text-3xl font-bold text-mtn-black mb-2" href="/customer/credit/invoice">Click to View Invoice</a></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/credit/dashboard.blade.php ENDPATH**/ ?>