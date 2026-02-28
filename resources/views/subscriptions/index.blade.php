<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Subscriptions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-6">Active Subscriptions</h3>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-blue-900 mb-1">Manage Your Subscriptions</h4>
                                <p class="text-sm text-blue-800">Your active Microsoft licenses are provisioned to your tenant. Log in to the Microsoft Admin Center to assign them to users.</p>
                                <a href="https://admin.microsoft.com" target="_blank" class="inline-block mt-2 text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                    Go to Admin Center →
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4">Subscription management will be available here soon. For now, manage your licenses through the Microsoft Admin Center.</p>
                    
                    <a href="{{ route('products.index') }}" class="inline-block bg-yellow-400 text-black px-6 py-3 rounded-lg font-bold hover:bg-yellow-500">
                        Purchase More Licenses
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
