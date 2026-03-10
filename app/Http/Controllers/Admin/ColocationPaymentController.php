<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ColocationPayment;

class ColocationPaymentController extends Controller
{
    public function index()
    {
        $payments = ColocationPayment::with('customer', 'sku', 'order')
            ->latest()
            ->paginate(20);

        $stats = [
            'total_payments' => ColocationPayment::count(),
            'completed' => ColocationPayment::where('payment_status', 'completed')->count(),
            'pending' => ColocationPayment::where('payment_status', 'pending')->count(),
            'total_revenue' => ColocationPayment::where('payment_status', 'completed')->sum('amount'),
        ];

        return view('admin.colocation-payments.index', compact('payments', 'stats'));
    }

    public function show(ColocationPayment $colocationPayment)
    {
        $colocationPayment->load('customer', 'sku', 'order');
        return view('admin.colocation-payments.show', compact('colocationPayment'));
    }
}
