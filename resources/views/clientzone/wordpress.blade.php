@extends('layouts.customer')

@section('title', 'WordPress Hosting')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-mtn-black text-white p-6">
        <h2 class="text-2xl font-bold mb-8">Client Zone</h2>
        <nav class="space-y-4">
            <a href="{{ route('clientzone.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('clientzone.email') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Email Accounts</a>
            <a href="{{ route('clientzone.wordpress') }}" class="block px-4 py-2 rounded bg-mtn-yellow text-black font-semibold">WordPress</a>
            <a href="{{ route('clientzone.logout') }}" class="block px-4 py-2 rounded hover:bg-gray-700 text-red-400">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-4xl font-bold text-mtn-black mb-8">WordPress Hosting</h1>

        <div class="bg-white rounded-lg shadow p-8">
            <div class="grid grid-cols-2 gap-8">
                <!-- WordPress Info -->
                <div>
                    <h2 class="text-2xl font-bold text-mtn-black mb-6">Your WordPress Sites</h2>
                    
                    <div class="space-y-4">
                        <div class="border-l-4 border-mtn-yellow p-4 bg-yellow-50">
                            <p class="text-gray-600 text-sm">WordPress Version</p>
                            <p class="font-bold text-mtn-black">6.4.2</p>
                        </div>
                        <div class="border-l-4 border-blue-500 p-4 bg-blue-50">
                            <p class="text-gray-600 text-sm">PHP Version</p>
                            <p class="font-bold text-mtn-black">8.2.30</p>
                        </div>
                        <div class="border-l-4 border-green-500 p-4 bg-green-50">
                            <p class="text-gray-600 text-sm">Database</p>
                            <p class="font-bold text-mtn-black">MySQL 8.0</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div>
                    <h2 class="text-2xl font-bold text-mtn-black mb-6">Quick Actions</h2>
                    
                    <div class="space-y-3">
                        <a href="#" class="block bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition text-center">
                            Access WordPress Admin
                        </a>
                        <a href="#" class="block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center">
                            View File Manager
                        </a>
                        <a href="#" class="block bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition text-center">
                            Database Manager
                        </a>
                        <a href="#" class="block bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition text-center">
                            Backups
                        </a>
                    </div>
                </div>
            </div>

            <!-- Support Info -->
            <div class="mt-8 pt-8 border-t">
                <h3 class="text-lg font-bold text-mtn-black mb-4">Need Help?</h3>
                <p class="text-gray-600">For WordPress support, please contact our support team or visit our knowledge base.</p>
            </div>
        </div>
    </div>
</div>
@endsection
