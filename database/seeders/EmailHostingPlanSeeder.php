<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailHostingPlan;

class EmailHostingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'sku_code' => 'EMAIL_STARTER_2024',
                'description' => 'Perfect for individuals and small projects',
                'price_per_mailbox' => 5000,
                'domain_price' => 35000,
                'storage_gb' => 50,
                'mailboxes_included' => 1,
                'features' => json_encode([
                    '50 GB Storage',
                    'IMAP & POP3 Access',
                    'Webmail Interface',
                    'Basic Spam Filtering',
                    'Email Forwarding',
                    'Mobile Access',
                ]),
                'status' => 'active',
            ],
            [
                'name' => 'Professional',
                'sku_code' => 'EMAIL_PROFESSIONAL_2024',
                'description' => 'Ideal for growing businesses',
                'price_per_mailbox' => 8500,
                'domain_price' => 35000,
                'storage_gb' => 100,
                'mailboxes_included' => 5,
                'features' => json_encode([
                    '100 GB Storage per mailbox',
                    'IMAP & POP3 Access',
                    'Advanced Webmail',
                    'Advanced Spam & Virus Filtering',
                    'Calendar & Contacts Sync',
                    'Email Forwarding',
                    'Mobile Push Support',
                    'Group Management',
                    'Priority Support',
                ]),
                'status' => 'active',
            ],
            [
                'name' => 'Enterprise',
                'sku_code' => 'EMAIL_ENTERPRISE_2024',
                'description' => 'For large organizations',
                'price_per_mailbox' => 12000,
                'domain_price' => 35000,
                'storage_gb' => 250,
                'mailboxes_included' => 20,
                'features' => json_encode([
                    '250 GB Storage per mailbox',
                    'Unlimited IMAP/POP3 Access',
                    'Professional Webmail',
                    'Advanced Security Features',
                    'Automatic Backup',
                    'Calendar & Contacts Sync',
                    'Email Archiving',
                    'Advanced Reporting',
                    'API Access',
                    'Dedicated Support',
                    'Custom Domain Branding',
                    'Two-Factor Authentication',
                ]),
                'status' => 'active',
            ],
        ];

        foreach ($plans as $plan) {
             EmailHostingPlan::firstOrCreate(
                ['sku_code' => $plan['sku_code']],
                $plan
            );
        }

        $this->command->info('Email hosting plans seeded successfully!');
    }
}
