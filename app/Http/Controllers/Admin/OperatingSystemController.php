<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OperatingSystem;
use Illuminate\Http\Request;

class OperatingSystemController extends Controller
{
    public function index()
    {
        $operatingSystems = OperatingSystem::withCount('vmOrders')->latest()->paginate(20);
        
        return view('admin.operating-systems.index', compact('operatingSystems'));
    }

    public function create()
    {
        return view('admin.operating-systems.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'version' => 'required|string|max:100',
            'type' => 'required|in:Windows,Linux',
            'license_cost' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        OperatingSystem::create($validated);

        return redirect()->route('admin.operating-systems.index')
            ->with('success', 'Operating System created successfully!');
    }

    public function edit(OperatingSystem $operatingSystem)
    {
        return view('admin.operating-systems.edit', compact('operatingSystem'));
    }

    public function update(Request $request, OperatingSystem $operatingSystem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'version' => 'required|string|max:100',
            'type' => 'required|in:Windows,Linux',
            'license_cost' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $operatingSystem->update($validated);

        return redirect()->route('admin.operating-systems.index')
            ->with('success', 'Operating System updated successfully!');
    }

    public function destroy(OperatingSystem $operatingSystem)
    {
        if ($operatingSystem->vmOrders()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete OS with existing orders');
        }

        $operatingSystem->delete();

        return redirect()->route('admin.operating-systems.index')
            ->with('success', 'Operating System deleted successfully!');
    }

    public function toggleActive(OperatingSystem $operatingSystem)
    {
        $operatingSystem->update(['is_active' => !$operatingSystem->is_active]);

        return redirect()->back()
            ->with('success', 'Operating System status updated!');
    }
}
