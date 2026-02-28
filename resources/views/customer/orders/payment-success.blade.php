@extends('layouts.customer')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-blue-50">
    <div class="max-w-md w-full mx-4">
        <!-- Animated Success Icon -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-4 animate-bounce">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-mtn-black mb-2">Payment Successful!</h1>
            <p class="text-gray-600 text-lg">Thank you for your purchase</p>
        </div>
        
        <!-- Payment Details -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-lg font-bold text-mtn-black mb-4">Payment Confirmation</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Transaction ID:</span>
                    <span class="font-mono text-sm">{{ $transaction->transaction_id }}</span>
                </div>
                
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Amount Paid:</span>
                    <span class="font-bold text-lg text-green-600">{{ number_format($transaction->amount, 0) }} XAF</span>
                </div>
                
                <div class="flex justify-between pb-3 border-b">
                    <span class="text-gray-600">Payment Method:</span>
                    <span class="font-semibold">{{ $transaction->payment_method_display }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Date & Time:</span>
                    <span class="font-semibold">{{ $transaction->created_at->format('M d, Y H:i') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Confirmation Message -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <p class="text-blue-900 text-center">
                A confirmation email with your receipt and order details has been sent to your registered email address.
            </p>
        </div>
        
        <!-- Actions -->
        <div class="space-y-3">
            <a href="{{ route('customer.invoices.download', $transaction->invoice) }}" 
               class="block w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center">
                📄 Download Receipt
            </a>
            <a href="{{ route('customer.orders.show', $transaction->order) }}" 
               class="block w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition text-center">
                View Order
            </a>
            <a href="{{ route('customer.dashboard') }}" 
               class="block w-full bg-gray-200 text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                Back to Dashboard
            </a>
        </div>
        
        <!-- Help Section -->
        <div class="mt-8 pt-6 border-t">
            <p class="text-gray-600 text-sm text-center mb-3">Questions?</p>
            <div class="space-y-2 text-center">
                <p class="text-sm">
                    <span class="text-gray-600">Email: </span>
                    <a href="mailto:support@mtn-microsoft.cm" class="text-mtn-yellow hover:underline">support@mtn-microsoft.cm</a>
                </p>
                <p class="text-sm">
                    <span class="text-gray-600">Phone: </span>
                    <a href="tel:+237655123456" class="text-mtn-yellow hover:underline">+237 655 123 456</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
