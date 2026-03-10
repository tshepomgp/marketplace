<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ColocationOrder;
use App\Models\CreditTransaction;
use Auth;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function index()
    {
        return view('customer.colocation.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'colocation_type' => 'required|in:standard,premium,enterprise',
            'monthly_cost' => 'required|numeric|min:0',
            'location' => 'required|string',
            'power_requirement' => 'required|string',
            'organization_name' => 'required|string',
            'contact_name' => 'required|string',
            'email' => 'required|email',
            'payment_method' => 'required|in:mtn_momo,card,credit',
            'special_requirements' => 'nullable|string',
        ]);

        $user = Auth::user();
        $totalCost = $validated['monthly_cost'];
        $paymentStatus = 'pending';

        // Handle credit payment
        if ($validated['payment_method'] === 'credit') {
            if ($user->getAvailableCredit() < $totalCost) {
                return back()->with('error', 'Insufficient credit limit');
            }

            $balanceBefore = $user->credit_used;
            $user->credit_used += $totalCost;
            $user->save();

            CreditTransaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'order',
                'reference_id' => 'COLO-' . time(),
                'amount' => $totalCost,
                'balance_before' => $balanceBefore,
                'balance_after' => $user->credit_used,
                'description' => 'Colocation - ' . ucfirst($validated['colocation_type']),
            ]);

            $paymentStatus = 'paid';
        }

        // Create colocation order
        $order = ColocationOrder::create([
            'customer_id' => $user->id,
            'order_number' => 'COLO-' . date('YmdHis') . '-' . rand(1000, 9999),
            'colocation_type' => $validated['colocation_type'],
            'monthly_cost' => $totalCost,
            'location' => $validated['location'],
            'power_requirement' => $validated['power_requirement'],
            'organization_name' => $validated['organization_name'],
            'contact_name' => $validated['contact_name'],
            'email' => $validated['email'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => $paymentStatus,
            'status' => $validated['payment_method'] === 'credit' ? 'active' : 'pending',
            'special_requirements' => $validated['special_requirements'],
        ]);

        return redirect()->route('customer.colocation.success', $order)->with('success', 'Colocation order placed!');
    }

public function success(ColocationOrder $colocationOrder)
{
    return view('customer.colocation.success', compact('colocationOrder'));
}
}
