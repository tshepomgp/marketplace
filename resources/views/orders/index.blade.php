<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($orders->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Orders Yet</h3>
                    <p class="text-gray-600 mb-6">Start by purchasing Microsoft licenses for your team</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-yellow-400 text-black px-8 py-3 rounded-lg font-bold hover:bg-yellow-500">
                        Browse Products
                    </a>
                </div>
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-6">Order History</h3>
                    
                    <div class="space-y-4">
                        @foreach($orders as $order)
                        <div class="border rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="font-bold text-lg">{{ $order->order_number }}</h4>
                                    <p class="text-sm text-gray-600">{{ $order->created_at->format('F d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-xl">{{ number_format($order->total, 0) }} XAF</p>
                                    <span class="inline-block px-3 py-1 text-xs rounded-full {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="border-t pt-4">
                                <h5 class="font-semibold mb-2">Items:</h5>
                                <ul class="space-y-1 mb-4">
                                    @foreach($order->items as $item)
                                    <li class="text-sm text-gray-700">
                                        {{ $item->product_name }} (x{{ $item->quantity }}) - {{ number_format($item->total_price, 0) }} XAF
                                    </li>
                                    @endforeach
                                </ul>
                                
                                <div class="flex space-x-3">
                                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        View Details →
                                    </a>
                                    @if($order->payment_status === 'paid')
                                    <a href="{{ route('orders.invoice', $order) }}" class="text-green-600 hover:text-green-800 text-sm font-semibold">
                                        Download Invoice
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
