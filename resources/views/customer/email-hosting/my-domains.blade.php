@extends('layouts.customer')

@section('title', 'My Domains')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">My Domains</h1>
    <p class="text-gray-600">Manage your email hosting domains</p>
</div>

@if($domains->isEmpty())
<div class="bg-white rounded-lg shadow p-12 text-center">
    <p class="text-gray-600 mb-4">No domains yet</p>
    <a href="{{ route('customer.email-hosting.index') }}" class="text-mtn-yellow hover:text-mtn-orange font-semibold">
        Order a domain →
    </a>
</div>
@else

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($domains as $domain)
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-xl font-bold text-mtn-black">{{ $domain->domain_name }}</h3>
                <p class="text-sm text-gray-600">{{ $domain->order_number }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-sm font-semibold
                {{ $domain->status === 'registered' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ ucfirst($domain->status) }}
            </span>
        </div>

        <div class="space-y-2 text-sm text-gray-600 mb-4">
            <p><strong>Registrar:</strong> {{ $domain->registrar ?? 'N/A' }}</p>
            <p><strong>Plan:</strong> {{ $domain->emailHostingPlan->name ?? 'N/A' }}</p>
            @if($domain->registered_date)
            <p><strong>Registered:</strong> {{ $domain->registered_date->format('M d, Y') }}</p>
            @endif
            @if($domain->expiration_date)
            <p><strong>Expires:</strong> {{ $domain->expiration_date->format('M d, Y') }}</p>
            @endif
        </div>

        <a href="{{ route('customer.email-hosting.domain-details', $domain) }}" class="w-full bg-mtn-yellow text-black py-2 rounded-lg font-semibold hover:bg-mtn-orange transition text-center block">
            Manage Domain
        </a>
    </div>
    @endforeach
</div>

@endif

@endsection
