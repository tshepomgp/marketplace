@extends('layouts.app')

@section('title', 'VM SKUs - Admin')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-mtn-black text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">VM SKUs</h1>
                    <p class="text-gray-400">Manage Azure HCI Virtual Machine configurations</p>
                </div>
                <a href="{{ route('admin.vm-skus.create') }}" class="btn-mtn px-6 py-3 rounded-lg font-bold">
                    + Add VM SKU
                </a>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold">All VM SKUs</h2>
            </div>
            
            @if($skus->isEmpty())
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No VM SKUs Yet</h3>
                <p class="text-gray-600 mb-6">Create your first VM SKU to get started</p>
                <a href="{{ route('admin.vm-skus.create') }}" class="btn-mtn px-8 py-3 rounded-lg font-bold inline-block">
                    Add Your First VM SKU
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">vCPUs</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">RAM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price/Month</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Orders</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($skus as $sku)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold">{{ $sku->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $sku->description }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold">{{ $sku->vcpus }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold">{{ $sku->ram_gb }} GB</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold">{{ number_format($sku->price_monthly, 0) }} {{ $sku->currency }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm font-semibold">
                                    {{ $sku->vm_orders_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.vm-skus.toggle', $sku) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded text-xs font-semibold {{ $sku->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $sku->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.vm-skus.edit', $sku) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.vm-skus.destroy', $sku) }}" method="POST" onsubmit="return confirm('Delete this VM SKU?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t">
                {{ $skus->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
