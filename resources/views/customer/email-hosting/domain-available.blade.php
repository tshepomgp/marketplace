@extends('layouts.customer')

@section('title', 'Domain Available')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">✅ Domain Available!</h1>
</div>

<div class="bg-green-50 border-2 border-green-500 rounded-lg p-8 text-center mb-8">
    <svg class="w-24 h-24 text-green-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    
    <p class="text-3xl font-bold text-green-900 mb-2">{{ $domain }}</p>
    <p class="text-green-700 mb-6 text-lg">This domain is available for registration!</p>
    <p class="text-4xl font-bold text-green-600 mb-8">{{ number_format($price, 0) }} {{ $currency }}/year</p>
    
    <!-- Pass plan_id in URL query string -->
    
    <a href="{{ route('customer.email-hosting.checkout', ['domain' => $domain, 'plan_id' => $planId]) }}" 
       class="inline-block bg-green-600 text-white px-12 py-4 rounded-lg font-bold hover:bg-green-700 transition text-lg">
        Continue to Checkout →
    </a>
</div>

<div class="bg-white rounded-lg shadow p-8">
    <h2 class="text-2xl font-bold text-mtn-black mb-4">What's Next?</h2>
    <ol class="space-y-3 text-gray-700">
        <li class="flex items-start">
            <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 flex-shrink-0">1</span>
            <span>Click "Continue to Checkout" to register your domain</span>
        </li>
        <li class="flex items-start">
            <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 flex-shrink-0">2</span>
            <span>Choose your email hosting plan and set up email accounts</span>
        </li>
        <li class="flex items-start">
            <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 flex-shrink-0">3</span>
            <span>Receive your login credentials via email</span>
        </li>
        <li class="flex items-start">
            <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 flex-shrink-0">4</span>
            <span>Set up on your email client using IMAP/SMTP settings</span>
        </li>
    </ol>
</div>

@endsection