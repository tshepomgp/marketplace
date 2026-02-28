<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailHostingPlan;
use Illuminate\Http\Request;

class EmailHostingPlanController extends Controller
{
    public function index()
    {
        $plans = EmailHostingPlan::all();
        return view('admin.email-hosting-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.email-hosting-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'sku_code' => 'required|unique:email_hosting_plans',
            'price_per_mailbox' => 'required|numeric',
            'domain_price' => 'required|numeric',
            'storage_gb' => 'required|integer',
            'mailboxes_included' => 'required|integer',
            'features' => 'nullable|json',
        ]);

        EmailHostingPlan::create($validated);
        return redirect()->route('admin.email-hosting-plans.index')->with('success', 'Plan created!');
    }

    public function edit(EmailHostingPlan $emailHostingPlan)
    {
        return view('admin.email-hosting-plans.edit', compact('emailHostingPlan'));
    }

    public function update(Request $request, EmailHostingPlan $emailHostingPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price_per_mailbox' => 'required|numeric',
            'domain_price' => 'required|numeric',
            'storage_gb' => 'required|integer',
            'mailboxes_included' => 'required|integer',
        ]);

        $emailHostingPlan->update($validated);
        return redirect()->route('admin.email-hosting-plans.index')->with('success', 'Plan updated!');
    }

    public function destroy(EmailHostingPlan $emailHostingPlan)
    {
        $emailHostingPlan->delete();
        return redirect()->route('admin.email-hosting-plans.index')->with('success', 'Plan deleted!');
    }
}