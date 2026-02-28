@extends('layouts.customer')

@section('title', 'Monthly Invoice')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Monthly Invoice</h1>
    <p class="text-gray-600">{{ now()->format('F Y') }}</p>
</div>

<!-- Invoice Container -->
<div class="bg-white rounded-lg shadow p-12 max-w-4xl">
    
    <!-- Header -->
    <div class="flex justify-between items-start mb-12 pb-8 border-b-2 border-gray-300">
        <div>
            <h2 class="text-3xl font-bold text-mtn-black">INVOICE</h2>
            <p class="text-gray-600 mt-2">Invoice Date: {{ now()->format('M d, Y') }}</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-600">Invoice Period</p>
            <p class="text-lg font-bold">{{ now()->format('F Y') }}</p>
        </div>
    </div>

    <!-- Bill To -->
    <div class="grid grid-cols-2 gap-12 mb-12">
        <div>
            <p class="text-gray-600 text-sm font-semibold mb-2">BILL TO:</p>
            <p class="text-lg font-bold text-mtn-black">{{ $user->name }}</p>
            <p class="text-gray-700">{{ $user->company_name }}</p>
            <p class="text-gray-700">{{ $user->email }}</p>
            <p class="text-gray-700">{{ $user->phone ?? 'N/A' }}</p>
        </div>
        <div class="text-right">
            <p class="text-gray-600 text-sm font-semibold mb-2">CREDIT ACCOUNT</p>
            <p class="text-lg font-bold text-mtn-yellow">{{ number_format($user->credit_limit, 0) }} XAF</p>
            <p class="text-gray-700 mt-4">
                <span class="text-sm text-gray-600">Previously Used:</span><br>
                <span class="font-bold text-red-600">{{ number_format($user->credit_used - $totalCharged, 0) }} XAF</span>
            </p>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="mb-12">
        <table class="w-full">
            <thead class="bg-gray-100 border-b-2 border-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Date</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Description</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Reference</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($transactions as $tx)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $tx->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3 text-sm">{{ $tx->description }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $tx->reference_id ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm text-right font-bold text-red-600">-{{ number_format($tx->amount, 0) }} XAF</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">No charges this month</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="flex justify-end mb-12">
        <div class="w-full md:w-80">
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="flex justify-between mb-3 pb-3 border-b border-gray-300">
                    <span class="text-gray-700">Total Charges:</span>
                    <span class="font-bold text-red-600">{{ number_format($totalCharged, 0) }} XAF</span>
                </div>
                
                <div class="flex justify-between mb-3 pb-3 border-b border-gray-300">
                    <span class="text-gray-700">Previous Balance:</span>
                    <span class="font-bold">{{ number_format($user->credit_used - $totalCharged, 0) }} XAF</span>
                </div>
                
                <div class="flex justify-between pt-3">
                    <span class="text-lg font-bold text-mtn-black">New Balance:</span>
                    <span class="text-lg font-bold text-mtn-yellow">{{ number_format($user->credit_used, 0) }} XAF</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="border-t-2 border-gray-300 pt-8 text-center text-gray-600 text-sm">
        <p>Thank you for your business</p>
        <p class="mt-2">Payment Terms: Credit deducted upon order placement</p>
        <p class="mt-4 text-xs text-gray-500">Generated on {{ now()->format('M d, Y H:i') }}</p>
    </div>

</div>

<!-- Action Buttons -->
<div class="mt-8 flex gap-4 justify-center">
    <button onclick="window.print()" class="bg-mtn-yellow text-black px-8 py-3 rounded-lg font-bold hover:bg-mtn-orange