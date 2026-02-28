@extends('layouts.customer')

@section('title', 'Order Confirmation')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">✅ Order Confirmed!</h1>
    <p class="text-gray-600">Your email hosting is ready. Set up your email client below.</p>
</div>

<!-- Success Alert -->
<div class="bg-green-50 border-l-4 border-green-600 p-6 rounded-lg mb-8">
    <p class="text-green-900 font-bold">Your email hosting has been successfully activated!</p>
    <p class="text-green-800 text-sm mt-2">A confirmation email with all your credentials has been sent to {{ Auth::user()->email }}</p>
</div>

<!-- Order Details -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-xl font-bold text-mtn-black mb-6">Order Information</h2>
        
        <div class="space-y-4">
            <div>
                <p class="text-gray-600 text-sm">Order Number</p>
                <p class="text-lg font-bold text-mtn-black">#{{ $order->order_number }}</p>
            </div>
            
            <div>
                <p class="text-gray-600 text-sm">Domain</p>
                <p class="text-lg font-bold text-mtn-black">{{ $order->domain->domain_name }}</p>
            </div>
            
            <div>
                <p class="text-gray-600 text-sm">Hosting Plan</p>
                <p class="text-lg font-bold text-mtn-black">{{ $order->emailHostingPlan->name }}</p>
            </div>
            
            <div>
                <p class="text-gray-600 text-sm">Total Amount</p>
                <p class="text-2xl font-bold text-mtn-yellow">{{ number_format($order->total_amount, 0) }} XAF</p>
            </div>
            
            <div>
                <p class="text-gray-600 text-sm">Order Date</p>
                <p class="text-lg font-semibold">{{ $order->created_at->format('F d, Y H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-xl font-bold text-mtn-black mb-6">Domain Details</h2>
        
        <div class="space-y-4">
            <div>
                <p class="text-gray-600 text-sm">Domain</p>
                <p class="text-lg font-bold text-mtn-black">{{ $order->domain->domain_name }}</p>
            </div>
            
            <div>
                <p class="text-gray-600 text-sm">Registered Date</p>
                <p class="text-lg font-semibold">{{ $order->domain->registered_date->format('F d, Y') }}</p>
            </div>
            
            <div>
                <p class="text-gray-600 text-sm">Expiration Date</p>
                <p class="text-lg font-semibold">{{ $order->domain->expiration_date->format('F d, Y') }}</p>
            </div>
            
            <div>
                <p class="text-gray-600 text-sm">Auto Renewal</p>
                <p class="text-lg font-semibold">{{ $order->domain->auto_renew ? '✅ Enabled' : '❌ Disabled' }}</p>
            </div>
            
            <div>
                <p class="text-gray-600 text-sm">Registrar</p>
                <p class="text-lg font-semibold">{{ ucfirst($order->domain->registrar) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Email Accounts & Setup Instructions -->
<div class="bg-white rounded-lg shadow-lg p-8 mb-8">
    <h2 class="text-2xl font-bold text-mtn-black mb-6">Your Email Accounts</h2>
    
    @if($emailAccounts->count() > 0)
        <div class="space-y-6">
            @foreach($emailAccounts as $index => $account)
            <div class="border-2 border-gray-300 rounded-lg p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-mtn-black">{{ $account->email_address }}</h3>
                        <p class="text-sm text-gray-600">Mailbox {{ $index + 1 }} of {{ $emailAccounts->count() }}</p>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Active</span>
                </div>

                <!-- Email Settings -->
                <div class="bg-gray-50 p-4 rounded-lg mb-4">
                    <h4 class="font-bold text-mtn-black mb-3">Email Configuration</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">IMAP Server</p>
                            <p class="font-mono bg-white p-2 rounded border border-gray-300">{{ $account->imap_host }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">IMAP Port</p>
                            <p class="font-mono bg-white p-2 rounded border border-gray-300">{{ $account->imap_port }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">SMTP Server</p>
                            <p class="font-mono bg-white p-2 rounded border border-gray-300">{{ $account->smtp_host }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">SMTP Port</p>
                            <p class="font-mono bg-white p-2 rounded border border-gray-300">{{ $account->smtp_port }}</p>
                        </div>
                    </div>
                </div>

                <!-- Setup Instructions -->
                <details class="mb-4">
                    <summary class="font-bold text-mtn-black cursor-pointer hover:text-mtn-orange">📧 Setup Instructions for Email Clients</summary>
                    
                    <div class="mt-4 space-y-4 bg-gray-50 p-4 rounded-lg">
                        <div>
                            <h5 class="font-bold text-mtn-black mb-2">Outlook / Windows Mail:</h5>
                            <ol class="list-decimal list-inside text-sm text-gray-700 space-y-1">
                                <li>Go to File → Add Account</li>
                                <li>Enter your email address: {{ $account->email_address }}</li>
                                <li>Enter password</li>
                                <li>Select "IMAP" protocol</li>
                                <li>Server: {{ $account->imap_host }}, Port: {{ $account->imap_port }}, SSL: Yes</li>
                                <li>Outgoing Server: {{ $account->smtp_host }}, Port: {{ $account->smtp_port }}, TLS: Yes</li>
                            </ol>
                        </div>
                        
                        <div>
                            <h5 class="font-bold text-mtn-black mb-2">Apple Mail / Mac:</h5>
                            <ol class="list-decimal list-inside text-sm text-gray-700 space-y-1">
                                <li>Mail → Preferences → Accounts → + Button</li>
                                <li>Enter your email address and password</li>
                                <li>Incoming Server: {{ $account->imap_host }}</li>
                                <li>Outgoing Server: {{ $account->smtp_host }}</li>
                            </ol>
                        </div>
                        
                        <div>
                            <h5 class="font-bold text-mtn-black mb-2">Gmail / Web Access:</h5>
                            <ol class="list-decimal list-inside text-sm text-gray-700 space-y-1">
                                <li>Visit your webmail at: <strong>https://mail.{{ $order->domain->domain_name }}</strong></li>
                                <li>Username: {{ $account->mailbox_name }}</li>
                                <li>Password: (your password)</li>
                            </ol>
                        </div>
                        
                        <div>
                            <h5 class="font-bold text-mtn-black mb-2">Thunderbird:</h5>
                            <ol class="list-decimal list-inside text-sm text-gray-700 space-y-1">
                                <li>Tools → Account Settings → Create New Account</li>
                                <li>Email address: {{ $account->email_address }}</li>
                                <li>Server Type: IMAP</li>
                                <li>Configure servers as above</li>
                            </ol>
                        </div>
                    </div>
                </details>

                <!-- Storage Info -->
                <div class="bg-blue-50 p-4 rounded-lg text-sm text-blue-900">
                    <p><strong>Storage:</strong> {{ $account->storage_gb }} GB available</p>
                    <p class="text-xs mt-1">You can manage your storage and create additional accounts from your email account settings.</p>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No email accounts created yet.</p>
    @endif
</div>

<!-- Next Steps -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-600">
        <h3 class="font-bold text-blue-900 mb-2">Step 1: Copy Settings</h3>
        <p class="text-blue-800 text-sm">Copy the IMAP and SMTP settings above and enter them into your email client.</p>
    </div>
    
    <div class="bg-green-50 rounded-lg p-6 border-l-4 border-green-600">
        <h3 class="font-bold text-green-900 mb-2">Step 2: Test Connection</h3>
        <p class="text-green-800 text-sm">Send a test email to verify everything is working properly.</p>
    </div>
    
    <div class="bg-purple-50 rounded-lg p-6 border-l-4 border-purple-600">
        <h3 class="font-bold text-purple-900 mb-2">Step 3: Change Password</h3>
        <p class="text-purple-800 text-sm">For security, change your password immediately after setup.</p>
    </div>
</div>

<!-- Action Buttons -->
<div class="space-y-3">
    <a href="{{ route('customer.email-hosting.my-domains') }}" class="block w-full text-center bg-mtn-yellow text-black py-4 rounded-lg font-bold hover:bg-mtn-orange transition">
        View All My Domains
    </a>
    <a href="{{ route('customer.dashboard') }}" class="block w-full text-center bg-gray-300 text-black py-4 rounded-lg font-bold hover:bg-gray-400 transition">
        Back to Dashboard
    </a>
</div>

@endsection
