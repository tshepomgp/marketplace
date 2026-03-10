@extends('layouts.customer')

@section('title', 'Managed Servers')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-mtn-black text-white p-6">
        <h2 class="text-2xl font-bold mb-8">Client Zone</h2>
        <nav class="space-y-4">
            <a href="{{ route('clientzone.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('clientzone.email') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Email Accounts</a>
            <a href="{{ route('clientzone.wordpress') }}" class="block px-4 py-2 rounded hover:bg-gray-700">WordPress</a>
            <a href="{{ route('clientzone.managed-servers') }}" class="block px-4 py-2 rounded bg-mtn-yellow text-black font-semibold">Managed Servers</a>
            <a href="{{ route('clientzone.dedicated-servers') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dedicated Servers</a>
            <a href="{{ route('clientzone.file-manager') }}" class="block px-4 py-2 rounded hover:bg-gray-700">File Manager</a>
            <a href="{{ route('clientzone.logout') }}" class="block px-4 py-2 rounded hover:bg-gray-700 text-red-400">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-4xl font-bold text-mtn-black mb-2">Managed Servers</h1>
        <p class="text-gray-600 mb-8">MTN manages your server - you focus on your business</p>

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
                <p class="text-gray-600 text-sm">Uptime</p>
                <p class="text-3xl font-bold text-mtn-yellow">99.9%</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Support Tickets</p>
                <p class="text-3xl font-bold text-blue-600">0</p>
            </div>
        </div>

        <!-- Services -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- What We Do -->
            <div class="bg-white rounded-lg shadow p-8">
                <h2 class="text-2xl font-bold text-mtn-black mb-6">✅ What MTN Does</h2>
                <ul class="space-y-3">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        24/7 Server Monitoring
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Daily Automated Backups
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Security Patches & Updates
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Performance Optimization
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Priority Support
                    </li>
                </ul>
            </div>

            <!-- Running Stack -->
            <div class="bg-white rounded-lg shadow p-8">
                <h2 class="text-2xl font-bold text-mtn-black mb-6">🔧 Standard Stack</h2>
                <div class="space-y-3">
                    <div class="border-l-4 border-red-500 p-3 bg-red-50">
                        <p class="text-sm text-gray-600">Operating System</p>
                        <p class="font-bold text-mtn-black">AlmaLinux 9</p>
                    </div>
                    <div class="border-l-4 border-blue-500 p-3 bg-blue-50">
                        <p class="text-sm text-gray-600">Web Server</p>
                        <p class="font-bold text-mtn-black">Nginx 1.24</p>
                    </div>
                    <div class="border-l-4 border-purple-500 p-3 bg-purple-50">
                        <p class="text-sm text-gray-600">PHP Version</p>
                        <p class="font-bold text-mtn-black">PHP 8.2</p>
                    </div>
                    <div class="border-l-4 border-green-500 p-3 bg-green-50">
                        <p class="text-sm text-gray-600">Database</p>
                        <p class="font-bold text-mtn-black">MySQL 8.0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Servers List -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-8 border-b">
                <h2 class="text-2xl font-bold text-mtn-black">Your Managed Servers</h2>
            </div>
            
            @if(empty($servers))
            <div class="p-12 text-center">
                <p class="text-gray-600 mb-4">No managed servers yet</p>
                <a href="#" class="text-mtn-yellow hover:text-mtn-orange font-semibold">
                    Order a Managed Server →
                </a>
            </div>
            @else
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left">Server Name</th>
                        <th class="px-6 py-4 text-left">IP Address</th>
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

        <!-- Support Section -->
        <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
            <h3 class="text-lg font-bold text-blue-900 mb-2">Need Assistance?</h3>
            <p class="text-blue-800">Our support team is available 24/7. Submit a support ticket or call us.</p>
            <button class="mt-3 bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">
                Create Support Ticket
            </button>
        </div>
    </div>
</div>
@endsection
