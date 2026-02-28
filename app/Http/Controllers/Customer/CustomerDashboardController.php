<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Subscription;
use App\Models\VmOrder;
use App\Models\StorageOrder;
use Auth;

class CustomerDashboardController extends Controller
{
    /**
     * Show customer dashboard
     */
    public function index()
    {
        $user = Auth::user();
     $recentOrders = auth()->user()
    ->orders()
    ->with('user')
    ->latest()
    ->take(50)
    ->get();

$vmOrders = auth()->user()
    ->vmOrders()
    ->with('user')    
    ->latest()
    ->take(50)
    ->get();
   

$storageOrders = auth()->user()
    ->storageOrders()
    ->with('product')
    ->latest()
    ->take(50)
    ->get();
       
        // You can uncomment these once your models are set up:
        // $recentOrders = Order::where('customer_id', $user->id)->latest()->take(5)->get();
        // $storageOrders = StorageOrder::where('customer_id', $user->id)->latest()->take(5)->get();
        
        return view('customer.dashboard', [
            'user' => $user,
            'recentOrders' => $recentOrders,
            'vmOrders' =>  $vmOrders,
            'storageOrders' => $storageOrders
        ]);
    }


    // CustomerDashboardController.php

public function vmControl(Order $order)
{
    // Fetch VM processes (example, replace with real API)
    $processes = 'top-like output here';
    
    return view('customer.vm-control', compact('order', 'processes'));
}

public function restartVm(Order $order)
{
    // Call your VM API to restart
    // Example: VmService::restart($order->vm_id);

    return redirect()->back()->with('success', 'VM restart initiated');
}

public function scaleVm(Request $request, Order $order)
{
    $size = $request->size;
    // Call your VM API to scale
    // Example: VmService::scale($order->vm_id, $size);

    return redirect()->back()->with('success', "VM scaled to $size");
}

}