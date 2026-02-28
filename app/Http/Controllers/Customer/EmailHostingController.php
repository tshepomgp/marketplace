<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\EmailHostingPlan;
use App\Models\Domain;
use App\Models\EmailAccount;
use App\Models\EmailHostingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\CreditTransaction;
use Auth;

class EmailHostingController extends Controller
{
    /**
     * Show email hosting plans
     */
    public function index()
    {
        $plans = EmailHostingPlan::where('status', 'active')->get();
        return view('customer.email-hosting.index', compact('plans'));
    }

    /**
     * Show domain search page
     */
    public function searchDomain(Request $request)
    {
        $selectedPlan = null;
        $planId = $request->input('plan_id');
        
        if ($planId) {
            $selectedPlan = EmailHostingPlan::findOrFail($planId);
        }

        return view('customer.email-hosting.domain-search', compact('selectedPlan'));
    }

    /**
     * Check domain availability (API endpoint)
     */
 


public function checkAvailability(Request $request)
{
    
    $request->validate([
        'domain' => 'required|string|min:3',
        'tld' => 'required|string',
    ]);

    $domain = $request->input('domain');
    $tld = $request->input('tld');
    $fullDomain = $domain . $tld;
    $planId = $request->input('plan_id');  // Get from query string
    \Log::info('Checking domain: ' . $fullDomain);
    
    $available = $this->checkDomainAvailabilityViaAPI($fullDomain);

    if ($available) {
        return view('customer.email-hosting.domain-available', [
            'domain' => $fullDomain,
            'price' => 35000,
            'currency' => 'XAF',
            'planId' => $planId,  // Pass it to view
        ]);
    } else {
        return view('customer.email-hosting.domain-unavailable', [
            'domain' => $fullDomain,
            'domainInput' => $domain,
            'tld' => $tld,
        ]);
    }
}

    /**
     * Show checkout page for domain + hosting
     */
    public function checkout(Request $request)
    {
        
        $request->validate([
            'domain' => 'required|string',
            'plan_id' => 'required|exists:email_hosting_plans,id',
        ]);

        $domain = $request->input('domain');
        $plan = EmailHostingPlan::findOrFail($request->input('plan_id'));

        // Check if domain already registered
        $existingDomain = Domain::where('domain_name', $domain)->first();
        if ($existingDomain && $existingDomain->isRegistered()) {
            return redirect()->back()->with('error', 'This domain is already registered');
        }

        // Calculate pricing
        $domainPrice = $plan->domain_price;
        $hostingPrice = $plan->price_per_mailbox * $plan->mailboxes_included;
        $totalPrice = $domainPrice + $hostingPrice;

        return view('customer.email-hosting.checkout', compact('domain', 'plan', 'domainPrice', 'hostingPrice', 'totalPrice'));
    }

    /**
     * Process email hosting order
     */
   public function processOrder(Request $request)
{
    $validated = $request->validate([
        'domain' => 'required|string',
        'plan_id' => 'required|exists:email_hosting_plans,id',
        'mailbox_count' => 'required|integer|min:1|max:100',
        'payment_method' => 'required|in:mtn_momo,orange_money,card,credit',  // ADD credit
        'admin_email' => 'required|email',
        'admin_password' => 'required|string|min:8',
    ]);

    try {
        // Create domain record
        $domain = Domain::create([
            'user_id' => Auth::user()->id,
            'email_hosting_plan_id' => $validated['plan_id'],
            'domain_name' => $validated['domain'],
            'order_number' => 'DOM-' . date('YmdHis') . '-' . rand(1000, 9999),
            'status' => 'pending',
            'price' => EmailHostingPlan::find($validated['plan_id'])->domain_price,
            'auto_renew' => true,
        ]);

        // Get plan details
        $plan = EmailHostingPlan::find($validated['plan_id']);

        // Calculate costs
        $domainPrice = $plan->domain_price;
        $hostingPrice = $plan->price_per_mailbox * $validated['mailbox_count'];
        $totalPrice = $domainPrice + $hostingPrice;

        // Create order
        $order = EmailHostingOrder::create([
            'user_id' => Auth::user()->id,
            'domain_id' => $domain->id,
            'email_hosting_plan_id' => $plan->id,
            'order_number' => 'EHO-' . date('YmdHis') . '-' . rand(1000, 9999),
            'domain_price' => $domainPrice,
            'hosting_price' => $hostingPrice,
            'total_amount' => $totalPrice,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'order_data' => [
                'mailbox_count' => $validated['mailbox_count'],
                'admin_email' => $validated['admin_email'],
            ],
        ]);

        // Handle credit payment
        $paymentSuccess = false;

        if ($validated['payment_method'] === 'credit') {
            $user = Auth::user();
            
            if ($user->getAvailableCredit() < $totalPrice) {
                $domain->delete();
                $order->delete();
                return redirect()->back()->with('error', 'Insufficient credit limit. Available: ' . number_format($user->getAvailableCredit(), 0) . ' XAF');
            }

            // Deduct from credit
            $balanceBefore = $user->credit_used;
            $user->credit_used += $totalPrice;
            $user->save();

            // Log transaction
            CreditTransaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'order',
                'reference_id' => $order->id,
                'amount' => $totalPrice,
                'balance_before' => $balanceBefore,
                'balance_after' => $user->credit_used,
                'description' => 'Email hosting - ' . $validated['domain'],
            ]);

            $paymentSuccess = true;
        } else {
            // TODO: Process payment with actual payment gateway
            // Simulate payment success for other methods
            $paymentSuccess = true;
        }

