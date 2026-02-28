<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscriptions.index');
    }

    public function show($id)
    {
        return view('subscriptions.show');
    }

    public function upgrade($id)
    {
        return redirect()->back()->with('info', 'Upgrade feature coming soon');
    }

    public function cancel($id)
    {
        return redirect()->back()->with('info', 'Cancel feature coming soon');
    }
}
