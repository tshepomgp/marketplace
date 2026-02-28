@extends('layouts.app')

@section('title', isset($operatingSystem) ? 'Edit Operating System' : 'Add Operating System')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-mtn-black text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">{{ isset($operatingSystem) ? 'Edit Operating System' : 'Add Operating System' }}</h1>
        </div>
    </div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ isset($operatingSystem) ? route('admin.operating-systems.update', $operatingSystem) : route('admin.operating-systems.store') }}" 
              method="POST" class="bg-white rounded-lg shadow p-8">
            @csrf
            @if(isset($operatingSystem))
                @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">OS Name *</label>
                    <input type="text" name="name" value="{{ old('name', $operatingSystem->name ?? '') }}" required
                           class="w-full border rounded px-4 py-2"
                           placeholder="e.g., Windows Server">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Version -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Version *</label>
                    <input type="text" name="version" value="{{ old('version', $operatingSystem->version ?? '') }}" required
                           class="w-full border rounded px-4 py-2"
                           placeholder="e.g., 2022">
                    @error('version')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select name="type" required class="w-full border rounded px-4 py-2">
                        <option value="Windows" {{ old('type', $operatingSystem->type ?? '') == 'Windows' ? 'selected' : '' }}>Windows</option>
                        <option value="Linux" {{ old('type', $operatingSystem->type ?? '') == 'Linux' ? 'selected' : '' }}>Linux</option>
                    </select>
                    @error('type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- License Cost -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">License Cost (XAF/month) *</label>
                    <input type="number" name="license_cost" value="{{ old('license_cost', $operatingSystem->license_cost ?? '0') }}" 
                           step="0.01" min="0" required
                           class="w-full border rounded px-4 py-2">
                    <p class="text-xs text-gray-600 mt-1">Set to 0 for free OS like Ubuntu</p>
                    @error('license_cost')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Active Status -->
                <div class="md:col-span-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $operatingSystem->is_active ?? true) ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-sm font-medium">Active (Available for customers to select)</span>
                    </label>
                </div>
            </div>
            
            <div class="flex space-x-4 mt-8">
                <button type="submit" class="btn-mtn px-8 py-3 rounded-lg font-bold">
                    {{ isset($operatingSystem) ? 'Update OS' : 'Create OS' }}
                </button>
                <a href="{{ route('admin.operating-systems.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
