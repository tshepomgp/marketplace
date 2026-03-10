@extends('layouts.customer')

@section('title', 'Dedicated Servers')

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
            <a href="{{ route('clientzone.dedicated-servers') }}" class="block px-4 py-2 rounded bg-mtn-yellow text-black font-semibold">Dedicated Servers</a>
            <a href="{{ route('clientzone.file-manager') }}" class="block px-4 py-2 rounded hover:bg-gray-700">File Manager</a>
            <a href="{{ route('clientzone.logout') }}" class="block px-4 py-2 rounded hover:bg-gray-700 text-red-400">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-4xl font-bold text-mtn-black mb-2">Self-Managed Dedicated Servers</h1>
        <p class="text-gray-600 mb-8">Full control of your server - you manage everything</p>

        <!-- Server Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Servers</p>
                <p class="text-3xl font-bold text-mtn-black">0</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Running</p>
                <p class="text-3xl font-bold text-green-600">0</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">CPU Usage</p>
                <p class="text-3xl font-bold text-mtn-yellow">0%</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Storage Used</p>
                <p class="text-3xl font-bold text-blue-600">0 GB</p>
            </div>
        </div>

        <!-- Management Tools -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <div class="text-4xl mb-3">🖥️</div>
                <h3 class="text-lg font-bold text-mtn-black">SSH Access</h3>
                <p class="text-gray-600 text-sm mt-2">Connect via SSH with your credentials</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <div class="text-4xl mb-3">🔑</div>
                <h3 class="text-lg font-bold text-mtn-black">SSH Keys</h3>
                <p class="text-gray-600 text-sm mt-2">Manage SSH key pairs for secure access</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <div class="text-4xl mb-3">📊</div>
                <h3 class="text-lg font-bold text-mtn-black">Resource Monitor</h3>
                <p class="text-gray-600 text-sm mt-2">Real-time CPU, RAM & disk usage</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <div class="text-4xl mb-3">💾</div>
                <h3 class="text-lg font-bold text-mtn-black">Snapshots</h3>
                <p class="text-gray-600 text-sm mt-2">Create & restore server snapshots</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <div class="text-4xl mb-3">🔄</div>
                <h3 class="text-lg font-bold text-mtn-black">Reinstall OS</h3>
                <p class="text-gray-600 text-sm mt-2">Reinstall operating system</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition cursor-pointer">
                <div class="text-4xl mb-3">🌐</div>
                <h3 class="text-lg font-bold text-mtn-black">Firewall Rules</h3>
                <p class="text-gray-600 text-sm mt-2">Configure inbound/outbound rules</p>
            </div>
        </div>

        <!-- Available OS -->
        <div class="bg-white rounded-lg shadow p-8 mb-8">
            <h2 class="text-2xl font-bold text-mtn-black mb-6">Available Operating Systems</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="border border-gray-300 p-4 rounded hover:bg-gray-50">
                    <p class="font-bold text-mtn-black">AlmaLinux 9</p>
                    <p class="text-sm text-gray-600">Latest stable release</p>
                </div>
                <div class="border border-gray-300 p-4 rounded hover:bg-gray-50">
                    <p class="font-bold text-mtn-black">CentOS 7</p>
                    <p class="text-sm text-gray-600">Stable & widely used</p>
                </div>
                <div class="border border-gray-300 p-4 rounded hover:bg-gray-50">
                    <p class="font-bold text-mtn-black">Ubuntu 22.04 LTS</p>
                    <p class="text-sm text-gray-600">Popular & well-supported</p>
                </div>
            </div>
        </div>

        <!-- Servers List -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-8 border-b">
                <h2 class="text-2xl font-bold text-mtn-black">Your Dedicated Servers</h2>
            </div>
            
            @if(empty($servers))
            <div class="p-12 text-center">
                <p class="text-gray-600 mb-4">No dedicated servers yet</p>
                <a href="#" class="text-mtn-yellow hover:text-mtn-orange font-semibold">
                    Order a Dedicated Server →
                </a>
            </div>
            @else
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left">Server Name</th>
                        <th class="px-6 py-4 text-left">IP Address</th>
                        <th class="px-6 py-4 text-left">OS</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <!-- Server rows here -->
                </tbody>
            </table>
            @endif
        </div>

        <!-- Documentation -->
        <div class="mt-8 bg-purple-50 border-l-4 border-purple-500 p-6 rounded">
            <h3 class="text-lg font-bold text-purple-900 mb-2">📚 Documentation</h3>
            <p class="text-purple-800 mb-4">Need help? Check our documentation and guides.</p>
            <a href="#" class="text-purple-600 hover:text-purple-800 font-semibold">View Knowledge Base →</a>
        </div>
    </div>
</div>
@endsection
