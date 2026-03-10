@extends('layouts.customer')

@section('title', 'File Manager')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-mtn-black text-white p-6">
        <h2 class="text-2xl font-bold mb-8">Client Zone</h2>
        <nav class="space-y-4">
            <a href="{{ route('clientzone.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('clientzone.email') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Email Accounts</a>
            <a href="{{ route('clientzone.wordpress') }}" class="block px-4 py-2 rounded hover:bg-gray-700">WordPress</a>
            <a href="{{ route('clientzone.managed-servers') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Managed Servers</a>
            <a href="{{ route('clientzone.dedicated-servers') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dedicated Servers</a>
            <a href="{{ route('clientzone.file-manager') }}" class="block px-4 py-2 rounded bg-mtn-yellow text-black font-semibold">File Manager</a>
            <a href="{{ route('clientzone.logout') }}" class="block px-4 py-2 rounded hover:bg-gray-700 text-red-400">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-4xl font-bold text-mtn-black mb-8">File Manager</h1>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <!-- Upload -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-4xl mb-3">📤</div>
                <h3 class="text-lg font-bold text-mtn-black">Upload Files</h3>
                <p class="text-gray-600 text-sm mt-2">Upload files to your server</p>
            </div>

            <!-- Download -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-4xl mb-3">📥</div>
                <h3 class="text-lg font-bold text-mtn-black">Download Files</h3>
                <p class="text-gray-600 text-sm mt-2">Download files from your server</p>
            </div>

            <!-- Create -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-4xl mb-3">📄</div>
                <h3 class="text-lg font-bold text-mtn-black">Create Folder</h3>
                <p class="text-gray-600 text-sm mt-2">Create new directories</p>
            </div>

            <!-- Edit -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-4xl mb-3">✏️</div>
                <h3 class="text-lg font-bold text-mtn-black">Edit Files</h3>
                <p class="text-gray-600 text-sm mt-2">Edit text files online</p>
            </div>
        </div>

        <!-- File Browser -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b flex justify-between items-center">
                <h2 class="text-2xl font-bold text-mtn-black">File Browser</h2>
                <div class="space-x-2">
                    <button class="bg-mtn-yellow text-black px-4 py-2 rounded-lg font-semibold hover:bg-mtn-orange">
                        + Upload
                    </button>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700">
                        + Create Folder
                    </button>
                </div>
            </div>

            <!-- Browser Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left">Name</th>
                            <th class="px-6 py-4 text-left">Type</th>
                            <th class="px-6 py-4 text-left">Size</th>
                            <th class="px-6 py-4 text-left">Modified</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <span class="text-2xl mr-2">📁</span>
                                <span class="font-semibold">public_html</span>
                            </td>
                            <td class="px-6 py-4">Folder</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">Today</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800">Open</a>
                                <a href="#" class="text-red-600 hover:text-red-800">Delete</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <span class="text-2xl mr-2">📄</span>
                                <span class="font-semibold">index.php</span>
                            </td>
                            <td class="px-6 py-4">PHP File</td>
                            <td class="px-6 py-4">2.4 KB</td>
                            <td class="px-6 py-4">Yesterday</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <a href="#" class="text-green-600 hover:text-green-800">Download</a>
                                <a href="#" class="text-red-600 hover:text-red-800">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Disk Usage -->
        <div class="mt-8 bg-white rounded-lg shadow p-8">
            <h2 class="text-2xl font-bold text-mtn-black mb-6">Disk Usage</h2>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total Used</span>
                        <span class="font-bold text-mtn-yellow">450 GB / 500 GB</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-mtn-yellow h-4 rounded-full" style="width: 90%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
