<?php

namespace App\Http\Controllers;

use App\Models\StorageOrder;
use App\Models\StorageSku;
use App\Mail\StorageOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StorageOrderController extends Controller
{
    public function index()
    {
        $storageSkus = StorageSku::where('is_active', true)->get();
        
        return view('storage-orders.create', compact('storageSkus'));
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'storage_sku_id' => 'required|exists:storage_skus,id',
            'size_gb' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $storageSku = StorageSku::findOrFail($validated['storage_sku_id']);
        
        // Validate size is within range
        if ($validated['size_gb'] < $storageSku->min_size_gb || $validated['size_gb'] > $storageSku->max_size_gb) {
            return response()->json([
                'error' => "Size must be between {$storageSku->min_size_gb} GB and {$storageSku->max_size_gb} GB"
            ], 422);
        }
        
        // Calculate costs
        $monthlyCost = ($storageSku->price_per_gb_monthly * $validated['size_gb']) * $validated['quantity'];
        
        return response()->json([
            'monthly_cost' => $monthlyCost,
            'price_per_gb' => $storageSku->price_per_gb_monthly,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'storage_sku_id' => 'required|exists:storage_skus,id',
            'size_gb' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1|max:100',
            'storage_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $storageSku = StorageSku::findOrFail($validated['storage_sku_id']);
        
        // Validate size is within range
        if ($validated['size_gb'] < $storageSku->min_size_gb || $validated['size_gb'] > $storageSku->max_size_gb) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Size must be between {$storageSku->min_size_gb} GB and {$storageSku->max_size_gb} GB");
        }
        
        // Calculate costs
        $monthlyCost = ($storageSku->price_per_gb_monthly * $validated['size_gb']) * $validated['quantity'];

        // Create Storage Order
        $storageOrder = StorageOrder::create([
            'customer_id' => auth()->user()->customer_id,
            'order_number' => 'STG-' . strtoupper(uniqid()),
            'storage_sku_id' => $validated['storage_sku_id'],
            'size_gb' => $validated['size_gb'],
            'quantity' => $validated['quantity'],
            'storage_name' => $validated['storage_name'],
            'notes' => $validated['notes'],
            'monthly_cost' => $monthlyCost,
            'currency' => 'XAF',
            'status' => 'pending',
        ]);

        // Send email notification
        try {
            $notificationEmail = config('mail.storage_order_email', 'tsheposethmataboge@gmail.com');
            Mail::to($notificationEmail)->send(new StorageOrderNotification($storageOrder));
        } catch (\Exception $e) {
            \Log::error('Failed to send Storage order email: ' . $e->getMessage());
        }

        return redirect()->route('storage-orders.success', $storageOrder->id)
            ->with('success', 'Storage order submitted successfully!');
    }

    public function success($id)
    {
        $storageOrder = StorageOrder::with('storageSku')->findOrFail($id);
        
        // Ensure user can only view their own orders
        if ($storageOrder->customer_id !== auth()->user()->customer_id) {
            abort(403);
        }
        
        return view('storage-orders.success', compact('storageOrder'));
    }

    public function myOrders()
    {
        $storageOrders = auth()->user()->storageOrders()
            ->with('storageSku')
            ->latest()
            ->paginate(10);
        
        return view('storage-orders.my-orders', compact('storageOrders'));
    }

    public function show(StorageOrder $storageOrder)
    {
        // Ensure user can only view their own orders
        if ($storageOrder->customer_id !== auth()->user()->customer_id) {
            abort(403);
        }
        
        $storageOrder->load('storageSku');
        
        return view('storage-orders.show', compact('storageOrder'));
    }
}
