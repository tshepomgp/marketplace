<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:2'],
            'tenant_type' => ['required', 'in:new,existing'],
            'existing_tenant_id' => ['required_if:tenant_type,existing', 'nullable', 'string'],
        ]);

        // Create customer record
        $customer = Customer::create([
            'company_name' => $request->company_name,
            'contact_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'status' => 'active',
        ]);

        // Handle tenant creation/linking
        if ($request->tenant_type === 'existing') {
            $customer->update([
                'microsoft_customer_id' => $request->existing_tenant_id,
            ]);
        }
        // TODO: Create new tenant via Microsoft Partner Center API
        // For now, we'll create a placeholder domain
        else {
            $domain = \Illuminate\Support\Str::slug($request->company_name) . '.onmicrosoft.com';
            $customer->update([
                'domain' => $domain,
                'microsoft_customer_id' => 'pending', // Will be updated after API call
            ]);
        }

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'customer_id' => $customer->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
