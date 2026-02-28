@extends('layouts.admin')

@section('title', 'Branding Settings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('messages.admin.branding') }}</h1>
        <p class="text-gray-600 mt-2">Customize your platform's branding and appearance</p>
    </div>

    <!-- Country Switcher -->
    <div class="bg-white rounded-lg shadow mb-6 p-6">
        <h2 class="text-xl font-semibold mb-4">Quick Country Switch</h2>
        <p class="text-gray-600 mb-4">Quickly switch to pre-configured country settings</p>
        
        <form action="{{ route('admin.settings.switch-country') }}" method="POST">
            @csrf
            <div class="flex items-end space-x-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Country</label>
                    <select name="country" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="CM" {{ config('branding.country') == 'CM' ? 'selected' : '' }}>🇨🇲 Cameroon (XAF - French)</option>
                        <option value="ZA" {{ config('branding.country') == 'ZA' ? 'selected' : '' }}>🇿🇦 South Africa (ZAR - English)</option>
                        <option value="GH" {{ config('branding.country') == 'GH' ? 'selected' : '' }}>🇬🇭 Ghana (GHS - English)</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary px-6 py-2 rounded-md">Switch Country</button>
            </div>
        </form>
    </div>

    <!-- Branding Form -->
    <div class="bg-white rounded-lg shadow">
        <form action="{{ route('admin.settings.update-branding') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                    <input type="text" name="company_name" value="{{ Setting::get('branding.company_name', config('branding.company_name')) }}" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Country Code</label>
                    <input type="text" name="country" value="{{ Setting::get('branding.country', config('branding.country')) }}" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                           maxlength="2" placeholder="CM" required>
                    <p class="text-xs text-gray-500 mt-1">ISO 2-letter country code (CM, ZA, GH)</p>
                </div>

                <!-- Currency -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency Code</label>
                    <input type="text" name="currency" value="{{ Setting::get('branding.currency', config('branding.currency')) }}" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                           maxlength="3" placeholder="XAF" required>
                </div>

                <!-- Primary Color -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Primary Brand Color</label>
                    <div class="flex space-x-2">
                        <input type="color" name="primary_color" value="{{ Setting::get('branding.primary_color', config('branding.primary_color')) }}" 
                               class="h-10 w-20 border-gray-300 rounded-md cursor-pointer">
                        <input type="text" value="{{ Setting::get('branding.primary_color', config('branding.primary_color')) }}" 
                               class="flex-1 border-gray-300 rounded-md shadow-sm" readonly>
                    </div>
                </div>

                <!-- Secondary Color -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Brand Color</label>
                    <div class="flex space-x-2">
                        <input type="color" name="secondary_color" value="{{ Setting::get('branding.secondary_color', config('branding.secondary_color')) }}" 
                               class="h-10 w-20 border-gray-300 rounded-md cursor-pointer">
                        <input type="text" value="{{ Setting::get('branding.secondary_color', config('branding.secondary_color')) }}" 
                               class="flex-1 border-gray-300 rounded-md shadow-sm" readonly>
                    </div>
                </div>

                <!-- Support Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Support Email</label>
                    <input type="email" name="support_email" value="{{ Setting::get('branding.support_email', config('branding.support_email')) }}" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Support Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Support Phone</label>
                    <input type="text" name="support_phone" value="{{ Setting::get('branding.support_phone', config('branding.support_phone')) }}" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Company Address -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Address</label>
                    <input type="text" name="company_address" value="{{ Setting::get('branding.company_address', config('branding.company_address')) }}" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Logo Upload -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Logo</label>
                    <div class="flex items-center space-x-4">
                        @if(Setting::get('branding.logo', config('branding.logo')))
                        <img src="{{ Setting::get('branding.logo', config('branding.logo')) }}" alt="Current Logo" class="h-16 object-contain">
                        @endif
                        <input type="file" name="logo" accept="image/*" 
                               class="flex-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Upload PNG, JPG, or SVG (max 2MB)</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="btn-primary px-6 py-2 rounded-md">
                    Save Branding Settings
                </button>
            </div>
        </form>
    </div>

    <!-- Microsoft API Settings -->
    <div class="bg-white rounded-lg shadow mt-6">
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Microsoft Partner Center API</h2>
            
            <form action="{{ route('admin.settings.update-microsoft') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tenant ID</label>
                        <input type="text" name="tenant_id" value="{{ Setting::get('microsoft.tenant_id', config('microsoft.tenant_id')) }}" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Client ID (Application ID)</label>
                        <input type="text" name="client_id" value="{{ Setting::get('microsoft.client_id', config('microsoft.client_id')) }}" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Client Secret</label>
                        <input type="password" name="client_secret" value="{{ Setting::get('microsoft.client_secret', config('microsoft.client_secret')) }}" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        <p class="text-xs text-gray-500 mt-1">Keep this secret secure and never share it</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                        Save Microsoft Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Update color input text when color picker changes
    document.querySelectorAll('input[type="color"]').forEach(colorInput => {
        colorInput.addEventListener('input', function() {
            this.nextElementSibling.value = this.value;
        });
    });
</script>
@endsection
