<!DOCTYPE html>
<html>
<head>
    <title>Email Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@extends('layouts.customer')

@section('title', 'Email Hosting')

@section('content')

<body class="bg-gray-50">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-mtn-black text-white p-6">
        <h2 class="text-2xl font-bold mb-8">Client Zone</h2>
        <nav class="space-y-4">
            <a href="{{ route('clientzone.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('clientzone.email') }}" class="block px-4 py-2 rounded bg-mtn-yellow text-black font-semibold">Email Accounts</a>
            <a href="{{ route('clientzone.wordpress') }}" class="block px-4 py-2 rounded hover:bg-gray-700">WordPress</a>
            <a href="{{ route('clientzone.logout') }}" class="block px-4 py-2 rounded hover:bg-gray-700 text-red-400">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-4xl font-bold text-mtn-black mb-8">Email Accounts</h1>

        @forelse($account as $acc)
        <div class="bg-white rounded-lg shadow p-8 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">{{ $acc->email_address }}</h2>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">{{ ucfirst($acc->status) }}</span>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-gray-600 text-sm">IMAP Server</p>
                    <p class="font-bold">{{ $acc->imap_host }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">IMAP Port</p>
                    <p class="font-bold">{{ $acc->imap_port }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">SMTP Server</p>
                    <p class="font-bold">{{ $acc->smtp_host }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">SMTP Port</p>
                    <p class="font-bold">{{ $acc->smtp_port }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Storage</p>
                    <p class="font-bold">{{ $acc->storage_gb }} GB</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Used Storage</p>
                    <p class="font-bold">{{ $acc->storage_used_gb }} GB</p>
                </div>
            </div>

            <div class="bg-blue-50 p-4 rounded border-l-4 border-blue-500">
                <p class="text-sm text-blue-900"><strong>Setup Instructions:</strong> Use the IMAP/SMTP settings above to configure your email client (Outlook, Gmail, Thunderbird, etc.)</p>
            </div>

            <!-- Domain Info -->
            @if($acc->domain)
            <div class="mt-6 pt-6 border-t">
                <h3 class="text-lg font-bold text-mtn-black mb-3">Domain Information</h3>
                <p class="text-gray-600"><strong>Domain:</strong> {{ $acc->domain->domain_name }}</p>
                <p class="text-gray-600"><strong>Status:</strong> {{ ucfirst($acc->domain->status) }}</p>
            </div>
            @endif
        </div>
        @empty
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <p class="text-gray-600 mb-4">No email accounts found</p>
            <a href="{{ route('customer.email-hosting.index') }}" class="text-mtn-yellow hover:text-mtn-orange font-semibold">
                Order Email Hosting →
            </a>
        </div>
        @endforelse
    </div>
</div>
</body>
</html>
@endsection
