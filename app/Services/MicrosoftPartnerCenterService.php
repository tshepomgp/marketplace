<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class MicrosoftPartnerCenterService
{
    protected $accessToken;
    protected $baseUrl;
    protected $apiVersion;
    
    public function __construct()
    {
        $this->baseUrl = config('microsoft.partner_center_api_url');
        $this->apiVersion = config('microsoft.api_version');
    }
    
    /**
     * Get authenticated access token
     */
    protected function getAccessToken()
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }
        
        // Check cache first
        if (config('microsoft.cache.enabled')) {
            $cachedToken = Cache::get(config('microsoft.cache.prefix') . '_access_token');
            if ($cachedToken) {
                $this->accessToken = $cachedToken;
                return $this->accessToken;
            }
        }
        
        try {
            $response = Http::asForm()->post(
                config('microsoft.login_url') . '/' . config('microsoft.tenant_id') . '/oauth2/v2.0/token',
                [
                    'client_id' => config('microsoft.client_id'),
                    'client_secret' => config('microsoft.client_secret'),
                    'scope' => config('microsoft.scopes.partner_center'),
                    'grant_type' => 'client_credentials',
                ]
            );
            
            if ($response->successful()) {
                $data = $response->json();
                $this->accessToken = $data['access_token'];
                
                // Cache the token
                if (config('microsoft.cache.enabled')) {
                    Cache::put(
                        config('microsoft.cache.prefix') . '_access_token',
                        $this->accessToken,
                        now()->addSeconds($data['expires_in'] - 300) // Expire 5 mins early
                    );
                }
                
                return $this->accessToken;
            }
            
            throw new Exception('Failed to obtain access token: ' . $response->body());
            
        } catch (Exception $e) {
            Log::error('Microsoft API Authentication Error: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Make authenticated API request
     */
    protected function makeRequest($method, $endpoint, $data = [])
    {
        $token = $this->getAccessToken();
        $url = "{$this->baseUrl}/{$this->apiVersion}/{$endpoint}";
        
        try {
            $response = Http::withToken($token)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->$method($url, $data);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            // Handle specific error codes
            if ($response->status() === 401) {
                // Token expired, clear cache and retry once
                Cache::forget(config('microsoft.cache.prefix') . '_access_token');
                $this->accessToken = null;
                
                return $this->makeRequest($method, $endpoint, $data);
            }
            
            throw new Exception("API request failed: " . $response->body());
            
        } catch (Exception $e) {
            Log::error("Microsoft API Error [{$method} {$endpoint}]: " . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Create a new customer tenant
     */
    public function createCustomer($customerData)
    {
        $payload = [
            'CompanyProfile' => [
                'Domain' => $customerData['domain'],
                'CompanyName' => $customerData['company_name'],
            ],
            'BillingProfile' => [
                'Email' => $customerData['billing_email'],
                'Culture' => $customerData['culture'] ?? 'en-US',
                'Language' => $customerData['language'] ?? 'en',
                'CompanyName' => $customerData['company_name'],
                'DefaultAddress' => [
                    'Country' => $customerData['country'],
                    'Region' => $customerData['region'] ?? '',
                    'City' => $customerData['city'],
                    'State' => $customerData['state'] ?? '',
                    'AddressLine1' => $customerData['address'],
                    'PostalCode' => $customerData['postal_code'],
                    'FirstName' => $customerData['first_name'],
                    'LastName' => $customerData['last_name'],
                    'PhoneNumber' => $customerData['phone'],
                ],
            ],
        ];
        
        return $this->makeRequest('post', 'customers', $payload);
    }
    
    /**
     * Get customer by ID
     */
    public function getCustomer($customerId)
    {
        return $this->makeRequest('get', "customers/{$customerId}");
    }
    
    /**
     * Get all customers
     */
    public function getCustomers($size = 100)
    {
        return $this->makeRequest('get', "customers?size={$size}");
    }
    
    /**
     * Create an order for a customer
     */
    public function createOrder($customerId, $orderData)
    {
        $payload = [
            'ReferenceCustomerId' => $customerId,
            'LineItems' => array_map(function($item) {
                return [
                    'LineItemNumber' => $item['line_number'],
                    'OfferId' => $item['offer_id'],
                    'Quantity' => $item['quantity'],
                    'FriendlyName' => $item['friendly_name'] ?? '',
                ];
            }, $orderData['line_items']),
        ];
        
        return $this->makeRequest('post', "customers/{$customerId}/orders", $payload);
    }
    
    /**
     * Get customer orders
     */
    public function getOrders($customerId)
    {
        return $this->makeRequest('get', "customers/{$customerId}/orders");
    }
    
    /**
     * Get customer subscriptions
     */
    public function getSubscriptions($customerId)
    {
        return $this->makeRequest('get', "customers/{$customerId}/subscriptions");
    }
    
    /**
     * Get subscription by ID
     */
    public function getSubscription($customerId, $subscriptionId)
    {
        return $this->makeRequest('get', "customers/{$customerId}/subscriptions/{$subscriptionId}");
    }
    
    /**
     * Update subscription quantity
     */
    public function updateSubscription($customerId, $subscriptionId, $quantity)
    {
        $payload = [
            'Quantity' => $quantity,
        ];
        
        return $this->makeRequest('patch', "customers/{$customerId}/subscriptions/{$subscriptionId}", $payload);
    }
    
    /**
     * Suspend a subscription
     */
    public function suspendSubscription($customerId, $subscriptionId)
    {
        $payload = [
            'Status' => 'suspended',
        ];
        
        return $this->makeRequest('patch', "customers/{$customerId}/subscriptions/{$subscriptionId}", $payload);
    }
    
    /**
     * Reactivate a subscription
     */
    public function reactivateSubscription($customerId, $subscriptionId)
    {
        $payload = [
            'Status' => 'active',
        ];
        
        return $this->makeRequest('patch', "customers/{$customerId}/subscriptions/{$subscriptionId}", $payload);
    }
    
    /**
     * Get available products/offers
     */
    public function getProducts($country = 'US')
    {
        return $this->makeRequest('get', "products?country={$country}");
    }
    
    /**
     * Get product by ID
     */
    public function getProduct($productId, $country = 'US')
    {
        return $this->makeRequest('get', "products/{$productId}?country={$country}");
    }
    
    /**
     * Get SKUs for a product
     */
    public function getProductSkus($productId, $country = 'US')
    {
        return $this->makeRequest('get', "products/{$productId}/skus?country={$country}");
    }
    
    /**
     * Get invoices
     */
    public function getInvoices()
    {
        return $this->makeRequest('get', 'invoices');
    }
    
    /**
     * Get invoice by ID
     */
    public function getInvoice($invoiceId)
    {
        return $this->makeRequest('get', "invoices/{$invoiceId}");
    }
    
    /**
     * Get usage data for a subscription
     */
    public function getUsageData($customerId, $subscriptionId)
    {
        return $this->makeRequest('get', "customers/{$customerId}/subscriptions/{$subscriptionId}/usagerecords");
    }
    
    /**
     * Verify domain availability
     */
    public function verifyDomain($domain)
    {
        try {
            $response = $this->makeRequest('head', "validations/checkdomainavailability/{$domain}");
            return true; // Domain is available
        } catch (Exception $e) {
            return false; // Domain is not available or error occurred
        }
    }
}
