@extends('layouts.customer')

@section('title', 'My Storage Orders')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">My Storage Orders</h1>
    <p class="text-gray-600">Manage your cloud storage subscriptions</p>
</div>

@if($storageOrders->count() > 0)
    <!-- Storage Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Order #</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Size</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Monthly Cost</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Billing</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Renewal</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($storageOrders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-bold text-mtn-yellow">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                {{ ucfirst($order->storage_type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold">{{ $order->storage_size }} TB</td>
                        <td class="px-6 py-4 font-semibold text-mtn-yellow">{{ number_format($order->monthly_cost, 0) }} XAF</td>
                        <td class="px-6 py-4 text-sm">{{ ucfirst($order->billing_cycle) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium 
                                {{ $order->status === 'active' ? 'bg-green-100 text-green-800' : ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($order->renewal_date)
                                {{ $order->renewal_date->format('M d, Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('customer.storage-orders.show', $order->id) }}" class="text-mtn-yellow hover:text-mtn-orange font-semibold">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $storageOrders->links() }}
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
        </svg>
        
        <h2 class="text-2xl font-bold text-mtn-black mb-2">No Storage Orders Yet</h2>
        <p class="text-gray-600 mb-6">You haven't ordered any cloud storage yet.</p>
        
        <a href="{{ route('customer.products.storage-ordering') }}" class="inline-block bg-mtn-yellow text-black px-8 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
            Order Storage Now
        </a>
    </div>
@endif

@endsection