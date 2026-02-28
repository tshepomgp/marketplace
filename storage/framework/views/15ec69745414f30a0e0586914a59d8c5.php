

<?php $__env->startSection('title', 'Monthly Invoice'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Monthly Invoice</h1>
    <p class="text-gray-600"><?php echo e(now()->format('F Y')); ?></p>
</div>

<!-- Invoice Container -->
<div class="bg-white rounded-lg shadow p-12 max-w-4xl">
    
    <!-- Header -->
    <div class="flex justify-between items-start mb-12 pb-8 border-b-2 border-gray-300">
        <div>
            <h2 class="text-3xl font-bold text-mtn-black">INVOICE</h2>
            <p class="text-gray-600 mt-2">Invoice Date: <?php echo e(now()->format('M d, Y')); ?></p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-600">Invoice Period</p>
            <p class="text-lg font-bold"><?php echo e(now()->format('F Y')); ?></p>
        </div>
    </div>

    <!-- Bill To -->
    <div class="grid grid-cols-2 gap-12 mb-12">
        <div>
            <p class="text-gray-600 text-sm font-semibold mb-2">BILL TO:</p>
            <p class="text-lg font-bold text-mtn-black"><?php echo e($user->name); ?></p>
            <p class="text-gray-700"><?php echo e($user->company_name); ?></p>
            <p class="text-gray-700"><?php echo e($user->email); ?></p>
            <p class="text-gray-700"><?php echo e($user->phone ?? 'N/A'); ?></p>
        </div>
        <div class="text-right">
            <p class="text-gray-600 text-sm font-semibold mb-2">CREDIT ACCOUNT</p>
            <p class="text-lg font-bold text-mtn-yellow"><?php echo e(number_format($user->credit_limit, 0)); ?> XAF</p>
            <p class="text-gray-700 mt-4">
                <span class="text-sm text-gray-600">Previously Used:</span><br>
                <span class="font-bold text-red-600"><?php echo e(number_format($user->credit_used - $totalCharged, 0)); ?> XAF</span>
            </p>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="mb-12">
        <table class="w-full">
            <thead class="bg-gray-100 border-b-2 border-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Date</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Description</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Reference</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm"><?php echo e($tx->created_at->format('M d, Y')); ?></td>
                    <td class="px-4 py-3 text-sm"><?php echo e($tx->description); ?></td>
                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($tx->reference_id ?? 'N/A'); ?></td>
                    <td class="px-4 py-3 text-sm text-right font-bold text-red-600">-<?php echo e(number_format($tx->amount, 0)); ?> XAF</td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">No charges this month</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="flex justify-end mb-12">
        <div class="w-full md:w-80">
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="flex justify-between mb-3 pb-3 border-b border-gray-300">
                    <span class="text-gray-700">Total Charges:</span>
                    <span class="font-bold text-red-600"><?php echo e(number_format($totalCharged, 0)); ?> XAF</span>
                </div>
                
                <div class="flex justify-between mb-3 pb-3 border-b border-gray-300">
                    <span class="text-gray-700">Previous Balance:</span>
                    <span class="font-bold"><?php echo e(number_format($user->credit_used - $totalCharged, 0)); ?> XAF</span>
                </div>
                
                <div class="flex justify-between pt-3">
                    <span class="text-lg font-bold text-mtn-black">New Balance:</span>
                    <span class="text-lg font-bold text-mtn-yellow"><?php echo e(number_format($user->credit_used, 0)); ?> XAF</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="border-t-2 border-gray-300 pt-8 text-center text-gray-600 text-sm">
        <p>Thank you for your business</p>
        <p class="mt-2">Payment Terms: Credit deducted upon order placement</p>
        <p class="mt-4 text-xs text-gray-500">Generated on <?php echo e(now()->format('M d, Y H:i')); ?></p>
    </div>

</div>

<!-- Action Buttons -->
<div class="mt-8 flex gap-4 justify-center">
    <button onclick="window.print()" class="bg-mtn-yellow text-black px-8 py-3 rounded-lg font-bold hover:bg-mtn-orange
<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/credit/invoice.blade.php ENDPATH**/ ?>