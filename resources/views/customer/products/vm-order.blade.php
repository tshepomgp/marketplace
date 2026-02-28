@extends('layouts.customer')

@section('title', 'Order Virtual Machine')
<script src="//unpkg.com/alpinejs" defer></script>

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Order Virtual Machine</h1>
    <p class="text-gray-600">Select the VM configuration that best fits your needs.</p>
</div>

<!-- VM Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
    @forelse($products as $vm)
    <div class="bg-white rounded-lg shadow hover:shadow-lg border border-gray-200 overflow-hidden transition">

        <!-- Header -->
        <div class="bg-gradient-to-r from-mtn-black to-gray-800 text-white p-6">
            <h2 class="text-2xl font-bold">{{ $vm->name }}</h2>
            <p class="text-sm opacity-90">SKU: {{ $vm->sku_code }}</p>
            <div class="mt-2 text-3xl font-bold text-mtn-yellow">{{ number_format($vm->price_monthly, 0) }} XAF<span class="text-sm font-normal text-white">/month</span></div>
        </div>

        <!-- Tabs -->
        <div x-data="{ tab: 'specs' }" class="p-6">
            <div class="flex border-b border-gray-200 mb-4">
                <button @click="tab = 'specs'" :class="tab === 'specs' ? 'border-b-2 border-mtn-yellow font-bold text-mtn-black' : 'text-gray-600'" class="py-2 px-4 focus:outline-none">Specifications</button>
                <button @click="tab = 'order'" :class="tab === 'order' ? 'border-b-2 border-mtn-yellow font-bold text-mtn-black' : 'text-gray-600'" class="py-2 px-4 focus:outline-none">Order</button>
            </div>

            <!-- Specs Tab -->
            <div x-show="tab === 'specs'" class="space-y-4">
                <p class="text-gray-600">{{ $vm->description }}</p>

                @php
                    $specs = json_decode($vm->features, true) ?? [];
                @endphp

                @if($specs)
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-bold text-mtn-black mb-2">Specifications:</h3>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        @foreach(['os','cpu','ram','storage','database','uptime_sla','support'] as $key)
                            @if(isset($specs[$key]))
                            <div class="flex items-start">
                                <span class="text-mtn-yellow font-bold mr-2">{{ strtoupper(str_replace('_',' ',$key)) }}:</span>
                                <span class="text-gray-700">{{ $specs[$key] }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Order Tab -->
            <!-- Order Tab -->
<div x-show="tab === 'order'" class="space-y-3">
    <form action="{{ route('customer.vm-orders.store') }}" method="POST" class="space-y-3">
        @csrf
        <input type="hidden" name="product_id" value="{{ $vm->id }}">
        <input type="hidden" name="sku_code" value="{{ $vm->sku_code }}">
        <input type="hidden" name="product_name" value="{{ $vm->name }}">
        <input type="hidden" name="total_amount" value="{{ number_format($vm->price_monthly, 0) }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" value="1" min="1" max="10" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                <p class="text-xs text-gray-500 mt-1">Min: {{ $vm->minimum_order_quantity ?? 1 }} | Available: {{ $vm->available_quantity ?? '∞' }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Number of Users</label>
                <input type="number" name="number_of_users" value="1" min="1" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Organization Name</label>
            <input type="text" name="organization_name" placeholder="Your company name" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" placeholder="you@example.com"
                       value="{{ auth()->user()->email }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="tel" name="phone" placeholder="+237..."
                       value="{{ auth()->user()->phone }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Special Requirements</label>
            <textarea name="special_requirements" rows="3" placeholder="Any special needs..."
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"></textarea>
        </div>

        <!-- ADD PAYMENT METHOD SELECTION -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Payment Method *</label>
            <div class="space-y-2">
                <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                    <input type="radio" name="payment_method" value="mtn_momo" required class="w-4 h-4">
                    <span class="ml-3">
                        <span class="block font-semibold text-sm">MTN Mobile Money</span>
                        <span class="text-xs text-gray-600">Pay with MTN +237</span>
                    </span>
                </label>
                
                <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                    <input type="radio" name="payment_method" value="orange_money" required class="w-4 h-4">
                    <span class="ml-3">
                        <span class="block font-semibold text-sm">Orange Money</span>
                        <span class="text-xs text-gray-600">Pay with Orange +237</span>
                    </span>
                </label>
                
                <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                    <input type="radio" name="payment_method" value="card" required class="w-4 h-4">
                    <span class="ml-3">
                        <span class="block font-semibold text-sm">Credit/Debit Card</span>
                        <span class="text-xs text-gray-600">Visa, Mastercard, Amex</span>
                    </span>
                </label>

                <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
                    <input type="radio" name="payment_method" value="credit" required class="w-4 h-4">
                    <span class="ml-3">
                        <span class="block font-semibold text-sm">Credit Limit</span>
                        <span class="text-xs text-gray-600">Available: {{ number_format(auth()->user()->getAvailableCredit(), 0) }} XAF</span>
                    </span>
                </label>
            </div>
        </div>

        <button type="submit" class="w-full bg-mtn-yellow text-black py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
            Order {{ $vm->name }}
        </button>
    </form>
</div>
        </div>
    </div>
    @empty
    <div class="col-span-2 bg-white rounded-lg shadow p-12 text-center">
        <p class="text-gray-600 mb-4">No VMs available at the moment.</p>
        <a href="{{ route('customer.dashboard') }}" class="text-mtn-yellow hover:text-mtn-orange font-semibold">← Back to Dashboard</a>
    </div>
    @endforelse
</div>

<!-- Why Choose Our VMs -->
<div class="bg-white rounded-lg shadow p-8 mb-8">
    <h2 class="text-2xl font-bold text-mtn-black mb-6">Why Choose Our VMs?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach([
            ['title' => 'Fast Deployment', 'desc' => 'Get your VM ready in minutes, not hours', 'color' => 'bg-mtn-yellow', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
            ['title' => 'Enterprise Security', 'desc' => 'DDoS protection and 24/7 monitoring', 'color' => 'bg-mtn-orange', 'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'],
            ['title' => '24/7 Support', 'desc' => 'Expert support team always ready to help', 'color' => 'bg-mtn-yellow', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z']
        ] as $feature)
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-md {{ $feature['color'] }}">
                <svg class="h-6 w-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-mtn-black">{{ $feature['title'] }}</h3>
                <p class="text-gray-600 text-sm">{{ $feature['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
