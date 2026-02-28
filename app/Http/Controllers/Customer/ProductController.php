<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\VmSku;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show VM ordering page
     */
    public function vmOrdering()
    {
        $products = VmSku::where('is_Active', '1')
             ->get();
           
        return view('customer.products.vm-order', [
            'products' => $products
        ]);
    }

     public function licenceOrdering()
    {
        $products = Product::where('category', 'microsoft_365')
            ->where('status', 'active')
            ->get();
            
        return view('customer.products.licence-ordering', [
            'products' => $products
        ]);
    }

    /**
     * Show storage ordering page
     */
    public function storageOrdering()
    {
        $storagePlans = [
            [
                'type' => 'standard',
                'name' => 'Standard Storage',
                'price_per_tb' => 50000,
                'features' => ['Unlimited access', '99.9% uptime SLA', 'Email support']
            ],
            [
                'type' => 'premium',
                'name' => 'Premium Storage',
                'price_per_tb' => 75000,
                'features' => ['Geo-redundancy', '99.95% uptime SLA', '24/7 priority support']
            ],
            [
                'type' => 'enterprise',
                'name' => 'Enterprise Storage',
                'price_per_tb' => 100000,
                'features' => ['Military-grade encryption', '99.99% uptime SLA', 'Dedicated account manager']
            ]
        ];
        
        return view('customer.products.storage-ordering', [
            'plans' => $storagePlans
        ]);
    }
}