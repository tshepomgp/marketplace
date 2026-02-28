@extends('layouts.admin')

@section('title', 'Email Hosting Orders')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Email Hosting Orders</h1>
</div>

<!-- Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Total Orders</p>
        <p class="text-3xl font-bold text-mtn-black">{{ $stats['total_orders'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Pending Payment</p>
        <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Paid Orders</p>
        <p class="text-3xl font-bold text-green-600">{{ $stats['paid'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Total Revenue</p>
        <p class="text-3xl font-bold text-mtn-yellow">{{ number_format($stats['total_revenue'], 0) }} XAF</p>
    </div>
</div>

<!-- Orders Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b-2 border-gray-300">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold">Order #</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">Customer</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">Domain</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">Plan</th>
                <th class="px-6 py-4 text-right text-sm font-semibold">Amount</th>
                <th class="px-6 py-4 text-center text-sm font-semibold">Status</th>
                <th class="px-6 py-4 text-center text-sm font-semibold">Date</th>
                <th class="px-6 py-4 text-center text-sm font-semibold">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-bold text-mtn-yellow">{{ $order->order_number }}</td>
                <td class="px-6 py-4">
                    <p class="font-semibold">{{ $order->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                </td>
                <td class="px-6 py-4 font-semibold">{{ $order->domain->domain_name }}</td>
                <td class="px-6 py-4">{{ $order->emailHostingPlan->name }}</td>
                <td class="px-6 py-4 text-right font-bold text-mtn-yellow">{{ number_format($order->total_amount, 0) }} XAF</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">
                    {{ $order->created_at->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.email-hosting.show-order', $order) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                    No email hosting orders yet
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        {{ $orders->links() }}
    </div>
</div>

@endsection