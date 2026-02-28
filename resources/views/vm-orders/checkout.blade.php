@extends('layouts.customer')

@section('title', 'VM Order Checkout')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Complete Your VM Order</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form -->
    <div class="lg:col-span-2">
        <form method="POST" action="{{ route('customer.vm-orders.store') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="product_name" value="{{ $product->name }}">
            <input type="hidden" name="quantity" value="{{ request()->quantity }}">
            <input type="hidden" name="total_amount" value="{{ request()->total_amount }}">

            <!-- Customer Info -->
            <div class="bg-white rounded-lg shadow p-8">
                <h2 class="text-xl font-bold text-mtn-black mb-6">Customer Information</h2>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Organization Name *</label>
                    <input type="text" name="organization_name" required value="{{ Auth::user()->company_name }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" required value="{{ Auth::user()->email }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone *</label>
                    <input type="text" name="phone" required value="{{ Auth::user()->phone }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Number of Users *</label>
                    <input type="number" name="number_of_users" required min="1"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Special Requirements</label>
                    <textarea name="special_requirements" rows="4"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow"></textarea>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-lg shadow p-8">
                <h2 class="text-xl font-bold text-mtn-black mb-6">Payment Method</h2>
                
                <div class="space-y-3">
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                        <input type="radio" name="payment_method" value="mtn_momo" required class="w-4 h-4">
                        <span class="ml-3">
                            <span class="block font-semibold">MTN Mobile Money</span>
                            <span class="text-sm text-gray-600">Pay with MTN +237</span>
                        </span>
                    </label>
                    
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                        <input type="radio" name="payment_method" value="orange_money" required class="w-4 h-4">
                        <span class="ml-3">
                            <span class="block font-semibold">Orange Money</span>
                            <span class="text-sm text-gray-600">Pay with Orange +237</span>
                        </span>
                    </label>
                    
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                        <input type="radio" name="payment_method" value="card" required class="w-4 h-4">
                        <span class="ml-3">
                            <span class="block font-semibold">Credit/Debit Card</span>
                            <span class="text-sm text-gray-600">Visa, Mastercard, Amex</span>
                        </span>
                    </label>

                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                        <input type="radio" name="payment_method" value="credit" required class="w-4 h-4">
                        <span class="ml-3">
                            <span class="block font-semibold">Credit Limit</span>
                            <span class="text-sm text-gray-600">Available: {{ number_format(Auth::user()->getAvailableCredit(), 0) }} XAF</span>
                        </span>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-mtn-yellow text-black py-4 rounded-lg font-bold text-lg hover:bg-mtn-orange transition">
                Complete Order
            </button>
        </form>
    </div>

    <!-- Order Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-8 sticky top-24">
            <h2 class="text-xl font-bold text-mtn-black mb-6">Order Summary</h2>

            <div class="space-y-4 mb-6 pb-6 border-b-2 border-gray-200">
                <div class="flex justify-between">
                    <span class="text-gray-700">{{ $product->name }}</span>
                    <span class="font-semibold">{{ number_format(request()->total_amount, 0) }} XAF</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-700">Quantity</span>
                    <span class="font-semibold">{{ request()->quantity }}</span>
                </div>
            </div>

            <div class="flex justify-between mb-6">
                <span class="text-xl font-bold text-mtn-black">Total</span>
                <span class="text-3xl font-bold text-mtn-yellow">{{ number_format(request()->total_amount * request()->quantity, 0) }} XAF</span>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg text-sm text-blue-900">
                <p><strong>Product:</strong> {{ $product->name }}</p>
                <p class="mt-2"><strong>Category:</strong> {{ $product->category }}</p>
            </div>
        </div>
    </div>
</div>

@endsection