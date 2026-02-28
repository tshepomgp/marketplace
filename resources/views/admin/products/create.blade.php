@extends('layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-mtn-black text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>
        </div>
    </div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" 
              method="POST" class="bg-white rounded-lg shadow p-8">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Product Name -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                           class="w-full border rounded px-4 py-2"
                           placeholder="Microsoft 365 Business Standard">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea name="description" rows="4" required
                              class="w-full border rounded px-4 py-2"
                              placeholder="Describe the product features...">{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select name="category" required class="w-full border rounded px-4 py-2">
                        <option value="">Select Category</option>
                        <option value="Microsoft 365" {{ old('category', $product->category ?? '') == 'Microsoft 365' ? 'selected' : '' }}>Microsoft 365</option>
                        <option value="Office 365" {{ old('category', $product->category ?? '') == 'Office 365' ? 'selected' : '' }}>Office 365</option>
                        <option value="Windows" {{ old('category', $product->category ?? '') == 'Windows' ? 'selected' : '' }}>Windows</option>
                        <option value="Azure" {{ old('category', $product->category ?? '') == 'Azure' ? 'selected' : '' }}>Azure</option>
                        <option value="Dynamics" {{ old('category', $product->category ?? '') == 'Dynamics' ? 'selected' : '' }}>Dynamics 365</option>
                    </select>
                    @error('category')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Billing Cycle -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Billing Cycle *</label>
                    <select name="billing_cycle" required class="w-full border rounded px-4 py-2">
                        <option value="monthly" {{ old('billing_cycle', $product->billing_cycle ?? '') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ old('billing_cycle', $product->billing_cycle ?? '') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>
                
                <!-- Base Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Base Price (Your Cost) *</label>
                    <input type="number" name="base_price" value="{{ old('base_price', $product->base_price ?? '') }}" 
                           step="0.01" min="0" required
                           class="w-full border rounded px-4 py-2"
                           placeholder="10000">
                    @error('base_price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Selling Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Selling Price (Customer Pays) *</label>
                    <input type="number" name="selling_price" value="{{ old('selling_price', $product->selling_price ?? '') }}" 
                           step="0.01" min="0" required
                           class="w-full border rounded px-4 py-2"
                           placeholder="12000">
                    @error('selling_price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Currency -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency *</label>
                    <select name="currency" required class="w-full border rounded px-4 py-2">
                        <option value="XAF" {{ old('currency', $product->currency ?? 'XAF') == 'XAF' ? 'selected' : '' }}>XAF (Cameroon)</option>
                        <option value="ZAR" {{ old('currency', $product->currency ?? '') == 'ZAR' ? 'selected' : '' }}>ZAR (South Africa)</option>
                        <option value="GHS" {{ old('currency', $product->currency ?? '') == 'GHS' ? 'selected' : '' }}>GHS (Ghana)</option>
                    </select>
                </div>
                
                <!-- Min Quantity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Quantity *</label>
                    <input type="number" name="min_quantity" value="{{ old('min_quantity', $product->min_quantity ?? 1) }}" 
                           min="1" required
                           class="w-full border rounded px-4 py-2">
                </div>
                
                <!-- Max Quantity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Quantity (Optional)</label>
                    <input type="number" name="max_quantity" value="{{ old('max_quantity', $product->max_quantity ?? '') }}" 
                           min="1"
                           class="w-full border rounded px-4 py-2"
                           placeholder="Leave empty for unlimited">
                </div>
                
                <!-- Microsoft Product ID -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Microsoft Product ID (Optional)</label>
                    <input type="text" name="microsoft_product_id" value="{{ old('microsoft_product_id', $product->microsoft_product_id ?? '') }}"
                           class="w-full border rounded px-4 py-2"
                           placeholder="CFQ7TTC0LFLX">
                    <p class="text-xs text-gray-600 mt-1">From Partner Center</p>
                </div>
                
                <!-- Microsoft SKU ID -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Microsoft SKU ID (Optional)</label>
                    <input type="text" name="microsoft_sku_id" value="{{ old('microsoft_sku_id', $product->microsoft_sku_id ?? '') }}"
                           class="w-full border rounded px-4 py-2"
                           placeholder="0001">
                    <p class="text-xs text-gray-600 mt-1">From Partner Center</p>
                </div>
                
                <!-- Checkboxes -->
                <div class="md:col-span-2 space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-sm font-medium">Active (Show on website)</span>
                    </label>
                    
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-sm font-medium">Featured (Show on homepage)</span>
                    </label>
                </div>
            </div>
            
            <div class="flex space-x-4 mt-8">
                <button type="submit" class="btn-mtn px-8 py-3 rounded-lg font-bold">
                    {{ isset($product) ? 'Update Product' : 'Create Product' }}
                </button>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
