<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Microsoft 365 Business Basic',
                'description' => 'Web and mobile versions of Office apps with 1 TB of cloud storage. Perfect for businesses that need email and cloud services.',
                'category' => 'Microsoft 365',
                'base_price' => 10000,
                'selling_price' => 12000,
                'currency' => 'XAF',
                'billing_cycle' => 'monthly',
                'min_quantity' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Microsoft 365 Business Standard',
                'description' => 'Desktop versions of Office apps plus web and mobile versions. Includes Teams, Exchange, SharePoint, and 1 TB storage per user.',
                'category' => 'Microsoft 365',
                'base_price' => 20000,
                'selling_price' => 25000,
                'currency' => 'XAF',
                'billing_cycle' => 'monthly',
                'min_quantity' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Microsoft 365 Business Premium',
                'description' => 'Everything in Business Standard plus advanced security, device management, and information protection.',
                'category' => 'Microsoft 365',
                'base_price' => 35000,
                'selling_price' => 42000,
                'currency' => 'XAF',
                'billing_cycle' => 'monthly',
                'min_quantity' => 1,
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Microsoft 365 E3',
                'description' => 'Best-in-class productivity apps with intelligent cloud services. Includes advanced security, compliance, and analytics.',
                'category' => 'Microsoft 365',
                'base_price' => 40000,
                'selling_price' => 45000,
                'currency' => 'XAF',
                'billing_cycle' => 'monthly',
                'min_quantity' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Office 365 E1',
                'description' => 'Enterprise-level web apps and services. Includes Exchange, SharePoint, Teams, and OneDrive.',
                'category' => 'Office 365',
                'base_price' => 15000,
                'selling_price' => 18000,
                'currency' => 'XAF',
                'billing_cycle' => 'monthly',
                'min_quantity' => 1,
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('5 products created successfully!');
    }
}
