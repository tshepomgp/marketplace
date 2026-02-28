<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StorageSku;
use Illuminate\Http\Request;

class StorageSkuController extends Controller
{
    public function index()
    {
        $skus = StorageSku::withCount('storageOrders')->latest()->paginate(20);
        
        return view('admin.storage-skus.index', compact('skus'));
    }

    public function create()
    {
        return view('admin.storage-skus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:SSD,HDD',
            'min_size_gb' => 'required|integer|min:1',
            'max_size_gb' => 'required|integer|min:1',
            'price_per_gb_monthly' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        StorageSku::create($validated);

        return redirect()->route('admin.storage-skus.index')
            ->with('success', 'Storage SKU created successfully!');
    }

    public function edit(StorageSku $storageSku)
    {
        return view('admin.storage-skus.edit', compact('storageSku'));
    }

    public function update(Request $request, StorageSku $storageSku)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:SSD,HDD',
            'min_size_gb' => 'required|integer|min:1',
            'max_size_gb' => 'required|integer|min:1',
            'price_per_gb_monthly' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $storageSku->update($validated);

        return redirect()->route('admin.storage-skus.index')
            ->with('success', 'Storage SKU updated successfully!');
    }

    public function destroy(StorageSku $storageSku)
    {
        if ($storageSku->storageOrders()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete Storage SKU with existing orders');
        }

        $storageSku->delete();

        return redirect()->route('admin.storage-skus.index')
            ->with('success', 'Storage SKU deleted successfully!');
    }

    public function toggleActive(StorageSku $storageSku)
    {
        $storageSku->update(['is_active' => !$storageSku->is_active]);

        return redirect()->back()
            ->with('success', 'Storage SKU status updated!');
    }
}
