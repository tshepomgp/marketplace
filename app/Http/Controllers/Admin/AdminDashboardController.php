<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Subscription;
use App\Models\VmOrder;
use App\Models\StorageOrder;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        // Get statistics (you can uncomment these once models are set up)
       {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
            'total_customers' => Customer::count(),
            'active_subscriptions' => Subscription::where('status', 'active')->count(),
            
            // Azure HCI Stats
            'pending_vm_orders' => VmOrder::where('status', 'pending')->count(),
            'active_vms' => VmOrder::where('status', 'active')->count(),
            'pending_storage_orders' => StorageOrder::where('status', 'pending')->count(),
            'active_storage' => StorageOrder::where('status', 'active')->count(),
        ];

        $recent_orders = Order::with('customer')->latest()->take(50)->get();
        $recent_vm_orders = VmOrder::with(['customer', 'vmSku'])->latest()->take(5)->get();
        $recent_storage_orders = StorageOrder::with(['customer', 'storageSku'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'recent_vm_orders', 'recent_storage_orders'));
    }
}
}
