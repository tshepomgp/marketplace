<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       $customers = User::where('role', 'customer')
        ->withCount(['orders', 'subscriptions'])
        ->latest()
        ->paginate(20);
        
        $stats = [
            'total_customers' => Customer::count(),
            'active_customers' => Customer::where('status', 'active')->count(),
            'total_licenses' => Subscription::where('status', 'active')->sum('quantity'),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
        ];
        
        return view('admin.customers.index', compact('customers', 'stats'));
    }

    public function show(Customer $customer)
    {
        $customer->load(['orders.items', 'subscriptions.product', 'user']);
        
        $stats = [
            'total_orders' => $customer->orders->count(),
            'total_spent' => $customer->orders->where('payment_status', 'paid')->sum('total'),
            'active_licenses' => $customer->subscriptions->where('status', 'active')->sum('quantity'),
            'pending_orders' => $customer->orders->where('payment_status', 'pending')->count(),
        ];
        
        return view('admin.customers.show', compact('customer', 'stats'));
    }

    public function licenses(Customer $customer)
    {
        $subscriptions = $customer->subscriptions()
            ->with('product', 'order')
            ->latest()
            ->get();
        
        return view('admin.customers.licenses', compact('customer', 'subscriptions'));
    }

    public function orders(Customer $customer)
    {
        $orders = $customer->orders()
            ->with('items')
            ->latest()
            ->paginate(10);
        
        return view('admin.customers.orders', compact('customer', 'orders'));
    }

    public function toggleStatus(Customer $customer)
    {
        $newStatus = $customer->status === 'active' ? 'inactive' : 'active';
        $customer->update(['status' => $newStatus]);
        
        return redirect()->back()->with('success', 'Customer status updated successfully');
    }

    public function destroy(Customer $customer)
    {
        // Check if customer has active subscriptions
        if ($customer->subscriptions()->where('status', 'active')->exists()) {
            return redirect()->back()->with('error', 'Cannot delete customer with active subscriptions');
        }
        
        $customer->delete();
        
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully');
    }


}
