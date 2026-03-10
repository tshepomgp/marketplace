@extends('layouts.customer')

@section('title', 'Order Confirmed')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">✅ Order Confirmed!</h1>
</div>

<div class="bg-green-50 border-2 border-green-500 rounded-lg p-8 text-center mb-8">
    <p class="text-2xl font-bold text-green-900 mb-2">{{ $colocationOrder->order_number }}</p>
    <p class="text-green-700 mb-4">Your colocation order has been placed successfully</p>
    
    <div class="bg-white rounded-lg p-6 mt-6">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 text-sm">Plan</p>
                <p class="font-bold text-mtn-black">{{ ucfirst($colocationOrder->colocation_type) }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Monthly Cost</p>
                <p class="font-bold text-mtn-yellow">{{ number_format($colocationOrder->monthly_cost, 0) }} XAF</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Location</p>
                <p class="font-bold text-mtn-black">{{ ucfirst($colocationOrder->location) }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Status</p>
                <p class="font-bold text-green-600">{{ ucfirst($colocationOrder->status) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="text-center">
    <a href="{{ route('customer.dashboard') }}" class="bg-mtn-yellow text-black px-8 py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
        Return to Dashboard
    </a>
</div>

@endsection
