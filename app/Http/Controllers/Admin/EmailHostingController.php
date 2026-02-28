<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailHostingOrder;
use App\Models\Domain;
use App\Models\EmailAccount;
use Illuminate\Http\Request;

class EmailHostingController extends Controller
{
    /**
     * View all email hosting orders
     */
    public function orders()
    {
        $orders = EmailHostingOrder::with('user', 'domain', 'emailHostingPlan')
            ->latest()
            ->paginate(15);

        $stats = [
            'total_orders' => EmailHostingOrder::count(),
            'pending' => EmailHostingOrder::where('payment_status', 'pending')->count(),
            'paid' => EmailHostingOrder::where('payment_status', 'paid')->count(),
            'total_revenue' => EmailHostingOrder::where('payment_status', 'paid')->sum('total_amount'),
        ];

        return view('admin.email-hosting.orders', compact('orders', 'stats'));
    }

    /**
     * View single order details
     */
    public function showOrder(EmailHostingOrder $order)
    {
        $order->load('user', 'domain', 'emailHostingPlan');
        $emailAccounts = EmailAccount::where('domain_id', $order->domain_id)->get();

        return view('admin.email-hosting.show-order', compact('order', 'emailAccounts'));
    }

    /**
     * View all domains
     */
    public function domains()
    {
        $domains = Domain::with('user', 'emailHostingPlan')
            ->latest()
            ->paginate(15);

        return view('admin.email-hosting.domains', compact('domains'));
    }

    /**
     * View all email accounts
     */
    public function emailAccounts()
    {
        $accounts = EmailAccount::with('user', 'domain')
            ->latest()
            ->paginate(15);

        return view('admin.email-hosting.email-accounts', compact('accounts'));
    }
}