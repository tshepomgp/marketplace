<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class VmProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vms = [
            [
                'name' => 'Small VM',
                'sku_code' => 'VM_B_SMALL_2024',
                'category' => 'VM',
                'selling_price' => 25000,
                'description' => 'Entry-level VM for small business applications. Perfect for development and testing environments.',
                'features' => json_encode([
                    'os' => 'Windows Server 2022 Standard',
                    'cpu' => '2 vCPU',
                    'ram' => '4 GB',
                    'storage' => '50 GB SSD',
                    'bandwidth' => 'Unlimited',
                    'support' => 'Email Support',
                    'uptime_sla' => '99.5%',
                    'location' => 'Cameroon Data Center',
                ]),
                
                'min_quantity' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Medium VM',
                'sku_code' => 'VM_B_MED_2024',
                'category' => 'VM',
                'selling_price' => 50000,
                'description' => 'Mid-tier VM for growing businesses. Suitable for production workloads and web applications.',
                'features' => json_encode([
                    'os' => 'Windows Server 2022 Standard',
                    'cpu' => '4 vCPU',
                    'ram' => '8 GB',
                    'storage' => '100 GB SSD',
                    'bandwidth' => 'Unlimited',
                    'support' => 'Phone & Email Support',
                    'uptime_sla' => '99.9%',
                    'location' => 'Cameroon Data Center',
                    'database' => 'SQL Server Express',
                ]),
                
                'min_quantity' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Large VM',
                'sku_code' => 'VM_B_LARGE_2024',
                'category' => 'VM',
                'selling_price' => 100000,
                'description' => 'High-performance VM for enterprise applications. Handles heavy workloads and high traffic.',
                'features' => json_encode([
                    'os' => 'Windows Server 2022 Datacenter',
                    'cpu' => '8 vCPU',
                    'ram' => '16 GB',
                    'storage' => '250 GB SSD',
                    'bandwidth' => 'Unlimited',
                    'support' => '24/7 Priority Support',
                    'uptime_sla' => '99.95%',
                    'location' => 'Cameroon Data Center',
                    'database' => 'SQL Server Standard',
                    'backup' => 'Daily Automated Backups',
                ]),
               
                'min_quantity' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Enterprise VM',
                'sku_code' => 'VM_E_XL_2024',
                'category' => 'VM',
                'selling_price' => 175000,
                'description' => 'Enterprise-grade VM for mission-critical applications. Maximum performance and reliability.',
                'features' => json_encode([
                    'os' => 'Windows Server 2022 Datacenter',
                    'cpu' => '16 vCPU',
                    'ram' => '32 GB',
                    'storage' => '500 GB SSD',
                    'bandwidth' => 'Unlimited',
                    'support' => '24/7 Dedicated Support',
                    'uptime_sla' => '99.99%',
                    'location' => 'Cameroon Data Center',
                    'database' => 'SQL Server Enterprise',
                    'backup' => 'Real-time Backups with Replication',
                    'security' => 'DDoS Protection Included',
                    'monitoring' => '24/7 Monitoring',
                ]),
               
                'min_quantity' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Ubuntu Linux VM - Developer Edition',
                'sku_code' => 'VM_LINUX_DEV_2024',
                'category' => 'VM',
                'selling_price' => 15000,
                'description' => 'Lightweight Linux VM perfect for web development and open-source applications.',
                'features' => json_encode([
                    'os' => 'Ubuntu 22.04 LTS',
                    'cpu' => '2 vCPU',
                    'ram' => '2 GB',
                    'storage' => '30 GB SSD',
                    'bandwidth' => 'Unlimited',
                    'support' => 'Community Support',
                    'uptime_sla' => '99.5%',
                    'location' => 'Cameroon Data Center',
                    'pre_installed' => 'Node.js, Python, Docker, Git',
                    'selling_price_currency' => 'XAF',
                ]),
                'min_quantity' => 1,
                'status' => 'active',
            ],
        ];

        foreach ($vms as $vm) {
            Product::create($vm);
        }

        $this->command->info('5 VM products seeded successfully!');
    }
}