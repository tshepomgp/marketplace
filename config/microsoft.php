<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Microsoft Partner Center API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Microsoft CSP Partner Center API integration.
    | You'll need to register your application in Azure AD Partner Center
    | and obtain the credentials below.
    |
    */

    'tenant_id' => env('MICROSOFT_TENANT_ID', ''),
    
    'client_id' => env('MICROSOFT_CLIENT_ID', ''),
    
    'client_secret' => env('MICROSOFT_CLIENT_SECRET', ''),
    
    'partner_center_api_url' => env('MICROSOFT_PARTNER_CENTER_URL', 'https://api.partnercenter.microsoft.com'),
    
    'login_url' => env('MICROSOFT_LOGIN_URL', 'https://login.microsoftonline.com'),
    
    'graph_api_url' => env('MICROSOFT_GRAPH_URL', 'https://graph.microsoft.com'),
    
    // API Scopes
    'scopes' => [
        'partner_center' => 'https://api.partnercenter.microsoft.com/.default',
        'graph' => 'https://graph.microsoft.com/.default',
    ],
    
    // API Version
    'api_version' => env('MICROSOFT_API_VERSION', 'v1'),
    
    // Cache settings for tokens
    'cache' => [
        'enabled' => env('MICROSOFT_CACHE_ENABLED', true),
        'ttl' => env('MICROSOFT_CACHE_TTL', 3600), // 1 hour
        'prefix' => 'microsoft_api',
    ],
    
    // Rate limiting
    'rate_limit' => [
        'enabled' => env('MICROSOFT_RATE_LIMIT_ENABLED', true),
        'max_attempts' => env('MICROSOFT_RATE_LIMIT_ATTEMPTS', 100),
        'decay_minutes' => env('MICROSOFT_RATE_LIMIT_DECAY', 1),
    ],
    
    // Retry logic for failed API calls
    'retry' => [
        'enabled' => env('MICROSOFT_RETRY_ENABLED', true),
        'max_attempts' => env('MICROSOFT_RETRY_ATTEMPTS', 3),
        'delay_milliseconds' => env('MICROSOFT_RETRY_DELAY', 1000),
    ],
    
    // Webhook configuration for notifications
    'webhook' => [
        'secret' => env('MICROSOFT_WEBHOOK_SECRET', ''),
        'url' => env('MICROSOFT_WEBHOOK_URL', ''),
    ],
    
    // Sandbox/Production mode
    'sandbox_mode' => env('MICROSOFT_SANDBOX_MODE', true),
];
