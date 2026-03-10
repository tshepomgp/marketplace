
@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-mtn-black text-white p-6">
        <h2 class="text-2xl font-bold mb-8">Client Zone</h2>
        <nav class="space-y-4">
            <a href="{{ route('clientzone.dashboard') }}" class="block px-4 py-2 rounded bg-mtn-yellow text-black font-semibold">Dashboard</a>
            <a href="{{ route('clientzone.email') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Email Accounts</a>
            <a href="{{ route('clientzone.wordpress') }}" class="block px-4 py-2 rounded hover:bg-gray-700">WordPress Manager</a>
            <hr class="my-4">
            <a href="{{ route('clientzone.logout') }}" class="block px-4 py-2 rounded hover:bg-gray-700 text-red-400">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-mtn-black">Welcome, {{ $user->name }}!</h1>
            <p class="text-gray-600">Company: {{ $user->company_name }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Email Accounts</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">{{ $emailAccounts->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Domains</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">{{ $domains->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Storage Used</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">{{ $emailAccounts->sum('storage_used_gb') }} GB</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Uptime</p>
                <p class="text-3xl font-bold text-mtn-black mt-2">99.9%</p>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-bold text-mtn-black mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('clientzone.email') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <p class="text-lg font-bold text-mtn-black">📧 Email Accounts</p>
                    <p class="text-gray-600 text-sm mt-2">Manage {{ $emailAccounts->count() }} email account(s)</p>
                </a>
                <a href="{{ route('clientzone.wordpress') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <p class="text-lg font-bold text-mtn-black">📄 WordPress</p>
                    <p class="text-gray-600 text-sm mt-2">Install & manage WordPress</p>
                </a>
		<a href="{{ route('clientzone.managed-servers') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <p class="text-lg font-bold text-mtn-black">📄 Managed Servers</p>
                    <p class="text-gray-600 text-sm mt-2">Request MTN for assistance manage </p>
                </a>
		<a href="{{ route('clientzone.dedicated-servers') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <p class="text-lg font-bold text-mtn-black">📄 Self Managed - Dedicated Servers</p>
                    <p class="text-gray-600 text-sm mt-2">Install & manage dedicated servers</p>
                </a>
		<a href="{{ route('clientzone.file-manager') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
    <p class="text-lg font-bold text-mtn-black">📁 File Manager</p>
    <p class="text-gray-600 text-sm mt-2">Upload & manage files</p>
</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
