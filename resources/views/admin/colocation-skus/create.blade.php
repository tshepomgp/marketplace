@extends('layouts.admin')

@section('title', 'Create Colocation SKU')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black">Create Colocation SKU</h1>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form method="POST" action="{{ route('admin.colocation-skus.store') }}" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-semibold mb-2">SKU Name *</label>
            <input type="text" name="name" required value="{{ old('name') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">SKU Code *</label>
            <input type="text" name="sku_code" required value="{{ old('sku_code') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Type *</label>
                <select name="type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">Select Type</option>
                    <option value="standard">Standard</option>
                    <option value="premium">Premium</option>
                    <option value="enterprise">Enterprise</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Rack Units *</label>
                <input type="number" name="rack_units" required value="{{ old('rack_units') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Monthly Price (XAF) *</label>
                <input type="number" name="monthly_price" required step="0.01" value="{{ old('monthly_price') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Setup Fee (XAF)</label>
                <input type="number" name="setup_fee" step="0.01" value="{{ old('setup_fee') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Power Supply *</label>
            <select name="power_supply" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Select Power</option>
                <option value="single">Single Phase (10A)</option>
                <option value="dual">Dual Phase (20A)</option>
                <option value="three">Three Phase (30A)</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Description</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('description') }}</textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-mtn-yellow text-black px-8 py-2 rounded-lg font-bold">Create SKU</button>
            <a href="{{ route('admin.colocation-skus.index') }}" class="bg-gray-300 text-black px-8 py-2 rounded-lg font-bold">Cancel</a>
        </div>
    </form>
</div>
@endsection
