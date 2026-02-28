<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Details - {{ $order->order_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">{{ $order->order_number }}</h3>
                            <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Customer Information -->
                    <div class="grid grid-cols-2 gap-6 mb-6 pb-6 border-b">
                        <div>
                            <h4 class="font-semibold mb-2">Customer Information</h4>
                            <p class="text-sm text-gray-700">{{ $order->customer->company_name }}</p>
                            <p class="text-sm text-gray-700">{{ $order->customer->contact_name }}</p>
                            <p class="text-sm text-gray-700">{{ $order->customer->email }}</p>
                            <p class="text-sm text-gray-700">{{ $order->customer->phone }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Billing Address</h4>
                            <p class="text-sm text-gray-700">{{ $order->customer->address }}</p>
                            <p class="text-sm text-gray-700">{{ $order->customer->city }}, {{ $order->customer->country }}</p>
                        </div>
                    </div>
                    
                    <!-- Order Items -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-4">Order Items</h4>
                        <div class="border rounded-lg overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-6 py-4">{{ $item->product_name }}</td>
                                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4">{{ number_format($item->unit_price, 0) }} XAF</td>
                                        <td class="px-6 py-4 font-semibold">{{ number_format($item->total_price, 0) }} XAF</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-semibold">{{ number_format($order->subtotal, 0) }} XAF</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Tax:</span>
                            <span class="font-semibold">{{ number_format($order->tax, 0) }} XAF</span>
                        </div>
                        <div class="flex justify-between text-xl font-bold pt-2 border-t">
                            <span>Total:</span>
                            <span class="text-yellow-600">{{ number_format($order->total, 0) }} XAF</span>
                        </div>
                    </div>
                    
                    <!-- Payment Information -->
                    <div class="mt-6 pt-6 border-t">
                        <h4 class="font-semibold mb-2">Payment Information</h4>
                        <p class="text-sm text-gray-700">Method: <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span></p>
                        @if($order->paid_at)
                        <p class="text-sm text-gray-700">Paid on: <span class="font-semibold">{{ $order->paid_at->format('F d, Y \a\t h:i A') }}</span></p>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-4 mt-6">
                        <a href="{{ route('orders.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-300">
                            ← Back to Orders
                        </a>
                        @if($order->payment_status === 'paid')
                        <a href="{{ route('orders.invoice', $order) }}" class="bg-yellow-400 text-black px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500">
                            Download Invoice
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
