<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Branding Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration allows for easy white-labeling of the application
    | for different countries and partners. Update these values to customize
    | the application for each deployment.
    |
    */

    'company_name' => env('BRAND_COMPANY_NAME', 'MTN Cameroon'),
    
    'logo' => env('BRAND_LOGO', '/images/mtn-cameroon-logo.png'),
    
    'logo_dark' => env('BRAND_LOGO_DARK', '/images/mtn-cameroon-logo-dark.png'),
    
    'favicon' => env('BRAND_FAVICON', '/images/favicon.ico'),
    
    'primary_color' => env('BRAND_PRIMARY_COLOR', '#FFCB05'), // MTN Yellow
    
    'secondary_color' => env('BRAND_SECONDARY_COLOR', '#000000'), // MTN Black
    
    'accent_color' => env('BRAND_ACCENT_COLOR', '#FFCB05'),
    
    'country' => env('BRAND_COUNTRY', 'CM'), // ISO country code
    
    'currency' => env('BRAND_CURRENCY', 'XAF'),
    
    'currency_symbol' => env('BRAND_CURRENCY_SYMBOL', 'FCFA'),
    
    'language' => env('BRAND_LANGUAGE', 'fr'), // Default language
    
    'timezone' => env('BRAND_TIMEZONE', 'Africa/Douala'),
    
    'support_email' => env('BRAND_SUPPORT_EMAIL', 'support@mtn.cm'),
    
    'support_phone' => env('BRAND_SUPPORT_PHONE', '+237 123 456 789'),
    
    'company_address' => env('BRAND_COMPANY_ADDRESS', 'Yaoundé, Cameroon'),
    
    // Social Media Links
    'social' => [
        'facebook' => env('BRAND_FACEBOOK', ''),
        'twitter' => env('BRAND_TWITTER', ''),
        'linkedin' => env('BRAND_LINKEDIN', ''),
        'instagram' => env('BRAND_INSTAGRAM', ''),
    ],
    
    // Country-specific configurations
    'countries' => [
        'CM' => [
            'name' => 'Cameroon',
            'currency' => 'XAF',
            'currency_symbol' => 'FCFA',
            'language' => 'fr',
            'timezone' => 'Africa/Douala',
            'payment_methods' => ['mtn_momo', 'orange_money', 'card'],
        ],
        'ZA' => [
            'name' => 'South Africa',
            'currency' => 'ZAR',
            'currency_symbol' => 'R',
            'language' => 'en',
            'timezone' => 'Africa/Johannesburg',
            'payment_methods' => ['card', 'eft', 'ozow'],
        ],
        'GH' => [
            'name' => 'Ghana',
            'currency' => 'GHS',
            'currency_symbol' => '₵',
            'language' => 'en',
            'timezone' => 'Africa/Accra',
            'payment_methods' => ['mtn_momo', 'vodafone_cash', 'card'],
        ],
    ],
    
    // Feature flags for different deployments
    'features' => [
        'enable_mtn_momo' => env('FEATURE_MTN_MOMO', true),
        'enable_orange_money' => env('FEATURE_ORANGE_MONEY', true),
        'enable_card_payments' => env('FEATURE_CARD_PAYMENTS', true),
        'enable_multi_currency' => env('FEATURE_MULTI_CURRENCY', false),
        'enable_whatsapp_notifications' => env('FEATURE_WHATSAPP', false),
    ],
];
