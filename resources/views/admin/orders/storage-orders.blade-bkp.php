@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-mtn-black">Storage Orders</h1>
    <a href="{{ route('admin.orders.export', 'storage') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
        📥 Export Orders
    </a>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Storage Orders</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total TB Allocated</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">{{ $totalTB }}</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Active Subscriptions</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">{{ $activeSubscriptions }}</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 2a1 1 0 011-1h8a1 1 0 011 1v14a1 1 0 11-2 0V4H7v12a1 1 0 11-2 0V2z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Revenue (This Month)</p>
                <p class="text-3xl font-bold text-mtn-yellow mt-2">{{ number_format($monthlyRevenue, 0) }} XAF</p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.16 2.75a.75.75 0 00-1.08.6v.26h-.5A2.75 2.75 0 003.75 6.16v7.68A2.75 2.75 0 006.5 16.59h7a2.75 2.75 0 002.75-2.75V6.16a2.75 2.75 0 00-2.75-2.75h-.5V3.35a.75.75 0 00-1.5 0v.26H8.16V2.75z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input type="text" name="search" placeholder="Order # or customer" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg" 
                   value="{{ request('search') }}">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Storage Type</label>
            <select name="storage_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All Types</option>
                <option value="standard" {{ request('storage_type') == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="premium" {{ request('storage_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                <option value="enterprise" {{ request('storage_type') == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
            </select>
        </div>
        
        <div></div>
        
        <div class="flex items-end">
            <button type="submit" class="w-full bg-mtn-yellow text-black px-4 py-2 rounded-lg font-semibold hover:bg-mtn-orange transition">
                Filter
            </button>
        </div>
    </form>
</div>

<!-- Storage Orders Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Order #</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Customer</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Storage Type</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Size (TB)</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Monthly Cost</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Renewal</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-bold text-mtn-yellow">{{ $order->order_number }}</td>
                    <td class="px-6 py-4 text-sm font-semibold">{{ $order->customer->company_name }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">
                            {{ ucfirst($order->storage_type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold">{{ $order->storage_size }}</td>
                    <td class="px-6 py-4 font-semibold">{{ number_format($order->monthly_cost, 0) }} XAF</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                            {{ $order->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $order->renewal_date->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.storage-orders.show', $order) }}" class="text-mtn-yellow hover:text-mtn-orange font-semibold">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">No storage orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
   
</div>

@endsection
