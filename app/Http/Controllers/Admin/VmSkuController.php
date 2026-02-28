<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VmSku;
use Illuminate\Http\Request;

class VmSkuController extends Controller
{
    public function index()
    {
        $skus = VmSku::withCount('vmOrders')->latest()->paginate(20);
        
        return view('admin.vm-skus.index', compact('skus'));
    }

    public function create()
    {
        return view('admin.vm-skus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'vcpus' => 'required|integer|min:1|max:128',
            'ram_gb' => 'required|integer|min:1|max:1024',
            'price_monthly' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        VmSku::create($validated);

        return redirect()->route('admin.vm-skus.index')
            ->with('success', 'VM SKU created successfully!');
    }

    public function edit(VmSku $vmSku)
    {
        return view('admin.vm-skus.edit', compact('vmSku'));
    }

    public function update(Request $request, VmSku $vmSku)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'vcpus' => 'required|integer|min:1|max:128',
            'ram_gb' => 'required|integer|min:1|max:1024',
            'price_monthly' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $vmSku->update($validated);

        return redirect()->route('admin.vm-skus.index')
            ->with('success', 'VM SKU updated successfully!');
    }

    public function destroy(VmSku $vmSku)
    {
        if ($vmSku->vmOrders()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete VM SKU with existing orders');
        }

        $vmSku->delete();

        return redirect()->route('admin.vm-skus.index')
            ->with('success', 'VM SKU deleted successfully!');
    }

    public function toggleActive(VmSku $vmSku)
    {
        $vmSku->update(['is_active' => !$vmSku->is_active]);

        return redirect()->back()
            ->with('success', 'VM SKU status updated!');
    }
}
