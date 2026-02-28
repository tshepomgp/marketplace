<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->customer->orders()->latest()->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->customer_id !== auth()->user()->customer_id) {
            abort(403, 'Unauthorized access to this order');
        }
        
        return view('orders.show', compact('order'));
    }

    public function invoice(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->customer_id !== auth()->user()->customer_id) {
            abort(403, 'Unauthorized access to this order');
        }
        
        return view('orders.invoice', compact('order'));
    }
}
