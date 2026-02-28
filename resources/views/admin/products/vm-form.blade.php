@extends('layouts.admin')

@section('page_title', $product ?? 'Add New VM Product')

@section('content')
<div class="bg-white rounded-lg shadow p-8">
    <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                <input type="text" name="name" value="{{ $product->name ?? old('name') }}" required 
                    placeholder="e.g., Microsoft 365 Business Standard - Medium VM"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- SKU Code -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">SKU Code *</label>
                <input type="text" name="sku_code" value="{{ $product->sku_code ?? old('sku_code') }}" required 
                    placeholder="e.g., VM_B_MED_2024"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('sku_code') border-red-500 @enderror"
                    {{ isset($product) ? 'readonly' : '' }}>
                @error('sku_code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                <select name="category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('category') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    <option value="microsoft_365" {{ ($product->category ?? old('category')) === 'microsoft_365' ? 'selected' : '' }}>Microsoft 365</option>
                    <option value="office_365" {{ ($product->category ?? old('category')) === 'office_365' ? 'selected' : '' }}>Office 365</option>
                    <option value="windows" {{ ($product->category ?? old('category')) === 'windows' ? 'selected' : '' }}>Windows</option>
                    <option value="dynamics" {{ ($product->category ?? old('category')) === 'dynamics' ? 'selected' : '' }}>Dynamics</option>
                    <option value="power" {{ ($product->category ?? old('category')) === 'power' ? 'selected' : '' }}>Power</option>
                </select>
                @error('category') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Monthly Price (XAF) *</label>
                <input type="number" step="100" name="price" value="{{ $product->price ?? old('price') }}" required 
                    placeholder="e.g., 50000"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('price') border-red-500 @enderror">
                @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Available Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Available Quantity *</label>
                <input type="number" name="available_quantity" value="{{ $product->available_quantity ?? old('available_quantity') ?? 999 }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('available_quantity') border-red-500 @enderror">
                @error('available_quantity') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Minimum Order Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Order Quantity *</label>
                <input type="number" name="minimum_order_quantity" value="{{ $product->minimum_order_quantity ?? old('minimum_order_quantity') ?? 1 }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('minimum_order_quantity') border-red-500 @enderror">
                @error('minimum_order_quantity') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('status') border-red-500 @enderror">
                    <option value="active" {{ ($product->status ?? old('status') ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ ($product->status ?? old('status')) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="3" placeholder="Product description..." 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow @error('description') border-red-500 @enderror">{{ $product->description ?? old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- VM Specifications -->
        <div class="mt-6 p-6 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-bold text-mtn-black mb-4">VM Specifications</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Operating System -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Operating System</label>
                    <input type="text" id="spec_os" placeholder="e.g., Windows Server 2022 Standard" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <!-- CPU -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">CPU</label>
                    <input type="text" id="spec_cpu" placeholder="e.g., 4 vCPU" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <!-- RAM -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RAM</label>
                    <input type="text" id="spec_ram" placeholder="e.g., 8 GB" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <!-- Storage -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Storage</label>
                    <input type="text" id="spec_storage" placeholder="e.g., 100 GB SSD" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <!-- Database -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Database</label>
                    <input type="text" id="spec_database" placeholder="e.g., SQL Server Standard" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <!-- Support Level -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Support Level</label>
                    <input type="text" id="spec_support" placeholder="e.g., 24/7 Priority Support" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <!-- SLA -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Uptime SLA</label>
                    <input type="text" id="spec_sla" placeholder="e.g., 99.99%" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <input type="text" id="spec_location" placeholder="e.g., Cameroon Data Center" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mtn-yellow">
                </div>
            </div>
        </div>

        <!-- Hidden Features Field -->
        <input type="hidden" name="features" id="features">

        <!-- Form Actions -->
        <div class="mt-8 flex space-x-4">
            <button type="submit" class="bg-mtn-yellow text-black px-8 py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
                {{ isset($product) ? 'Update Product' : 'Create Product' }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-300 text-black px-8 py-3 rounded-lg font-bold hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        // Collect specs into JSON
        const specs = {
            os: document.getElementById('spec_os').value || undefined,
            cpu: document.getElementById('spec_cpu').value || undefined,
            ram: document.getElementById('spec_ram').value || undefined,
            storage: document.getElementById('spec_storage').value || undefined,
            database: document.getElementById('spec_database').value || undefined,
            support: document.getElementById('spec_support').value || undefined,
            uptime_sla: document.getElementById('spec_sla').value || undefined,
            location: document.getElementById('spec_location').value || undefined,
        };

        // Remove undefined values
        Object.keys(specs).forEach(key => {
            if (specs[key] === undefined) delete specs[key];
        });

        // Set the features field
        document.getElementById('features').value = JSON.stringify(specs);
    });

    // Load existing specs if editing
    @if(isset($product) && $product->features)
    document.addEventListener('DOMContentLoaded', function() {
        const specs = @json(json_decode($product->features, true));
        if (specs.os) document.getElementById('spec_os').value = specs.os;
        if (specs.cpu) document.getElementById('spec_cpu').value = specs.cpu;
        if (specs.ram) document.getElementById('spec_ram').value = specs.ram;
        if (specs.storage) document.getElementById('spec_storage').value = specs.storage;
        if (specs.database) document.getElementById('spec_database').value = specs.database;
        if (specs.support) document.getElementById('spec_support').value = specs.support;
        if (specs.uptime_sla) document.getElementById('spec_sla').value = specs.uptime_sla;
        if (specs.location) document.getElementById('spec_location').value = specs.location;
    });
    @endif
</script>

@endsection