<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        :root {
            --mtn-yellow: #FFCB05;
            --mtn-black: #000000;
            --mtn-dark-gray: #1a1a1a;
        }
        .btn-mtn {
            background-color: var(--mtn-yellow);
            color: var(--mtn-black);
            font-weight: 600;
        }
        .btn-mtn:hover {
            background-color: #e6b804;
        }
        .text-mtn-yellow {
            color: var(--mtn-yellow);
        }
        .bg-mtn-yellow {
            background-color: var(--mtn-yellow);
        }
        .bg-mtn-black {
            background-color: var(--mtn-black);
        }
        .border-mtn-yellow {
            border-color: var(--mtn-yellow);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation with MTN Branding -->
    <nav class="bg-mtn-black shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <!-- MTN Logo -->
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-3">
                        <?php if(file_exists(public_path('images/mtn-logo.jfif'))): ?>
                            <img src="<?php echo e(asset('images/mtn-logo.jfif')); ?>" alt="MTN" class="h-12">
                        <?php else: ?>
                            <div class="bg-mtn-yellow rounded-full p-2">
                                <span class="text-2xl font-bold text-black">MTN</span>
                            </div>
                        <?php endif; ?>
                        <span class="text-xl font-bold text-white">
                            <span>My MTN Cameroon Store</span>
                        </span>
                    </a>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="<?php echo e(route('home')); ?>" class="text-white hover:text-mtn-yellow px-3 py-2 transition">Home</a>
                        <a href="<?php echo e(route('products.index')); ?>" class="text-white hover:text-mtn-yellow px-3 py-2 transition">Products</a>
                        <a href="<?php echo e(route('about')); ?>" class="text-white hover:text-mtn-yellow px-3 py-2 transition">About</a>
                        <a href="<?php echo e(route('contact')); ?>" class="text-white hover:text-mtn-yellow px-3 py-2 transition">Contact</a>
                    </div>
                </div>
                            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
                
                <div class="flex items-center space-x-4">
                    <!-- Shopping Cart -->
                    <a href="<?php echo e(route('cart.index')); ?>" class="relative group">
                        <div class="bg-mtn-yellow p-2 rounded-full group-hover:bg-yellow-400 transition">
                            <svg class="h-6 w-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <?php if(session('cart') && count(session('cart')) > 0): ?>
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                            <?php echo e(count(session('cart'))); ?>

                        </span>
                        <?php endif; ?>
                    </a>
                    
                    <!-- Auth Links -->
                    <?php if(auth()->guard()->check()): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-white hover:text-mtn-yellow">
                                <span><?php echo e(Auth::user()->name); ?></span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="<?php echo e(route('dashboard')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <a href="<?php echo e(route('orders.index')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                                <a href="<?php echo e(route('vm-orders.my-orders')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My VMs</a>
                                <a href="<?php echo e(route('storage-orders.my-orders')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Storage</a>
                                <?php if(Auth::user()->isAdmin()): ?>
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Panel</a>
                                <?php endif; ?>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-white hover:text-mtn-yellow px-3 py-2">
                            Login
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="btn-mtn px-4 py-2 rounded-md">
                            Register
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Flash Messages -->
    <?php if(session('success')): ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded">
            <p class="font-medium"><?php echo e(session('success')); ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded">
            <p class="font-medium"><?php echo e(session('error')); ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(session('info')): ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 px-4 py-3 rounded">
            <p class="font-medium"><?php echo e(session('info')); ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Page Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <!-- MTN Footer -->
    <footer class="bg-mtn-black text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-mtn-yellow font-bold text-lg mb-4">MTN Microsoft Store</h3>
                    <p class="text-gray-400">Your trusted partner for Microsoft products.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Products</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo e(route('products.index')); ?>" class="text-gray-400 hover:text-mtn-yellow">Microsoft 365</a></li>
                        <li><a href="<?php echo e(route('products.index')); ?>" class="text-gray-400 hover:text-mtn-yellow">Office 365</a></li>
                        <li><a href="<?php echo e(route('products.index')); ?>" class="text-gray-400 hover:text-mtn-yellow">Windows</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-mtn-yellow">FAQ</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" class="text-gray-400 hover:text-mtn-yellow">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-mtn-yellow">Help</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Payment</h4>
                    <p class="text-gray-400 mb-2">MTN Mobile Money</p>
                    <p class="text-gray-400 mb-2">Orange Money</p>
                    <p class="text-gray-400">Credit/Debit Cards</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; <?php echo e(date('Y')); ?> MTN Cameroon. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
<?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/layouts/app.blade.php ENDPATH**/ ?>