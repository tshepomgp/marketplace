<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\VmOrder;
use Illuminate\Http\Request;
use App\Mail\NewVmOrderNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\CreditTransaction;
use Auth;


class OrderController extends Controller
{
    /**
     * Show VM ordering page
     */
    public function vmOrdering()
    {
        $products = Product::where('status', 'active')
            ->where('category', 'microsoft_365')  // Adjust if needed
            ->get();

        return view('customer.products.vm-order', compact('products'));
    }

    /**
     * Store new VM order
     */

public function vmCheckout(Request $request)
{
    $product = Product::findOrFail($request->product_id);
    
    return view('customer.vm.checkout', compact('product'));
}

public function storeVm(Request $request)
{
    
    $Amount = str_replace(',', '', $request->total_amount);

    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'product_name' => 'required|string',
        'quantity' => 'required|integer|min:1|max:10',
        'number_of_users' => 'required|integer|min:1',
        'organization_name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'special_requirements' => 'nullable|string',
        'payment_method' => 'required|in:mtn_momo,orange_money,card,credit',
    ]);

    $product = Product::findOrFail($validated['product_id']);
    $totalAmount = $Amount * $validated['quantity'];
    
    $paymentStatus = 'pending';
    
    if ($validated['payment_method'] === 'credit') {
        $user = Auth::user();
        
        if ($user->getAvailableCredit() < $totalAmount) {
            return redirect()->back()->with('error', 'Insufficient credit limit');
        }

        $balanceBefore = $user->credit_used;
        $user->credit_used += $totalAmount;
        $user->save();

        CreditTransaction::create([
            'user_id' => $user->id,
            'transaction_type' => 'order',
            'reference_id' => 'VM-' . time(),
            'amount' => $totalAmount,
            'balance_before' => $balanceBefore,
            'balance_after' => $user->credit_used,
            'description' => 'VM Order - ' . $validated['product_name'],
        ]);

        $paymentStatus = 'paid';
    }

    $order = Order::create([
        'customer_id' => auth()->user()->id,
        'user_id' => auth()->user()->id,
        'product_id' => $request->product_id,
        'order_number' => 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999),
        'quantity' => $request->quantity,
        'total' => $totalAmount,
        'subtotal' => $totalAmount,
        'status' => $validated['payment_method'] === 'credit' ? 'completed' : 'pending',
        'payment_method' => $validated['payment_method'],
        'payment_status' => $paymentStatus,
        'order_data' => json_encode([
            'number_of_users' => $validated['number_of_users'],
            'organization_name' => $validated['organization_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'special_requirements' => $validated['special_requirements'],
        ])
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $request->product_id,
        'product_name' => $request->product_name, 
        'quantity' => $validated['quantity'],
        'unit_price' => $totalAmount / $validated['quantity'],
        'total_price' => $totalAmount,
    ]);

    VmOrder::create([
        'customer_id' => auth()->user()->id,
        'product_id' => $request->product_id,
        'order_number' => $order->order_number,
        'quantity' => $validated['quantity'],
        'total_amount' => $totalAmount,
        'payment_method' => $validated['payment_method'],
        'payment_status' => $paymentStatus,
        'status' => $validated['payment_method'] === 'credit' ? 'active' : 'pending'
    ]);

    Mail::to('tshepo.mataboge@mtn.com')->send(new NewVmOrderNotification($order));
    
    return redirect()->route('customer.orders.success', ['order' => $order])
        ->with('success', 'VM order placed successfully!');
}
    /**
     * Show my VM orders
     */
    public function myVmOrders()
    {
        $vmOrders = auth()->user()
            ->vmOrders()
            ->with('product')
            ->latest()
            ->paginate(10);

        return view('vm-orders.my-orders', compact('vmOrders'));
    }

    /**
     * Show single VM order details
     */
    public function showVm(Order $order)
    {
        // Check authorization
        if ($order->customer_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }

        $order->load('product', 'customer');

        return view('customer.orders.show', compact('order'));
    }

    /**
     * Show order success page
     */
    public function success(Order $order)
    {
        if ($order->customer_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }

         $product = request('product');

        return view('customer.orders.success', compact('order', 'product'));
    }

    /**
     * Show order details
     */
    public function show(Order $order)
    {
        if ($order->customer_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }

        return view('customer.orders.show', compact('order'));
    }

    /**
     * Show my storage orders
     */
    public function myStorageOrders()
    {
        $storageOrders = auth()->user()
            ->storageOrders()
            ->latest()
            ->paginate(10);

        return view('storage-orders.my-orders', compact('storageOrders'));
    }
}