<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StorageOrder;
use Illuminate\Http\Request;

class StorageOrderController extends Controller
{
    public function index()
    {
        $orders = StorageOrder::with(['customer', 'storageSku'])
            ->latest()
            ->paginate(20);
        
        $stats = [
            'total_orders' => StorageOrder::count(),
            'pending_orders' => StorageOrder::where('status', 'pending')->count(),
            'active_storage' => StorageOrder::where('status', 'active')->count(),
            'total_storage_gb' => StorageOrder::where('status', 'active')
                ->sum(\DB::raw('size_gb * quantity')),
        ];
        
        return view('admin.storage-orders.index', compact('orders', 'stats'));
    }

    public function show(StorageOrder $storageOrder)
    {
        $storageOrder->load(['customer', 'storageSku']);
        
        return view('admin.storage-orders.show', compact('storageOrder'));
    }

    public function approve(StorageOrder $storageOrder)
    {
        $storageOrder->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Storage Order approved successfully!');
    }

    public function provision(StorageOrder $storageOrder)
    {
        $storageOrder->update([
            'status' => 'active',
            'provisioned_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Storage marked as provisioned!');
    }

    public function cancel(StorageOrder $storageOrder)
    {
        $storageOrder->update(['status' => 'cancelled']);

        return redirect()->back()
            ->with('success', 'Storage Order cancelled!');
    }

    public function destroy(StorageOrder $storageOrder)
    {
        if ($storageOrder->status === 'active') {
            return redirect()->back()
                ->with('error', 'Cannot delete active storage order');
        }

        $storageOrder->delete();

        return redirect()->route('admin.storage-orders.index')
            ->with('success', 'Storage Order deleted successfully!');
    }
}
