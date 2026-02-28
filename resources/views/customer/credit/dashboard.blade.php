@extends('layouts.customer')

@section('title', 'Credit Limit')



@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Credit Limit</h1>
</div class="mb-8">

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Total Credit Limit</p>
        <p class="text-3xl font-bold text-mtn-yellow">{{ number_format($user->credit_limit, 0) }} XAF</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Used</p>
        <p class="text-3xl font-bold text-red-600">{{ number_format($user->credit_used, 0) }} XAF</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 text-sm">Available</p>
        <p class="text-3xl font-bold text-green-600">{{ number_format($user->getAvailableCredit(), 0) }} XAF</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left">Date</th>
                <th class="px-6 py-4 text-left">Description</th>
                <th class="px-6 py-4 text-right">Amount</th>
                <th class="px-6 py-4 text-right">Balance</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($transactions as $tx)
            <tr>
                <td class="px-6 py-4">{{ $tx->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4">{{ $tx->description }}</td>
                <td class="px-6 py-4 text-right">-{{ number_format($tx->amount, 0) }} XAF</td>
                <td class="px-6 py-4 text-right font-bold">{{ number_format($tx->balance_after, 0) }} XAF</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
</div><br>
<div><a class="text-3xl font-bold text-mtn-black mb-2" href="/customer/credit/invoice">Click to View Invoice</a></div>
@endsection