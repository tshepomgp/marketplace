<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-mtn-black mb-2">Customers</h1>
            <p class="text-gray-600">Manage all your customers</p>
        </div>
        <a href="<?php echo e(route('admin.customers.index')); ?>" class="inline-block bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
            Refresh List
        </a>
    </div>
</div>

<!-- Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Customers</p>
                <p class="text-3xl font-bold text-mtn-black"><?php echo e(\App\Models\User::where('role', 'customer')->count()); ?></p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a3 3 0 11-6 0 3 3 0 016 0zM17 9a2 2 0 11-4 0 2 2 0 014 0zM9 11a4 4 0 11-8 0 4 4 0 018 0zM9 11a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Active Orders</p>
                <p class="text-3xl font-bold text-mtn-black"><?php echo e(\App\Models\Order::where('status', 'pending')->count()); ?></p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <svg class="w-8 h-8 text-mtn-yellow" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Completed Orders</p>
                <p class="text-3xl font-bold text-mtn-black"><?php echo e(\App\Models\Order::where('status', 'completed')->count()); ?></p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Revenue</p>
                <p class="text-3xl font-bold text-mtn-black"><?php echo e(number_format(\App\Models\Order::where('status', 'completed')->sum('subtotal'), 0)); ?> XAF</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.16 2.75a.75.75 0 00-1.32 0l-.96 2.4c-.04.1-.15.16-.27.15h-2.53a.75.75 0 00-.44 1.36l2.05 1.49c.08.06.12.17.08.27l-.96 2.4a.75.75 0 001.16.82l2.05-1.49c.08-.06.2-.06.28 0l2.05 1.49a.75.75 0 001.16-.82l-.96-2.4a.25.25 0 01.08-.27l2.05-1.49a.75.75 0 00-.44-1.36h-2.53c-.12 0-.23-.05-.27-.15l-.96-2.4z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filters -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <form action="<?php echo e(route('admin.customers.index')); ?>" method="GET" class="flex gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by name, email, company, or phone..."
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
        </div>
        <button type="submit" class="bg-mtn-yellow text-black px-6 py-2 rounded-lg font-semibold hover:bg-mtn-orange transition">
            Search
        </button>
        <?php if(request('search')): ?>
        <a href="<?php echo e(route('admin.customers.index')); ?>" class="bg-gray-300 text-black px-6 py-2 rounded-lg font-semibold hover:bg-gray-400 transition">
            Clear
        </a>
        <?php endif; ?>
    </form>
</div>

<!-- Success Message -->
<?php if(session('success')): ?>
<div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<!-- Customers Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <?php if($customers->count() > 0): ?>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Customer Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Company</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Phone</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Orders</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Joined</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <a href="<?php echo e(route('admin.customers.show', $customer)); ?>" class="font-semibold text-mtn-yellow hover:text-mtn-orange">
                                <?php echo e($customer->name); ?>

                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <a href="mailto:<?php echo e($customer->email); ?>" class="text-blue-600 hover:text-blue-800">
                                <?php echo e($customer->email); ?>

                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                <?php echo e($customer->company_name ?? 'N/A'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <?php echo e($customer->phone ?? 'N/A'); ?>

                        </td>
                        <td class="px-6 py-4 text-center">
                            <?php
                                $totalOrders = $customer->vmOrders()->count() + $customer->storageOrders()->count();
                            ?>
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                <?php echo e($totalOrders); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-sm">
                            <?php echo e($customer->created_at->format('M d, Y')); ?>

                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-3">
                                <a href="<?php echo e(route('admin.customers.show', $customer)); ?>" class="text-blue-600 hover:text-blue-800 font-semibold text-sm" title="View">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="<?php echo e(route('admin.customers.edit', $customer)); ?>" class="text-green-600 hover:text-green-800 font-semibold text-sm" title="Edit">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </a>
                                <form action="<?php echo e(route('admin.customers.destroy', $customer)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm" title="Delete">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <?php echo e($customers->links()); ?>

        </div>
    <?php else: ?>
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            <p class="text-gray-600 text-lg">
                <?php if(request('search')): ?>
                    No customers found matching "<?php echo e(request('search')); ?>"
                <?php else: ?>
                    No customers yet
                <?php endif; ?>
            </p>
            <?php if(request('search')): ?>
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="inline-block mt-4 text-mtn-yellow hover:text-mtn-orange font-semibold">
                    ← Back to all customers
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>