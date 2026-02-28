<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"> 
    <title><?php echo $__env->yieldContent('title', 'MTN Microsoft License Marketplace'); ?></title>
    
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
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-mtn-black text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-mtn-yellow rounded-lg flex items-center justify-center">
                        <span class="text-mtn-black font-bold text-lg">M</span>
                    </div>
                    <a href="<?php echo e(route('customer.dashboard')); ?>" class="text-xl font-bold">
                        MTN Microsoft
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="<?php echo e(route('customer.dashboard')); ?>" class="hover:text-mtn-yellow transition">
                        Dashboard
                    </a>
                    <a href="<?php echo e(route('customer.products.vm-ordering')); ?>" class="hover:text-mtn-yellow transition">
                        VM Licenses
                    </a>
                    <a href="<?php echo e(route('customer.products.storage-ordering')); ?>" class="hover:text-mtn-yellow transition">
                        Cloud Storage
                    </a>
                    <a href="#" class="hover:text-mtn-yellow transition">
                        My Orders
                    </a>
                    <a href="/customer/email-hosting" class="hover:text-mtn-yellow transition">
                        Email Hosting
                    </a>
                </div>
                <div class="flex items-center space-x-4">
    <?php if(auth()->guard()->check()): ?>
    <!-- Credit Indicator -->
    <a href="<?php echo e(route('customer.credit.dashboard')); ?>" class="flex items-center space-x-2 px-4 py-2 rounded-lg bg-yellow-50 hover:bg-yellow-100 transition">
        <svg class="w-5 h-5 text-mtn-yellow" fill="currentColor" viewBox="0 0 20 20">
            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
        </svg>
        <div class="text-sm">
            <p class="text-gray-600">Credit</p>
            <p class="font-bold text-mtn-yellow"><?php echo e(number_format(Auth::user()->getAvailableCredit(), 0)); ?> XAF</p>
        </div>
    </a>
    <?php endif; ?>
</div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <button class="flex items-center space-x-2 hover:text-mtn-yellow transition">
                            <span><?php echo e(Auth::user()->name ?? 'User'); ?></span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 w-48 bg-white text-gray-800 rounded-lg shadow-xl hidden group-hover:block mt-2">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile Settings</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Billing</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Support</a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-mtn-black text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-lg font-bold mb-4">MTN Microsoft</h3>
                    <p class="text-gray-400">Premium Microsoft licensing solutions for African businesses</p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-semibold mb-4">Products</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-mtn-yellow">Microsoft 365</a></li>
                        <li><a href="#" class="hover:text-mtn-yellow">Office 365</a></li>
                        <li><a href="#" class="hover:text-mtn-yellow">Cloud Storage</a></li>
                        <li><a href="#" class="hover:text-mtn-yellow">Windows Licenses</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-mtn-yellow">Help Center</a></li>
                        <li><a href="#" class="hover:text-mtn-yellow">Documentation</a></li>
                        <li><a href="#" class="hover:text-mtn-yellow">Contact Us</a></li>
                        <li><a href="#" class="hover:text-mtn-yellow">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <p class="text-gray-400 text-sm mb-2">
                        Email: <a href="mailto:support@mtn-microsoft.cm" class="hover:text-mtn-yellow">support@mtn-microsoft.cm</a>
                    </p>
                    <p class="text-gray-400 text-sm">
                        Phone: <a href="tel:+237655123456" class="hover:text-mtn-yellow">+237 655 123 456</a>
                    </p>
                </div>
            </div>

            <!-- Bottom -->
            <div class="border-t border-gray-800 pt-8 flex justify-between items-center">
                <p class="text-gray-400 text-sm">© 2026 MTN Microsoft. All rights reserved.</p>
                <div class="flex space-x-6 text-gray-400 text-sm">
                    <a href="#" class="hover:text-mtn-yellow">Privacy Policy</a>
                    <a href="#" class="hover:text-mtn-yellow">Terms of Service</a>
                    <a href="#" class="hover:text-mtn-yellow">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/layouts/customer.blade.php ENDPATH**/ ?>