@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-mtn-black">Storage Orders</h1>
    <a href="{{ route('admin.orders.export', 'vm') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
        📥 Export Orders
    </a>
</div>

<!-- Filter Section -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Order #</label>
            <input type="text" name="search" placeholder="Order number" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg" 
                   value="{{ request('search') }}">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
            <select name="date_range" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="all" {{ request('date_range') == 'all' ? 'selected' : '' }}>All Time</option>
                <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Amount Range</label>
            <select name="amount_range" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All Amounts</option>
                <option value="high" {{ request('amount_range') == 'high' ? 'selected' : '' }}>High (>500,000 XAF)</option>
                <option value="medium" {{ request('amount_range') == 'medium' ? 'selected' : '' }}>Medium (100k-500k)</option>
                <option value="low" {{ request('amount_range') == 'low' ? 'selected' : '' }}>Low (<100,000 XAF)</option>
            </select>
        </div>
        
        <div class="flex items-end">
            <button type="submit" class="w-full bg-mtn-yellow text-black px-4 py-2 rounded-lg font-semibold hover:bg-mtn-orange transition">
                Filter
            </button>
        </div>
    </form>
</div>

<!-- Orders Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Order #</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Customer</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Product</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Size</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Amount</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-bold text-mtn-yellow">{{ $order->order_number }}</td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold">{{ $order->customer->company_name }}</div>
                        <div class="text-xs text-gray-600">{{ $order->customer->contact_name }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $order->storage_type }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $order->storage_size }}</td>
                    <td class="px-6 py-4 font-semibold">{{ number_format($order->monthly_cost, 0) }} XAF</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-mtn-yellow hover:text-mtn-orange font-semibold">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">No VM orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200">
    
    </div>
</div>

@endsection
