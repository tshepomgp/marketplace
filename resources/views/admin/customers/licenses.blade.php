@extends('layouts.app')

@section('title', 'Customer Licenses - Admin')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-mtn-black text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">{{ $customer->company_name }} - Licenses</h1>
                    <p class="text-gray-400">All active and inactive subscriptions</p>
                </div>
                <a href="{{ route('admin.customers.show', $customer) }}" class="bg-white text-black px-4 py-2 rounded font-semibold hover:bg-gray-100">
                    ← Back
                </a>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($customer->domain)
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h4 class="font-semibold text-blue-900 mb-1">Microsoft Tenant</h4>
                    <p class="text-sm text-blue-800 font-mono">{{ $customer->domain }}</p>
                    <a href="https://admin.microsoft.com" target="_blank" class="inline-block mt-2 text-blue-600 hover:text-blue-800 font-semibold text-sm">
                        Manage in Microsoft Admin Center →
                    </a>
                </div>
            </div>
        </div>
        @endif
        
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold">All Subscriptions</h2>
            </div>
            
            @if($subscriptions->isEmpty())
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Licenses Yet</h3>
                <p class="text-gray-600">This customer hasn't purchased any licenses</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Next Billing</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Auto-Renew</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($subscriptions as $subscription)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold">{{ $subscription->product->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $subscription->product->category }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-lg">{{ $subscription->quantity }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($subscription->order)
                                <a href="{{ route('admin.customers.orders', $customer) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    {{ $subscription->order->order_number }}
                                </a>
                                @else
                                <span class="text-gray-500 text-sm">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                {{ $subscription->start_date ? $subscription->start_date->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                {{ $subscription->next_billing_date ? $subscription->next_billing_date->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $subscription->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($subscription->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($subscription->auto_renew)
                                <span class="text-green-600 font-semibold text-sm">✓ Yes</span>
                                @else
                                <span class="text-gray-500 text-sm">No</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
