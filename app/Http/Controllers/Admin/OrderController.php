<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function vmOrders()
{
        $orders = \App\Models\VmOrder::with('customer', 'product')      
            ->latest()
            ->get();

           
        return view('admin.orders.vm-orders', compact('orders'));
    }

public function storageOrders()
{
    $orders = \App\Models\StorageOrder::with('customer', 'storageSku')  
        ->latest()
        ->get();

    return view('admin.orders.storage-orders', compact('orders'));
}
}
