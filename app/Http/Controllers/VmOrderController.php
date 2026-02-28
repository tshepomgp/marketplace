<?php

namespace App\Http\Controllers;

use App\Models\VmOrder;
use App\Models\VmSku;
use App\Models\OperatingSystem;
use App\Mail\VmOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VmOrderController extends Controller
{
    public function index()
    {
        $vmSkus = VmSku::where('is_active', true)->get();
        $operatingSystems = OperatingSystem::where('is_active', true)->get();
        
        return view('vm-orders.create', compact('vmSkus', 'operatingSystems'));
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'vm_sku_id' => 'required|exists:vm_skus,id',
            'operating_system_id' => 'required|exists:operating_systems,id',
            'disk_size_gb' => 'required|integer|min:10|max:10000',
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $vmSku = VmSku::findOrFail($validated['vm_sku_id']);
        $os = OperatingSystem::findOrFail($validated['operating_system_id']);
        
        // Calculate costs
        $vmCost = $vmSku->price_monthly * $validated['quantity'];
        $osCost = $os->license_cost * $validated['quantity'];
        $diskCost = ($validated['disk_size_gb'] * 50) * $validated['quantity']; // 50 XAF per GB
        $setupFee = 5000 * $validated['quantity']; // 5000 XAF per VM
        
        $monthlyCost = $vmCost + $osCost + $diskCost;
        
        return response()->json([
            'monthly_cost' => $monthlyCost,
            'setup_fee' => $setupFee,
            'breakdown' => [
                'vm_cost' => $vmCost,
                'os_cost' => $osCost,
                'disk_cost' => $diskCost,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vm_sku_id' => 'required|exists:vm_skus,id',
            'operating_system_id' => 'required|exists:operating_systems,id',
            'disk_size_gb' => 'required|integer|min:10|max:10000',
            'quantity' => 'required|integer|min:1|max:100',
            'vm_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $vmSku = VmSku::findOrFail($validated['vm_sku_id']);
        $os = OperatingSystem::findOrFail($validated['operating_system_id']);
        
        // Calculate costs
        $vmCost = $vmSku->price_monthly * $validated['quantity'];
        $osCost = $os->license_cost * $validated['quantity'];
        $diskCost = ($validated['disk_size_gb'] * 50) * $validated['quantity'];
        $setupFee = 5000 * $validated['quantity'];
        
        $monthlyCost = $vmCost + $osCost + $diskCost;

        // Create VM Order
        $vmOrder = VmOrder::create([
            'customer_id' => auth()->user()->customer_id,
            'order_number' => 'VM-' . strtoupper(uniqid()),
            'vm_sku_id' => $validated['vm_sku_id'],
            'operating_system_id' => $validated['operating_system_id'],
            'disk_size_gb' => $validated['disk_size_gb'],
            'quantity' => $validated['quantity'],
            'vm_name' => $validated['vm_name'],
            'notes' => $validated['notes'],
            'monthly_cost' => $monthlyCost,
            'setup_fee' => $setupFee,
            'currency' => 'XAF',
            'status' => 'pending',
        ]);

        // Send email notification
        try {
            $notificationEmail = config('mail.vm_order_email', 'tsheposethmataboge@gmail.com');
            Mail::to($notificationEmail)->send(new VmOrderNotification($vmOrder));
        } catch (\Exception $e) {
            \Log::error('Failed to send VM order email: ' . $e->getMessage());
        }

        return redirect()->route('vm-orders.success', $vmOrder->id)
            ->with('success', 'VM order submitted successfully!');
    }

    public function success($id)
    {
        $vmOrder = VmOrder::with(['vmSku', 'operatingSystem'])->findOrFail($id);
        
        // Ensure user can only view their own orders
        if ($vmOrder->customer_id !== auth()->user()->customer_id) {
            abort(403);
        }
        
        return view('vm-orders.success', compact('vmOrder'));
    }

    public function myOrders()
    {
        $vmOrders = auth()->user()->vmOrders() // auth()->user()->customer->vmOrders()
            ->with(['vmSku', 'operatingSystem'])
            ->latest()
            ->paginate(10);
        
        return view('vm-orders.my-orders', compact('vmOrders'));
    }

    public function show(VmOrder $vmOrder)
    {
        // Ensure user can only view their own orders
        if ($vmOrder->customer_id !== auth()->user()->customer_id) {
            abort(403);
        }
        
        $vmOrder->load(['vmSku', 'operatingSystem']);
        
        return view('vm-orders.show', compact('vmOrder'));
    }
}
