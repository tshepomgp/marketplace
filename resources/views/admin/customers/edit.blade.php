@extends('layouts.admin')

@section('title', 'Edit Customer: ' . $customer->name)

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-mtn-black mb-2">Edit Customer</h1>
            <p class="text-gray-600">Update customer information</p>
        </div>
        <a href="{{ route('admin.customers.show', $customer) }}" class="inline-block bg-gray-300 text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
</div>

<!-- Edit Form -->
<div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl">
    <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Full Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                <input type="text" name="name" value="{{ $customer->name }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('name') border-red-500 @enderror">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                <input type="email" name="email" value="{{ $customer->email }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                <input type="tel" name="phone" value="{{ $customer->phone }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('phone') border-red-500 @enderror">
                @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Company Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Company Name</label>
                <input type="text" name="company_name" value="{{ $customer->company_name }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('company_name') border-red-500 @enderror">
                @error('company_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Read-only Fields -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm text-gray-600 mb-4">Account Information (Read-only)</p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-600">User ID</p>
                        <p class="font-semibold text-gray-900">#{{ $customer->id }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600">Member Since</p>
                        <p class="font-semibold text-gray-900">{{ $customer->created_at->format('M d, Y') }}</p>

                    </div>
                    <!-- In admin customer edit view -->

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Credit Limit (XAF)</label>
                    <input type="number" name="credit_limit" value="{{ $customer->credit_limit }}" step="0.01"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                    
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="bg-mtn-yellow text-black px-8 py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
                    Save Changes
                </button>
                <a href="{{ route('admin.customers.show', $customer) }}" class="bg-gray-300 text-black px-8 py-3 rounded-lg font-bold hover:bg-gray-400 transition">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

@endsection