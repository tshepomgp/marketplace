<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display all customers with search
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
                  //->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Exclude admins from customer list
        $query->where('role', 'customer');

        // Sort by latest
        $customers = $query->latest()->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show customer details with orders
     */
    public function show(User $customer)
    {
        // Check if user is actually a customer (not admin)
        if ($customer->is_admin) {
            abort(404, 'Customer not found');
        }

        // Load customer with orders
        $customer->load(['vmOrders' => function ($query) {
            $query->with('product')->latest();
        }, 'storageOrders' => function ($query) {
            $query->latest();
        }]);

        // Get stats
        $totalOrders = $customer->vmOrders()->count() + $customer->storageOrders()->count();
        $totalSpent = $customer->vmOrders()->sum('total') + $customer->storageOrders()->sum('monthly_cost');
        $activeOrders = $customer->vmOrders()->where('status', 'active')->count() + 
                       $customer->storageOrders()->where('status', 'active')->count();
$stats = [
        'total_orders' => $customer->vmOrders()->count() + $customer->storageOrders()->count(),
        'total_spent' => $customer->vmOrders()->sum('total') + $customer->storageOrders()->sum('monthly_cost'),
        'active_licenses' => $customer->vmOrders()->where('status', 'active')->count() + 
                         $customer->storageOrders()->where('status', 'active')->count(),
        'pending_orders' => $customer->vmOrders()->where('status', 'pending')->count() + 
                         $customer->storageOrders()->where('status', 'pending')->count(),
    ];
        return view('admin.customers.show', compact('customer', 'totalOrders', 'totalSpent', 'activeOrders', 'stats'));
    }

    /**
     * Edit customer
     */
    public function edit(User $customer)
    {
        if ($customer->is_admin) {
            abort(404, 'Customer not found');
        }

        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update customer
     */
        public function update(Request $request, User $customer)
        {

         
            if ($customer->is_admin) {
                abort(404, 'Customer not found');
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $customer->id,
                'phone' => 'nullable|string',
                'company_name' => 'nullable|string|max:255',
                'credit_limit' => 'nullable|numeric|min:0',
            ]);

            $customer->update($validated);

            return redirect()->route('admin.customers.show', $customer)
                        ->with('success', 'Customer updated successfully!');
        }

    /**
     * Delete customer
     */
    public function destroy(User $customer)
    {
        if ($customer->is_admin) {
            abort(404, 'Customer not found');
        }

        $name = $customer->name;
        $customer->delete();

        return redirect()->route('admin.customers.index')
                       ->with('success', "Customer '{$name}' deleted successfully!");
    }
}