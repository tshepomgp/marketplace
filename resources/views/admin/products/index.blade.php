@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-mtn-black">Products & SKUs</h1>
    <div class="space-x-2">
        <a href="{{ route('admin.products.create') }}" class="bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
            + Add Product
        </a>
        <a href="{{ route('admin.products.import') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
            📥 Import SKUs
        </a>
    </div>
</div>

<!-- Filter Section -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input type="text" name="search" placeholder="Product name or SKU" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg" 
                   value="{{ request('search') }}">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All Categories</option>
                <option value="microsoft_365" {{ request('category') == 'microsoft_365' ? 'selected' : '' }}>Microsoft 365</option>
                <option value="office_365" {{ request('category') == 'office_365' ? 'selected' : '' }}>Office 365</option>
                <option value="windows" {{ request('category') == 'windows' ? 'selected' : '' }}>Windows</option>
                <option value="dynamics" {{ request('category') == 'dynamics' ? 'selected' : '' }}>Dynamics 365</option>
                <option value="power" {{ request('category') == 'power' ? 'selected' : '' }}>Power Platform</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Availability</label>
            <select name="availability" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All</option>
                <option value="in_stock" {{ request('availability') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                <option value="low_stock" {{ request('availability') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
            </select>
        </div>
        
        <div class="flex items-end">
            <button type="submit" class="w-full bg-mtn-yellow text-black px-4 py-2 rounded-lg font-semibold hover:bg-mtn-orange transition">
                Filter
            </button>
        </div>
    </form>
</div>

<!-- Products Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Product Name</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">SKU Code</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Category</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Price (XAF)</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Stock</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-semibold text-mtn-black">{{ $product->name }}</td>
                    <td class="px-6 py-4 font-mono text-sm">{{ $product->sku_code }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                            {{ ucfirst(str_replace('_', ' ', $product->category)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold">{{ number_format($product->price, 0) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm {{ $product->available_quantity > 10 ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                            {{ $product->available_quantity }} units
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.products.show', $product) }}" 
                           class="text-mtn-yellow hover:text-mtn-orange font-semibold">View</a>
                        <a href="{{ route('admin.products.edit', $product) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                              style="display:inline;" onsubmit="return confirm('Delete this product?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No products found. <a href="{{ route('admin.products.create') }}" class="text-mtn-yellow hover:underline">Create one now</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $products->links() }}
    </div>
</div>

@endsection
