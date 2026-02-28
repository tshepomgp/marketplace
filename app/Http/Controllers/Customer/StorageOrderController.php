<?php

namespace App\Http\Controllers\Customer;
use App\Mail\NewStorageOrderNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\StorageOrder;
use Illuminate\Http\Request;
use App\Models\CreditTransaction;
use Auth;
use Carbon\Carbon;

class StorageOrderController extends Controller
{
    /**
     * Store a newly created storage order
     */

public function store(Request $request)
{
    $validated = $request->validate([
        'storage_type' => 'required|in:standard,premium,enterprise',
        'storage_size' => 'required|numeric|min:1',
        'total_cost' => 'required|numeric|min:0',
        'purpose' => 'required|string',
        'billing_cycle' => 'required|in:monthly,quarterly,annually',
        'location' => 'nullable|string',
        'special_requirements' => 'nullable|string',
        'payment_method' => 'required|in:mtn_momo,orange_money,card,credit',  // ADD THIS
    ]);

    // Calculate renewal date based on billing cycle
    $renewalDate = match($validated['billing_cycle']) {
        'monthly' => Carbon::now()->addMonth(),
        'quarterly' => Carbon::now()->addMonths(3),
        'annually' => Carbon::now()->addYear(),
    };

    // Generate access endpoint
    $accessEndpoint = 'https://storage-' . strtolower($validated['storage_type']) . '.mtn-cloud.cm/access/' . uniqid();

    $totalCost = $validated['total_cost'];
    $paymentStatus = 'pending';

    // Handle credit payment
    if ($validated['payment_method'] === 'credit') {
        $user = Auth::user();
        
        if ($user->getAvailableCredit() < $totalCost) {
            return redirect()->back()->with('error', 'Insufficient credit limit. Available: ' . number_format($user->getAvailableCredit(), 0) . ' XAF. Required: ' . number_format($totalCost, 0) . ' XAF');
        }

        // Deduct from credit
        $balanceBefore = $user->credit_used;
        $user->credit_used += $totalCost;
        $user->save();

        // Log transaction
        CreditTransaction::create([
            'user_id' => $user->id,
            'transaction_type' => 'order',
            'reference_id' => 'STORAGE-' . time(),
            'amount' => $totalCost,
            'balance_before' => $balanceBefore,
            'balance_after' => $user->credit_used,
            'description' => 'Storage Order - ' . ucfirst($validated['storage_type']) . ' (' . $validated['storage_size'] . 'TB)',
        ]);

        $paymentStatus = 'paid';
    }

    // Create storage order
    $order = StorageOrder::create([
        'customer_id' => Auth::id(),
        'order_number' => 'STOR-' . date('YmdHis') . '-' . rand(1000, 9999),
        'storage_type' => $validated['storage_type'],
        'storage_size' => $validated['storage_size'],
        'monthly_cost' => $totalCost,
        'billing_cycle' => $validated['billing_cycle'],
        'renewal_date' => $renewalDate,
        'status' => $validated['payment_method'] === 'credit' ? 'active' : 'pending',
        'payment_method' => $validated['payment_method'],
        'payment_status' => $paymentStatus,
        'access_endpoint' => $accessEndpoint,
        'purpose' => $validated['purpose'],
        'location' => $validated['location'] ?? 'cameroon',
        'special_requirements' => $validated['special_requirements']
    ]);

    // Send email
    Mail::to('tshepo.mataboge@mtn.com')->send(new NewStorageOrderNotification($order));
    
    return redirect()->route('customer.storage-orders.success', $order);
}

    /**
     * Show storage order success page
     */
    public function success(StorageOrder $order)
    {
        // Check authorization
        if ($order->customer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('customer.orders.storage-success', [
            'order' => $order
        ]);
    }

    /**
     * Show storage order details
     */
    public function show(StorageOrder $order)
    {
        // Check authorization
        if ($order->customer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('customer.storage-orders.show', [
            'order' => $order
        ]);
    }
}