        if ($paymentSuccess) {
            // Register domain (TODO: Integrate with registrar API)
            $domain->update([
                'status' => 'registered',
                'registered_date' => now(),
                'expiration_date' => now()->addYear(),
                'registrar' => 'namecheap', // TODO: Use actual registrar
            ]);

            // Create email accounts
            for ($i = 1; $i <= $validated['mailbox_count']; $i++) {
                $mailboxName = $i === 1 ? 'admin' : 'user' . $i;
                $email = $mailboxName . '@' . $validated['domain'];
                
                EmailAccount::create([
                    'user_id' => Auth::user()->id,
                    'domain_id' => $domain->id,
                    'email_address' => $email,
                    'mailbox_name' => $mailboxName,
                    'password' => $validated['admin_password'],
                    'status' => 'active',
                    'imap_host' => 'imap.' . $validated['domain'],
                    'smtp_host' => 'smtp.' . $validated['domain'],
                    'storage_gb' => $plan->storage_gb,
                ]);
            }

            // Update order status
            $order->update([
                'payment_status' => 'paid',
                'payment_date' => now(),
                'status' => 'completed',
            ]);

            // TODO: Send confirmation email with credentials

            return redirect()->route('customer.email-hosting.success', $order)->with('success', 'Email hosting order completed!');
        }

    } catch (\Exception $e) {
        \Log::error('Email hosting order failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Order processing failed. Please try again.');
    }
}

    /**
     * Show order success and credentials
     */
    public function success(EmailHostingOrder $order)
    {
        if ($order->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $order->load('domain', 'emailHostingPlan');
        $emailAccounts = EmailAccount::where('domain_id', $order->domain_id)->get();

        return view('customer.email-hosting.success', compact('order', 'emailAccounts'));
    }

    /**
     * Show my domains
     */
    public function myDomains()
    {
        $domains = Domain::where('user_id', Auth::user()->id)
            ->with('emailHostingPlan', 'emailAccounts')
            ->latest()
            ->paginate(10);

        return view('customer.email-hosting.my-domains', compact('domains'));
    }

    /**
     * Show domain details
     */
    public function showDomain(Domain $domain)
    {
        if ($domain->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $domain->load('emailHostingPlan', 'emailAccounts');
        $emailAccounts = $domain->emailAccounts;

        return view('customer.email-hosting.domain-details', compact('domain', 'emailAccounts'));
    }

    /**
     * API endpoint to check domain availability via registrar
     * TODO: Implement actual registrar API integration
     */

private function checkDomainAvailabilityViaAPI($domain)
{
    try {

        $godaddyKey    = config('services.godaddy.key');
        $godaddySecret = config('services.godaddy.secret');

        $domain = str_replace('www.', '', $domain);

        \Log::info('Checking domain: ' . $domain);

        $response = \Http::timeout(10)
            ->withHeaders([
                'Authorization' => "sso-key {$godaddyKey}:{$godaddySecret}",
                'Accept'        => 'application/json'
            ])
            ->get('https://api.ote-godaddy.com/v1/domains/available', [
                'domain' => $domain
            ]);

        \Log::info('GoDaddy Response Status: ' . $response->status());
        \Log::info('GoDaddy Response Body: ' . $response->body());

        if ($response->successful()) {
            return $response->json()['available'] ?? false;
        }

        return false;

    } catch (\Exception $e) {
        \Log::error('GoDaddy Exception: ' . $e->getMessage());
        return false;
    }
}

}
