@extends('layouts.customer')

@section('title', 'My VM Orders')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">My VM Orders</h1>
    <p class="text-gray-600">View and manage your Microsoft license orders</p>
</div>

@if($vmOrders->count() > 0)
    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Order #</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Product</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Quantity</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Amount</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($vmOrders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-bold text-mtn-yellow">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-sm">
                            {{ $order->product->name ?? 'Unknown Product' }}
                        </td>
                        <td class="px-6 py-4 font-semibold">{{ $order->quantity }}</td>
                        <td class="px-6 py-4 font-semibold">{{ number_format($order->total_amount, 0) }} XAF</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium 
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('customer.orders.show', $order->id) }}" class="text-mtn-yellow hover:text-mtn-orange font-semibold">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $vmOrders->links() }}
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
        </svg>
        
        <h2 class="text-2xl font-bold text-mtn-black mb-2">No Orders Yet</h2>
        <p class="text-gray-600 mb-6">You haven't placed any VM license orders yet.</p>
        
        <a href="{{ route('customer.products.vm-ordering') }}" class="inline-block bg-mtn-yellow text-black px-8 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
            Order Now
        </a>
    </div>
@endif

@endsection