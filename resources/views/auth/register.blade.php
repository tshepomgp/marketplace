<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-2xl font-bold text-center mb-6">Create Your Account</h2>

        <!-- Personal Information -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3 text-gray-700">Personal Information</h3>
            
            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Company Information -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3 text-gray-700">Company Information</h3>
            
            <div class="mb-4">
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="city" :value="__('City')" />
                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="country" :value="__('Country')" />
                    <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="CM" {{ old('country') == 'CM' ? 'selected' : '' }}>Cameroon</option>
                        <option value="ZA" {{ old('country') == 'ZA' ? 'selected' : '' }}>South Africa</option>
                        <option value="GH" {{ old('country') == 'GH' ? 'selected' : '' }}>Ghana</option>
                    </select>
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Microsoft Tenant -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3 text-gray-700">Microsoft Tenant</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Do you have an existing Microsoft tenant?</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="tenant_type" value="new" checked onchange="toggleTenantInput()" class="mr-2">
                        <span class="text-sm">No, create a new tenant for me</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="tenant_type" value="existing" onchange="toggleTenantInput()" class="mr-2">
                        <span class="text-sm">Yes, I have an existing tenant</span>
                    </label>
                </div>
            </div>

            <div id="existingTenantInput" class="hidden mb-4">
                <x-input-label for="existing_tenant_id" :value="__('Existing Tenant ID')" />
                <x-text-input id="existing_tenant_id" class="block mt-1 w-full" type="text" name="existing_tenant_id" :value="old('existing_tenant_id')" />
                <p class="text-xs text-gray-600 mt-1">Find this in your Microsoft Admin Center</p>
                <x-input-error :messages="$errors->get('existing_tenant_id')" class="mt-2" />
            </div>

            <div id="newTenantInfo" class="bg-blue-50 p-4 rounded">
                <p class="text-sm text-gray-700">
                    <strong>New Tenant:</strong> We'll create a Microsoft 365 tenant for your company.
                    You'll be able to manage it after registration.
                </p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
    function toggleTenantInput() {
        const tenantType = document.querySelector('input[name="tenant_type"]:checked').value;
        const existingInput = document.getElementById('existingTenantInput');
        const newInfo = document.getElementById('newTenantInfo');
        
        if (tenantType === 'existing') {
            existingInput.classList.remove('hidden');
            newInfo.classList.add('hidden');
        } else {
            existingInput.classList.add('hidden');
            newInfo.classList.remove('hidden');
        }
    }
    </script>
</x-guest-layout>
