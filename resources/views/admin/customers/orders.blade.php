@extends('layouts.app')

@section('title', 'Customer Orders - Admin')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-mtn-black text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">{{ $customer->company_name }} - Orders</h1>
                    <p class="text-gray-400">Complete order history</p>
                </div>
                <a href="{{ route('admin.customers.show', $customer) }}" class="bg-white text-black px-4 py-2 rounded font-semibold hover:bg-gray-100">
                    ← Back
                </a>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600">Order details view coming soon...</p>
        </div>
    </div>
</div>
@endsection
