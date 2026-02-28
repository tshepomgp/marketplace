<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'branding')->get();
        
        return view('admin.settings.index', compact('settings'));
    }
    
    public function updateBranding(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
            'currency' => 'required|string|size:3',
            'country' => 'required|string|size:2',
            'support_email' => 'required|email',
            'support_phone' => 'required|string',
            'company_address' => 'required|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('branding', 'public');
            Setting::set('branding.logo', '/storage/' . $logoPath);
        }
        
        // Update settings
        Setting::set('branding.company_name', $validated['company_name']);
        Setting::set('branding.primary_color', $validated['primary_color']);
        Setting::set('branding.secondary_color', $validated['secondary_color']);
        Setting::set('branding.currency', $validated['currency']);
        Setting::set('branding.country', $validated['country']);
        Setting::set('branding.support_email', $validated['support_email']);
        Setting::set('branding.support_phone', $validated['support_phone']);
        Setting::set('branding.company_address', $validated['company_address']);
        
        // Update config cache
        \Artisan::call('config:cache');
        
        return redirect()->back()->with('success', __('messages.messages.settings_saved'));
    }
    
    public function updateMicrosoft(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|string',
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
        ]);
        
        Setting::set('microsoft.tenant_id', $validated['tenant_id']);
        Setting::set('microsoft.client_id', $validated['client_id']);
        Setting::set('microsoft.client_secret', $validated['client_secret']);
        
        return redirect()->back()->with('success', 'Microsoft settings updated successfully!');
    }
    
    /**
     * Switch to a different country configuration
     */
    public function switchCountry(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string|size:2|in:CM,ZA,GH',
        ]);
        
        $countryCode = $validated['country'];
        $countryConfig = config("branding.countries.{$countryCode}");
        
        if (!$countryConfig) {
            return redirect()->back()->with('error', 'Country configuration not found');
        }
        
        // Update settings based on country
        Setting::set('branding.country', $countryCode);
        Setting::set('branding.currency', $countryConfig['currency']);
        Setting::set('branding.currency_symbol', $countryConfig['currency_symbol']);
        Setting::set('branding.language', $countryConfig['language']);
        Setting::set('branding.timezone', $countryConfig['timezone']);
        
        // Update app locale
        app()->setLocale($countryConfig['language']);
        
        return redirect()->back()->with('success', "Country switched to {$countryConfig['name']} successfully!");
    }
}
