<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VmSkusSeeder extends Seeder
{
    public function run(): void
    {
        $skus = [
            // Linux VMs
            [
                'name' => 'Alma Linux Small',
                'description' => 'Alma Linux - 2 vCPUs, 4GB RAM',
                'vcpus' => 2,
                'ram_gb' => 4,
                'price_monthly' => 400,
                'currency' => 'XAF',
                'is_active' => 1,
            ],
            [
                'name' => 'Alma Linux Medium',
                'description' => 'Alma Linux - 4 vCPUs, 16GB RAM',
                'vcpus' => 4,
                'ram_gb' => 16,
                'price_monthly' => 800,
                'currency' => 'XAF',
                'is_active' => 1,
            ],
            [
                'name' => 'Alma Linux Large',
                'description' => 'Alma Linux - 8 vCPUs, 32GB RAM',
                'vcpus' => 8,
                'ram_gb' => 32,
                'price_monthly' => 1400,
                'currency' => 'XAF',
                'is_active' => 1,
            ],

            // Ubuntu VMs
            [
                'name' => 'Ubuntu Small',
                'description' => 'Ubuntu - 2 vCPUs, 4GB RAM',
                'vcpus' => 2,
                'ram_gb' => 4,
                'price_monthly' => 450,
                'currency' => 'XAF',
                'is_active' => 1,
            ],
            [
                'name' => 'Ubuntu Medium',
                'description' => 'Ubuntu - 4 vCPUs, 16GB RAM',
                'vcpus' => 4,
                'ram_gb' => 16,
                'price_monthly' => 850,
                'currency' => 'XAF',
                'is_active' => 1,
            ],

            // Windows VMs
            [
                'name' => 'Windows Server Small',
                'description' => 'Windows Server - 2 vCPUs, 8GB RAM',
                'vcpus' => 2,
                'ram_gb' => 8,
                'price_monthly' => 900,
                'currency' => 'XAF',
                'is_active' => 1,
            ],
            [
                'name' => 'Windows Server Medium',
                'description' => 'Windows Server - 4 vCPUs, 16GB RAM',
                'vcpus' => 4,
                'ram_gb' => 16,
                'price_monthly' => 1600,
                'currency' => 'XAF',
                'is_active' => 1,
            ],
            [
                'name' => 'Windows Server Large',
                'description' => 'Windows Server - 8 vCPUs, 32GB RAM',
                'vcpus' => 8,
                'ram_gb' => 32,
                'price_monthly' => 2800,
                'currency' => 'XAF',
                'is_active' => 1,
            ],
        ];

        // Add timestamps
        foreach ($skus as &$sku) {
            $sku['created_at'] = now();
            $sku['updated_at'] = now();
        }

        DB::table('vm_skus')->insert($skus);
    }
}
