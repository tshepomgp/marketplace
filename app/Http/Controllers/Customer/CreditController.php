<?php

namespace App\Http\Controllers\Customer;

use Auth;
use App\Models\CreditTransaction;
use App\Http\Controllers\Controller;

class CreditController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $transactions = CreditTransaction::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('customer.credit.dashboard', compact('user', 'transactions'));
    }

    public function invoice()
    {
        $user = Auth::user();
        $transactions = CreditTransaction::where('user_id', $user->id)
            ->whereMonth('created_at', now()->month)
            ->get();

        $totalCharged = $transactions->sum('amount');

        return view('customer.credit.invoice', compact('user', 'transactions', 'totalCharged'));
    }
}