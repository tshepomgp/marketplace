<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\StorageOrderController;

// Public Routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

// Products - Public
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

// Cart - Public (no auth required)
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Language Switcher
Route::get('/language/{locale}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Customer Dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Orders
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/invoice', [App\Http\Controllers\OrderController::class, 'invoice'])->name('orders.invoice');
    
    // Subscriptions
    Route::get('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{subscription}', [App\Http\Controllers\SubscriptionController::class, 'show'])->name('subscriptions.show');
// Customer VM & Storage Orders - Protected
Route::middleware(['auth'])->group(function () {
    // VM Orders
    Route::get('/vm-orders/create', [App\Http\Controllers\VmOrderController::class, 'index'])->name('vm-orders.create');
    Route::post('/vm-orders/calculate', [App\Http\Controllers\VmOrderController::class, 'calculate'])->name('vm-orders.calculate');
    Route::post('/vm-orders', [App\Http\Controllers\VmOrderController::class, 'store'])->name('vm-orders.store');
    Route::get('/vm-orders/success/{id}', [App\Http\Controllers\VmOrderController::class, 'success'])->name('vm-orders.success');
    Route::get('/my-vm-orders', [App\Http\Controllers\VmOrderController::class, 'myOrders'])->name('vm-orders.my-orders');
    Route::get('/my-vm-orders/{vmOrder}', [App\Http\Controllers\VmOrderController::class, 'show'])->name('vm-orders.show');
    
    // Storage Orders
    Route::get('/storage-orders/create', [App\Http\Controllers\StorageOrderController::class, 'index'])->name('storage-orders.create');
    Route::post('/storage-orders/calculate', [App\Http\Controllers\StorageOrderController::class, 'calculate'])->name('storage-orders.calculate');
    Route::post('/storage-orders', [App\Http\Controllers\StorageOrderController::class, 'store'])->name('storage-orders.store');
    Route::get('/storage-orders/success/{id}', [App\Http\Controllers\StorageOrderController::class, 'success'])->name('storage-orders.success');
    Route::get('/my-storage-orders', [App\Http\Controllers\StorageOrderController::class, 'myOrders'])->name('storage-orders.my-orders');
    Route::get('/my-storage-orders/{storageOrder}', [App\Http\Controllers\StorageOrderController::class, 'show'])->name('storage-orders.show');
});

    
    // Checkout - Requires Auth
   // Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
   // Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
   // Route::get('/checkout/success/{order}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
});

Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {

    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    
   Route::get('products/vm', [CustomerProductController::class, 'vmOrdering'])->name('products.vm-ordering');
    Route::get('products/storage', [CustomerProductController::class, 'storageOrdering'])->name('products.storage-ordering');
    Route::post('orders', [CustomerOrderController::class, 'store'])->name('orders.store');
    Route::get('orders/{order}', [CustomerOrderController::class, 'show'])->name('orders.show');
    Route::get('orders/{order}/success', [CustomerOrderController::class, 'success'])->name('orders.success');
    Route::post('storage-orders', [StorageOrderController::class, 'store'])->name('storage-orders.store');
    Route::get('storage-orders/{order}', [StorageOrderController::class, 'show'])->name('storage-orders.show');
    Route::get('storage-orders/{order}/success', [StorageOrderController::class, 'success'])->name('storage-orders.success');
    Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
});

// Admin Routes - Protected
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', 'Admin\ProductController');
    Route::get('orders/vm', 'Admin\OrderController@vmOrders')->name('orders.vm');
    Route::get('orders/storage', 'Admin\OrderController@storageOrders')->name('orders.storage');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/export/{type}', [AdminOrderController::class, 'export'])->name('orders.export');
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    
 Route::resource(
            'customers',
            App\Http\Controllers\Admin\CustomerController::class
        );

Route::get(
    '/customers/{user}/licenses',
    [App\Http\Controllers\Admin\CustomerController::class, 'licenses']
)->name('customers.licenses');

    // Products
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{product}/toggle', [App\Http\Controllers\Admin\ProductController::class, 'toggleActive'])->name('products.toggle');
    
    // Settings placeholder
    Route::get('/settings', function() {
        return redirect()->route('admin.dashboard')->with('info', 'Settings coming soon');
    })->name('settings.index');
});

// Webhooks (no auth)
Route::post('/webhooks/mtn-momo', [App\Http\Controllers\CheckoutController::class, 'mtnMomoWebhook'])->name('webhooks.mtn-momo');
Route::post('/webhooks/orange-money', [App\Http\Controllers\CheckoutController::class, 'orangeMoneyWebhook'])->name('webhooks.orange-money');
Route::post('/webhooks/flutterwave', [App\Http\Controllers\CheckoutController::class, 'flutterwaveWebhook'])->name('webhooks.flutterwave');
Route::post('/webhooks/microsoft', [App\Http\Controllers\CheckoutController::class, 'microsoftWebhook'])->name('webhooks.microsoft');

require __DIR__.'/auth.php';
