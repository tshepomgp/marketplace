<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\CreditTransaction;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
       
        $cart = session()->get('cart', []);
       
        if (empty($cart)) {
            return redirect()->route('cart.index')
                           ->with('error', 'Your cart is empty');
        }
        
        $total = $this->calculateTotal($cart);
        
        return view('checkout.index', compact('cart', 'total'));
    }

    /**
     * Process checkout and create order
     */
    public function processOrder(Request $request)
    {
        
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|in:mtn_momo,orange_money,card,credit',
            'tenant_type' => 'required|in:new,existing',
            'existing_tenant_id' => 'required_if:tenant_type,existing|nullable|string',
            'agree_terms' => 'required|accepted',
        ]);

        $cart = session()->get('cart', []);
       
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                           ->with('error', 'Your cart is empty');
        }

        try {
            // Update user information
            Auth::user()->update([
                'company_name' => $validated['company_name'],
                'phone' => $validated['phone'],
            ]);

            // Create order for each cart item
            foreach ($cart as $productId => $item) {
                $order = \App\Models\Order::create([
                    'customer_id' => Auth::user()->id,
                    'product_id' => $productId,
                    'order_number' => 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999),
                    'quantity' => $item['quantity'],
                    'total_amount' => $item['price'] * $item['quantity'],
                    'status' => 'pending',
                    'order_data' => json_encode([
                        'contact_name' => $validated['contact_name'],
                        'address' => $validated['address'],
                        'city' => $validated['city'],
                        'country' => $validated['country'],
                        'payment_method' => $validated['payment_method'],
                        'tenant_type' => $validated['tenant_type'],
                        'existing_tenant_id' => $validated['existing_tenant_id'] ?? null,
                    ])
                ]);

                    $orderItem = \App\Models\OrderItem::create([
                    
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' =>$item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price'=> $item['price'],
                    'total_amount' => $item['price'] * $item['quantity'],
                    
                ]);
            }

            // TODO: Integrate payment gateway
            // For now, simulate payment success
            $paymentSuccess = true;

            if ($paymentSuccess) {
                // Clear cart
                session()->forget('cart');
                
                return redirect()->route('checkout.success')
                               ->with('success', 'Order placed successfully! You will receive a confirmation email shortly.');
            }

        } catch (\Exception $e) {
            Log::error('Checkout failed: ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Order processing failed. Please try again.');
        }
    }

    /**
     * Show success page
     */
    public function success()
    {
        return view('checkout.success');
    }

    /**
     * Calculate total from cart
     */
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }





public function process(Request $request)
{


    $cart = session('cart', []);
    
    if (empty($cart)) {
        return back()->with('error', 'Cart is empty');
    }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|in:mtn_momo,orange_money,card,credit',
            'tenant_type' => 'required|in:new,existing',
            'existing_tenant_id' => 'required_if:tenant_type,existing|nullable|string',
            'agree_terms' => 'required|accepted',
        ]);

    $user = Auth::user();
    $totalAmount = $this->calculateTotal($cart);

    \Log::info('Payment method: ' . $validated['payment_method']);

    /*
    |--------------------------------------------------------------------------
    | IF NOT CREDIT → CALL processOrder()
    |--------------------------------------------------------------------------
    */
    if ($validated['payment_method'] !== 'credit') {
        return $this->processOrder($request);
    }

    /*
    |--------------------------------------------------------------------------
    | CREDIT PAYMENT FLOW
    |--------------------------------------------------------------------------
    */
    // Create order for each cart item
            foreach ($cart as $productId => $item) {
                $order = \App\Models\Order::create([
                    'customer_id' => Auth::user()->id,
                    'product_id' => $productId,
                    'order_number' => 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999),
                    'quantity' => $item['quantity'],
                    'total_amount' => $item['price'] * $item['quantity'],
                    'status' => 'pending',
                    'order_data' => json_encode([
                        'contact_name' => $validated['contact_name'],
                        'address' => $validated['address'],
                        'city' => $validated['city'],
                        'country' => $validated['country'],
                        'payment_method' => $validated['payment_method'],
                        'tenant_type' => $validated['tenant_type'],
                        'existing_tenant_id' => $validated['existing_tenant_id'] ?? null,
                    ])
                ]);

                    $orderItem = \App\Models\OrderItem::create([
                    
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' =>$item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price'=> $item['price'],
                    'total_amount' => $item['price'] * $item['quantity'],
                    
                ]);
            }

    // Create order
    //$order = Order::create([
   ///     'customer_id' => $user->id,
   //     'order_number' => 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999),
   //     'total' => $totalAmount,
   //     'payment_method' => 'credit',
   //     'status' => 'pending',
   //     'payment_status' => 'pending',
   // ]);

    if ($user->getAvailableCredit() < $totalAmount) {
        $order->delete();
        return back()->with('error', 'Insufficient credit limit - Please connect MTN to request for a credit limit');
    }

    // Deduct credit
    $balanceBefore = $user->credit_used;
    $user->credit_used += $totalAmount;
    $user->save();

    CreditTransaction::create([
        'user_id' => $user->id,
        'transaction_type' => 'order',
        'reference_id' => $order->id,
        'amount' => $totalAmount,
        'balance_before' => $balanceBefore,
        'balance_after' => $user->credit_used,
        'description' => 'Order deduction',
    ]);

    $order->payment_status = 'paid';
    $order->save();

    session()->forget('cart');

    return redirect()->route('customer.orders.success', $order);
}
}