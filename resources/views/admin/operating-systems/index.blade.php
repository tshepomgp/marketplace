@extends('layouts.app')

@section('title', 'Operating Systems - Admin')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="bg-mtn-black text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Operating Systems</h1>
                    <p class="text-gray-400">Manage available OS options for VMs</p>
                </div>
                <a href="{{ route('admin.operating-systems.create') }}" class="btn-mtn px-6 py-3 rounded-lg font-bold">
                    + Add Operating System
                </a>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold">All Operating Systems</h2>
            </div>
            
            @if($operatingSystems->isEmpty())
            <div class="p-12 text-center">
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Operating Systems Yet</h3>
                <p class="text-gray-600 mb-6">Add your first operating system</p>
                <a href="{{ route('admin.operating-systems.create') }}" class="btn-mtn px-8 py-3 rounded-lg font-bold inline-block">
                    Add Operating System
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Version</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">License Cost</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Orders</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($operatingSystems as $os)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <p class="font-semibold">{{ $os->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm">{{ $os->version }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $os->type == 'Windows' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $os->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold">{{ number_format($os->license_cost, 0) }} XAF</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm font-semibold">
                                    {{ $os->vm_orders_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.operating-systems.toggle', $os) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded text-xs font-semibold {{ $os->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $os->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.operating-systems.edit', $os) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.operating-systems.destroy', $os) }}" method="POST" onsubmit="return confirm('Delete this OS?')">
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
                {{ $operatingSystems->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
