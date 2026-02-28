<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VmOrder;
use Illuminate\Http\Request;

class VmOrderController extends Controller
{
    public function index()
    {
        $orders = VmOrder::with(['customer', 'vmSku', 'operatingSystem'])
            ->latest()
            ->paginate(20);
        
        $stats = [
            'total_orders' => VmOrder::count(),
            'pending_orders' => VmOrder::where('status', 'pending')->count(),
            'active_vms' => VmOrder::where('status', 'active')->count(),
            'total_vcpus' => VmOrder::where('status', 'active')
                ->join('vm_skus', 'vm_orders.vm_sku_id', '=', 'vm_skus.id')
                ->sum(\DB::raw('vm_orders.quantity * vm_skus.vcpus')),
        ];
        
        return view('admin.vm-orders.index', compact('orders', 'stats'));
    }

    public function show(VmOrder $vmOrder)
    {
        $vmOrder->load(['customer', 'vmSku', 'operatingSystem']);
        
        return view('admin.vm-orders.show', compact('vmOrder'));
    }

    public function approve(VmOrder $vmOrder)
    {
        $vmOrder->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'VM Order approved successfully!');
    }

    public function provision(VmOrder $vmOrder)
    {
        $vmOrder->update([
            'status' => 'active',
            'provisioned_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'VM marked as provisioned!');
    }

    public function cancel(VmOrder $vmOrder)
    {
        $vmOrder->update(['status' => 'cancelled']);

        return redirect()->back()
            ->with('success', 'VM Order cancelled!');
    }

    public function destroy(VmOrder $vmOrder)
    {
        if ($vmOrder->status === 'active') {
            return redirect()->back()
                ->with('error', 'Cannot delete active VM order');
        }

        $vmOrder->delete();

        return redirect()->route('admin.vm-orders.index')
            ->with('success', 'VM Order deleted successfully!');
    }
}
