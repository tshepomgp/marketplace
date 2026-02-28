<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            
            <!-- MTN Logo -->
            <div class="flex justify-center">
                <img class="h-16 w-auto" src="{{ asset('images/mtn-logo.jfif') }}" alt="MTN Logo">
            </div>

            <!-- Heading -->
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-extrabold text-mtn-black">Sign in to your account</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Enter your MTN credentials to access the dashboard
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6 bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:ring-mtn-yellow focus:border-mtn-yellow rounded-md shadow-sm"
                                  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:ring-mtn-yellow focus:border-mtn-yellow rounded-md shadow-sm"
                                  type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-mtn-yellow shadow-sm focus:ring-mtn-yellow" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-mtn-yellow hover:text-mtn-orange font-medium" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-mtn-yellow hover:bg-mtn-orange text-black font-bold py-3 rounded-md transition">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Footer -->
            <p class="mt-6 text-center text-gray-500 text-sm">
                © {{ date('Y') }} MTN. All rights reserved.
            </p>
        </div>
    </div>
</x-guest-layout>
