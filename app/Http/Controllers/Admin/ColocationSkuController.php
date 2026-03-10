<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ColocationSku;
use Illuminate\Http\Request;

class ColocationSkuController extends Controller
{
    public function index()
    {
        $skus = ColocationSku::latest()->paginate(15);
        return view('admin.colocation-skus.index', compact('skus'));
    }

    public function create()
    {
        return view('admin.colocation-skus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'sku_code' => 'required|unique:colocation_skus',
            'type' => 'required|in:standard,premium,enterprise',
            'rack_units' => 'required|integer',
            'power_supply' => 'required|string',
            'monthly_price' => 'required|numeric',
            'setup_fee' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        ColocationSku::create($validated);
        return redirect()->route('admin.colocation-skus.index')->with('success', 'SKU created!');
    }

    public function edit(ColocationSku $colocationSku)
    {
        return view('admin.colocation-skus.edit', compact('colocationSku'));
    }

    public function update(Request $request, ColocationSku $colocationSku)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'monthly_price' => 'required|numeric',
            'setup_fee' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $colocationSku->update($validated);
        return redirect()->route('admin.colocation-skus.index')->with('success', 'SKU updated!');
    }

    public function destroy(ColocationSku $colocationSku)
    {
        $colocationSku->delete();
        return redirect()->route('admin.colocation-skus.index')->with('success', 'SKU deleted!');
    }
}
