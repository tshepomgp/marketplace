@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.products.index') }}" class="text-mtn-yellow hover:text-mtn-orange font-semibold">
        ← Back to Products
    </a>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-3xl">
    <h1 class="text-3xl font-bold text-mtn-black mb-8">
        {{ isset($product) ? 'Edit Product' : 'Add New Product' }}
    </h1>
    
    <form method="POST" action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" 
          enctype="multipart/form-data">
        @csrf
        {{ isset($product) ? '@method("PUT")' : '' }}
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Product Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name *</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                       value="{{ old('name', $product->name ?? '') }}" placeholder="Microsoft 365 Business Standard">
                @error('name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <!-- SKU Code -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">SKU Code *</label>
                <input type="text" name="sku_code" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow font-mono"
                       value="{{ old('sku_code', $product->sku_code ?? '') }}" placeholder="BUSINESS_STANDARD">
                @error('sku_code')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                <select name="category" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                    <option value="">Select Category</option>
                    <option value="microsoft_365" {{ old('category', $product->category ?? '') === 'microsoft_365' ? 'selected' : '' }}>Microsoft 365</option>
                    <option value="office_365" {{ old('category', $product->category ?? '') === 'office_365' ? 'selected' : '' }}>Office 365</option>
                    <option value="windows" {{ old('category', $product->category ?? '') === 'windows' ? 'selected' : '' }}>Windows</option>
                    <option value="dynamics" {{ old('category', $product->category ?? '') === 'dynamics' ? 'selected' : '' }}>Dynamics 365</option>
                    <option value="power" {{ old('category', $product->category ?? '') === 'power' ? 'selected' : '' }}>Power Platform</option>
                </select>
                @error('category')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <!-- Price -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Price (XAF) *</label>
                <input type="number" name="price" required step="100"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                       value="{{ old('price', $product->price ?? '') }}" placeholder="12000">
                @error('price')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <!-- Description -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                      placeholder="Enter product description">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
        
        <!-- Features -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Features (One per line)</label>
            <textarea name="features" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow font-mono text-sm"
                      placeholder="Desktop applications&#10;Cloud services&#10;1TB storage">{{ old('features', $product->features ?? '') }}</textarea>
            <p class="text-gray-600 text-sm mt-1">Each feature on a new line</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Available Quantity -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Available Quantity *</label>
                <input type="number" name="available_quantity" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                       value="{{ old('available_quantity', $product->available_quantity ?? 999) }}" placeholder="999">
                @error('available_quantity')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <!-- Minimum Order -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Minimum Order Qty</label>
                <input type="number" name="minimum_order_quantity"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                       value="{{ old('minimum_order_quantity', $product->minimum_order_quantity ?? 1) }}" placeholder="1">
            </div>
            
            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                    <option value="active" {{ old('status', $product->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $product->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        
        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit" class="bg-mtn-yellow text-black px-8 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                {{ isset($product) ? '✓ Update Product' : '✓ Create Product' }}
            </button>
            <a href="{{ route('admin.products.index') }}" 
               class="bg-gray-300 text-black px-8 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection
