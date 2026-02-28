@extends('layouts.app')

@section('title', isset($vmSku) ? 'Edit VM SKU' : 'Add VM SKU')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-mtn-black text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">{{ isset($vmSku) ? 'Edit VM SKU' : 'Add VM SKU' }}</h1>
        </div>
    </div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ isset($vmSku) ? route('admin.vm-skus.update', $vmSku) : route('admin.vm-skus.store') }}" 
              method="POST" class="bg-white rounded-lg shadow p-8">
            @csrf
            @if(isset($vmSku))
                @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">SKU Name *</label>
                    <input type="text" name="name" value="{{ old('name', $vmSku->name ?? '') }}" required
                           class="w-full border rounded px-4 py-2"
                           placeholder="e.g., Standard_D2s_v3">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full border rounded px-4 py-2"
                              placeholder="Describe this VM configuration...">{{ old('description', $vmSku->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- vCPUs -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">vCPUs *</label>
                    <input type="number" name="vcpus" value="{{ old('vcpus', $vmSku->vcpus ?? '') }}" 
                           min="1" max="128" required
                           class="w-full border rounded px-4 py-2">
                    @error('vcpus')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- RAM -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RAM (GB) *</label>
                    <input type="number" name="ram_gb" value="{{ old('ram_gb', $vmSku->ram_gb ?? '') }}" 
                           min="1" max="1024" required
                           class="w-full border rounded px-4 py-2">
                    @error('ram_gb')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price per Month (XAF) *</label>
                    <input type="number" name="price_monthly" value="{{ old('price_monthly', $vmSku->price_monthly ?? '') }}" 
                           step="0.01" min="0" required
                           class="w-full border rounded px-4 py-2">
                    @error('price_monthly')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Currency -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency *</label>
                    <select name="currency" required class="w-full border rounded px-4 py-2">
                        <option value="XAF" {{ old('currency', $vmSku->currency ?? 'XAF') == 'XAF' ? 'selected' : '' }}>XAF (Cameroon)</option>
                        <option value="ZAR" {{ old('currency', $vmSku->currency ?? '') == 'ZAR' ? 'selected' : '' }}>ZAR (South Africa)</option>
                        <option value="GHS" {{ old('currency', $vmSku->currency ?? '') == 'GHS' ? 'selected' : '' }}>GHS (Ghana)</option>
                    </select>
                </div>
                
                <!-- Active Status -->
                <div class="md:col-span-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $vmSku->is_active ?? true) ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-sm font-medium">Active (Available for customers to order)</span>
                    </label>
                </div>
            </div>
            
            <div class="flex space-x-4 mt-8">
                <button type="submit" class="btn-mtn px-8 py-3 rounded-lg font-bold">
                    {{ isset($vmSku) ? 'Update VM SKU' : 'Create VM SKU' }}
                </button>
                <a href="{{ route('admin.vm-skus.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
