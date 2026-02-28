@extends('layouts.admin')

@section('title', 'Edit Email Hosting Plan')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black">Edit Email Hosting Plan</h1>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form method="POST" action="{{ route('admin.email-hosting-plans.update', $emailHostingPlan) }}" class="space-y-6">
        @csrf @method('PUT')
        
        <div>
            <label class="block text-sm font-semibold mb-2">Plan Name *</label>
            <input type="text" name="name" required value="{{ old('name', $emailHostingPlan->name) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">SKU Code (Read-only)</label>
            <input type="text" value="{{ $emailHostingPlan->sku_code }}" disabled
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Price per Mailbox (XAF) *</label>
                <input type="number" name="price_per_mailbox" required step="0.01" value="{{ old('price_per_mailbox', $emailHostingPlan->price_per_mailbox) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Domain Price (XAF) *</label>
                <input type="number" name="domain_price" required step="0.01" value="{{ old('domain_price', $emailHostingPlan->domain_price) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Storage (GB) *</label>
                <input type="number" name="storage_gb" required value="{{ old('storage_gb', $emailHostingPlan->storage_gb) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Mailboxes Included *</label>
                <input type="number" name="mailboxes_included" required value="{{ old('mailboxes_included', $emailHostingPlan->mailboxes_included) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Description</label>
            <textarea name="description" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">{{ old('description', $emailHostingPlan->description) }}</textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-mtn-yellow text-black px-8 py-2 rounded-lg font-bold">Update Plan</button>
            <a href="{{ route('admin.email-hosting-plans.index') }}" class="bg-gray-300 text-black px-8 py-2 rounded-lg font-bold">Cancel</a>
        </div>
    </form>
</div>
@endsection