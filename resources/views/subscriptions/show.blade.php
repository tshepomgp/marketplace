<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p>Subscription details coming soon...</p>
                    <a href="{{ route('subscriptions.index') }}" class="text-blue-600 hover:text-blue-800">
                        ← Back to Subscriptions
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
