@extends('layouts.admin')

@section('title', 'Colocation Payments')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black">Colocation Payments</h1>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Total Payments</p>
        <p class="text-3xl font-bold text-mtn-black">{{ $stats['total_payments'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Completed</p>
        <p class="text-3xl font-bold text-green-600">{{ $stats['completed'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Pending</p>
        <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Total Revenue</p>
        <p class="text-3xl font-bold text-mtn-yellow">{{ number_format($stats['total_revenue'], 0) }} XAF</p>
    </div>
</div>

<!-- Payments Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left">Order #</th>
                <th class="px-6 py-4 text-left">Customer</th>
                <th class="px-6 py-4 text-left">SKU</th>
                <th class="px-6 py-4 text-right">Amount</th>
                <th class="px-6 py-4 text-left">Method</th>
                <th class="px-6 py-4 text-center">Status</th>
                <th class="px-6 py-4 text-left">Date</th>
                <th class="px-6 py-4 text-center">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($payments as $payment)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-bold text-mtn-yellow">{{ $payment->order->order_number ?? 'N/A' }}</td>
                <td class="px-6 py-4">
                    <p class="font-semibold">{{ $payment->customer->name }}</p>
                    <p class="text-sm text-gray-500">{{ $payment->customer->email }}</p>
                </td>
                <td class="px-6 py-4">{{ $payment->sku->name }}</td>
                <td class="px-6 py-4 text-right font-bold">{{ number_format($payment->amount, 0) }} XAF</td>
                <td class="px-6 py-4">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $payment->payment_status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($payment->payment_status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">{{ $payment->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.colocation-payments.show', $payment) }}" class="text-blue-600 hover:text-blue-800">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-12 text-center text-gray-500">No payments yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-8">
    {{ $payments->links() }}
</div>
@endsection
