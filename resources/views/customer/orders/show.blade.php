@extends('layouts.customer')

@section('title', 'Order Details')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Order Details</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Info -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow p-8 mb-8">
            <h2 class="text-2xl font-bold text-mtn-black mb-6">{{ $order->order_number }}</h2>

            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-gray-600 text-sm">Order Date</p>
                    <p class="text-lg font-bold text-mtn-black">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Status</p>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Payment Status</p>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Payment Method</p>
                    <p class="text-lg font-bold text-mtn-black">{{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}</p>
                </div>
            </div>
        </div>

        <!-- Items -->
        <div class="bg-white rounded-lg shadow p-8">
            <h3 class="text-xl font-bold text-mtn-black mb-6">Items</h3>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Product</th>
                        <th class="px-4 py-3 text-center">Quantity</th>
                        <th class="px-4 py-3 text-right">Unit Price</th>
                        <th class="px-4 py-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr>
                        <td class="px-4 py-3">{{ $order->product->name ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-center">{{ $order->quantity }}</td>
                        <td class="px-4 py-3 text-right">{{ number_format($order->total / $order->quantity, 0) }} XAF</td>
                        <td class="px-4 py-3 text-right font-bold">{{ number_format($order->total, 0) }} XAF</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-8 sticky top-24">
            <h3 class="text-xl font-bold text-mtn-black mb-6">Order Summary</h3>

            <div class="space-y-3 mb-6 pb-6 border-b-2 border-gray-200">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span class="font-semibold">{{ number_format($order->subtotal, 0) }} XAF</span>
                </div>
                @if($order->tax)
                <div class="flex justify-between">
                    <span>Tax</span>
                    <span class="font-semibold">{{ number_format($order->tax, 0) }} XAF</span>
                </div>
                @endif
            </div>

            <div class="flex justify-between mb-6">
                <span class="text-lg font-bold">Total</span>
                <span class="text-2xl font-bold text-mtn-yellow">{{ number_format($order->total, 0) }} XAF</span>
            </div>

            @if($order->payment_status === 'pending')
            <button class="w-full bg-mtn-yellow text-black py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
                Complete Payment
            </button>
            @endif
        </div>
    </div>
</div>

@endsection
