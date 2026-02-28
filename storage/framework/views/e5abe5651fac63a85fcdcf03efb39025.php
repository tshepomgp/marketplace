<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin - MTN Microsoft License Marketplace'); ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Configure Tailwind for MTN Colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'mtn-yellow': '#FFC900',
                        'mtn-orange': '#FF6600',
                        'mtn-black': '#333333'
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .mtn-yellow { background-color: #FFC900; }
        .mtn-orange { background-color: #FF6600; }
        .mtn-black { background-color: #333333; }
        .text-mtn-yellow { color: #FFC900; }
        .text-mtn-orange { color: #FF6600; }
        .text-mtn-black { color: #333333; }
        .bg-mtn-yellow { background-color: #FFC900; }
        .bg-mtn-orange { background-color: #FF6600; }
        .bg-mtn-black { background-color: #333333; }
        .hover\:bg-mtn-orange:hover { background-color: #FF6600; }
        .hover\:text-mtn-orange:hover { color: #FF6600; }
        
        .sidebar {
            width: 250px;
            min-height: 100vh;
        }
        
        .sidebar-active {
            background-color: #FFC900;
            color: #333333;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="sidebar bg-mtn-black text-white shadow-lg fixed left-0 top-0 bottom-0 overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-mtn-yellow rounded-lg flex items-center justify-center">
                        <span class="text-mtn-black font-bold text-lg">M</span>
                    </div>
                    <div>
                        <p class="font-bold text-lg">MTN Microsoft</p>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <!-- Dashboard -->
                <a href="<?php echo e(route('admin.dashboard') ?? '#'); ?>" 
                   class="block px-4 py-3 rounded-lg <?php echo e(request()->routeIs('admin.dashboard') ? 'sidebar-active' : 'hover:bg-gray-800'); ?> transition">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/>
                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h6v-3a1 1 0 00-1-1H4a1 1 0 00-1 1v9a1 1 0 001 1h14a1 1 0 001-1v-4a1 1 0 00-1-1h-6v4a1 1 0 001 1h7v-2a1 1 0 00-1-1h-7z" clip-rule="evenodd"/>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>

                <!-- Products -->
                <div class="mt-4">
                    <p class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase">Products</p>
                    <a href="<?php echo e(route('admin.products.index')); ?>" 
                       class="block px-4 py-3 rounded-lg <?php echo e(request()->routeIs('admin.products.*') ? 'sidebar-active' : 'hover:bg-gray-800'); ?> transition">
                        <div class="flex items-center space-x-3 ml-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                                <path d="M16 16a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                <path d="M6.5 17.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                            </svg>
                            <span>All Products</span>
                        </div>
                    </a>
                    <a href="<?php echo e(route('admin.products.create')); ?>" 
                       class="block px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                        <div class="flex items-center space-x-3 ml-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Add Product</span>
                        </div>
                    </a>
                </div>

                <!-- Orders -->
                <div class="mt-4">
                    <p class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase">Orders</p>
                    <a href="<?php echo e(route('admin.orders.vm')); ?>" 
                       class="block px-4 py-3 rounded-lg <?php echo e(request()->routeIs('admin.orders.vm') ? 'sidebar-active' : 'hover:bg-gray-800'); ?> transition">
                        <div class="flex items-center space-x-3 ml-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/>
                            </svg>
                            <span>VM Orders</span>
                        </div>
                        <a href="<?php echo e(route('admin.email-hosting.orders')); ?>" class="flex items-center space-x-3 ml-4 hover:text-mtn-yellow transition">
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/>
    </svg>
    <span>Email Orders</span>
</a>
                    </a>
                    <a href="<?php echo e(route('admin.orders.storage')); ?>" 
                       class="block px-4 py-3 rounded-lg <?php echo e(request()->routeIs('admin.orders.storage') ? 'sidebar-active' : 'hover:bg-gray-800'); ?> transition">
                        <div class="flex items-center space-x-3 ml-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 12a1 1 0 01.22-2h13.56a1 1 0 01.22 2H3z"/>
                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm5 4a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                            </svg>
                            <span>Storage Orders</span>
                        </div>
                    </a>
                </div>

                <!-- Settings -->
                <div class="mt-4">
                    <p class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase">Settings</p>
                    <a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                        <div class="flex items-center space-x-3 ml-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                            </svg>
                            <span>Settings</span>
                        </div>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-0 lg:ml-0" style="margin-left: 250px;">
            <!-- Top Navigation -->
            <nav class="bg-white shadow-sm sticky top-0 z-40">
                <div class="px-6 py-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-mtn-black"><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></h1>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <!-- Search -->
                        <input type="text" placeholder="Search..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                        
                        <!-- Admin Menu -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-mtn-yellow transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                <span><?php echo e(Auth::user()->name ?? 'Admin'); ?></span>
                            </button>
                            
                            <!-- Dropdown -->
                            <div class="absolute right-0 w-48 bg-white rounded-lg shadow-xl hidden group-hover:block mt-2">
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-6">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/layouts/admin.blade.php ENDPATH**/ ?>