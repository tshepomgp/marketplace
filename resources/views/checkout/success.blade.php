@extends('layouts.app')

@section('title', 'Order Complete')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-8">
        <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Complete!</h1>
        <p class="text-gray-600">Thank you for your purchase</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-4">Order Details</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Order Number:</span>
                    <span class="font-semibold ml-2">{{ $order->order_number }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Date:</span>
                    <span class="font-semibold ml-2">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Company:</span>
                    <span class="font-semibold ml-2">{{ $order->customer->company_name }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Total:</span>
                    <span class="font-semibold ml-2">{{ number_format($order->total, 0) }} XAF</span>
                </div>
            </div>
        </div>
        
        <div class="border-t pt-6 mb-6">
            <h3 class="font-bold mb-4">What Happens Next?</h3>
            <div class="space-y-3">
                <div class="flex items-start">
                    <div class="bg-mtn-yellow rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mr-3">
                        <span class="font-bold text-black">1</span>
                    </div>
                    <div>
                        <p class="font-semibold">Check Your Email</p>
                        <p class="text-sm text-gray-600">We'll send your Microsoft tenant credentials to {{ $order->customer->email }}</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-mtn-yellow rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mr-3">
                        <span class="font-bold text-black">2</span>
                    </div>
                    <div>
                        <p class="font-semibold">Login to Microsoft Admin Center</p>
                        <p class="text-sm text-gray-600">Use your credentials to access your tenant</p>
                        <a href="https://admin.microsoft.com" target="_blank" 
                           class="text-blue-600 hover:underline text-sm">
                            Go to Admin Center →
                        </a>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-mtn-yellow rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mr-3">
                        <span class="font-bold text-black">3</span>
                    </div>
                    <div>
                        <p class="font-semibold">Add Your Users</p>
                        <p class="text-sm text-gray-600">Assign licenses to your employees</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="border-t pt-6">
            <h3 class="font-bold mb-3">Your Order</h3>
            <div class="space-y-2">
                @foreach($order->items as $item)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                    <div>
                        <p class="font-semibold">{{ $item->product_name }}</p>
                        <p class="text-sm text-gray-600">{{ $item->quantity }} licenses</p>
                    </div>
                    <span class="font-semibold">{{ number_format($item->total_price, 0) }} XAF</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="text-center">
        <a href="{{ route('home') }}" class="btn-mtn px-8 py-3 rounded-lg font-bold inline-block">
            Back to Home
        </a>
    </div>
</div>
@endsection
