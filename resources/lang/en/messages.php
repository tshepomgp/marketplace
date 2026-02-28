<?php

return [
    // Navigation
    'nav' => [
        'home' => 'Home',
        'products' => 'Products',
        'about' => 'About Us',
        'contact' => 'Contact',
        'login' => 'Login',
        'register' => 'Register',
        'dashboard' => 'Dashboard',
        'orders' => 'My Orders',
        'subscriptions' => 'My Subscriptions',
        'logout' => 'Logout',
    ],

    // Common
    'common' => [
        'welcome' => 'Welcome',
        'search' => 'Search',
        'filter' => 'Filter',
        'sort' => 'Sort',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'delete' => 'Delete',
        'edit' => 'Edit',
        'view' => 'View',
        'back' => 'Back',
        'next' => 'Next',
        'previous' => 'Previous',
        'submit' => 'Submit',
        'loading' => 'Loading...',
        'no_results' => 'No results found',
        'error' => 'Error',
        'success' => 'Success',
    ],

    // Products
    'products' => [
        'title' => 'Microsoft Products',
        'subtitle' => 'Choose the perfect solution for your business',
        'all_products' => 'All Products',
        'featured' => 'Featured Products',
        'category' => 'Category',
        'price' => 'Price',
        'per_month' => 'per month',
        'per_year' => 'per year',
        'add_to_cart' => 'Add to Cart',
        'buy_now' => 'Buy Now',
        'learn_more' => 'Learn More',
        'quantity' => 'Quantity',
        'users' => 'Users',
        'min_quantity' => 'Minimum: :min users',
        'description' => 'Description',
        'features' => 'Features',
    ],

    // Cart & Checkout
    'cart' => [
        'title' => 'Shopping Cart',
        'empty' => 'Your cart is empty',
        'item' => 'Item',
        'price' => 'Price',
        'quantity' => 'Quantity',
        'total' => 'Total',
        'subtotal' => 'Subtotal',
        'tax' => 'Tax',
        'grand_total' => 'Grand Total',
        'continue_shopping' => 'Continue Shopping',
        'proceed_to_checkout' => 'Proceed to Checkout',
        'remove' => 'Remove',
    ],

    'checkout' => [
        'title' => 'Checkout',
        'billing_information' => 'Billing Information',
        'company_information' => 'Company Information',
        'payment_method' => 'Payment Method',
        'review_order' => 'Review Order',
        'place_order' => 'Place Order',
        'processing' => 'Processing your order...',
        'success' => 'Order placed successfully!',
        'error' => 'Failed to process order. Please try again.',
    ],

    // Dashboard
    'dashboard' => [
        'welcome' => 'Welcome back, :name',
        'overview' => 'Overview',
        'active_subscriptions' => 'Active Subscriptions',
        'total_spent' => 'Total Spent',
        'pending_orders' => 'Pending Orders',
        'recent_activity' => 'Recent Activity',
    ],

    // Orders
    'orders' => [
        'title' => 'My Orders',
        'order_number' => 'Order #:number',
        'date' => 'Date',
        'status' => 'Status',
        'total' => 'Total',
        'view_details' => 'View Details',
        'download_invoice' => 'Download Invoice',
        'statuses' => [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'failed' => 'Failed',
            'cancelled' => 'Cancelled',
        ],
    ],

    // Subscriptions
    'subscriptions' => [
        'title' => 'My Subscriptions',
        'active' => 'Active',
        'expired' => 'Expired',
        'renews_on' => 'Renews on',
        'expires_on' => 'Expires on',
        'auto_renew' => 'Auto-renew',
        'manage' => 'Manage',
        'upgrade' => 'Upgrade',
        'cancel' => 'Cancel',
        'renew' => 'Renew',
        'statuses' => [
            'active' => 'Active',
            'suspended' => 'Suspended',
            'cancelled' => 'Cancelled',
            'expired' => 'Expired',
        ],
    ],

    // Forms
    'forms' => [
        'email' => 'Email Address',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'company_name' => 'Company Name',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'phone' => 'Phone Number',
        'address' => 'Address',
        'city' => 'City',
        'state' => 'State/Province',
        'postal_code' => 'Postal Code',
        'country' => 'Country',
        'domain' => 'Company Domain',
    ],

    // Admin
    'admin' => [
        'dashboard' => 'Admin Dashboard',
        'customers' => 'Customers',
        'products' => 'Products',
        'orders' => 'Orders',
        'subscriptions' => 'Subscriptions',
        'settings' => 'Settings',
        'branding' => 'Branding',
        'reports' => 'Reports',
    ],

    // Messages
    'messages' => [
        'order_success' => 'Your order has been placed successfully!',
        'order_error' => 'There was an error processing your order.',
        'payment_success' => 'Payment received successfully!',
        'payment_pending' => 'Waiting for payment confirmation...',
        'subscription_activated' => 'Subscription activated successfully!',
        'settings_saved' => 'Settings saved successfully!',
    ],
];
