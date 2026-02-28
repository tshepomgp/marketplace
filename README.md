# Microsoft Marketplace - White-Label Laravel Application

A complete, production-ready Laravel application for selling Microsoft products and licenses through the Cloud Solution Provider (CSP) program. Built with multi-country support, white-labeling capabilities, and Microsoft Partner Center API integration.

## 🌍 Multi-Country Support

Pre-configured for:
- **🇨🇲 Cameroon** - MTN branding, XAF currency, French language, MTN Mobile Money
- **🇿🇦 South Africa** - ZAR currency, English language, EFT/Card payments
- **🇬🇭 Ghana** - GHS currency, English language, MTN Mobile Money

Easily add more countries by updating the configuration!

## ✨ Key Features

### White-Label Branding
- Dynamic logo, colors, and company information
- Database-driven settings (no code changes needed)
- Quick country switcher in admin panel
- Customizable per deployment

### Microsoft Integration
- Full Partner Center API integration
- Automated customer tenant creation
- License provisioning and management
- Subscription lifecycle management
- Invoice synchronization

### Multi-Language
- English and French translations included
- Easy to add more languages
- Automatic language switching based on country

### Payment Integration
- MTN Mobile Money (Cameroon, Ghana)
- Orange Money (Cameroon)
- Flutterwave (Cards, multiple countries)
- Paystack (Cards, multiple countries)
- Easy to add more payment gateways

### Complete E-commerce
- Product catalog with categories
- Shopping cart functionality
- Secure checkout process
- Order management
- Subscription tracking
- Invoice generation

### Admin Dashboard
- Customer management
- Product management
- Order tracking
- Branding customization
- Microsoft API settings
- Analytics and reporting

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or PostgreSQL 12+
- Redis (recommended for caching and queues)
- Node.js & NPM (for frontend assets)

## 🚀 Installation

### 1. Clone and Setup

```bash
# Clone the repository
git clone <your-repo-url>
cd microsoft-marketplace

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 2. Configure Environment

Edit `.env` file with your settings:

```env
# Choose your country configuration (see .env.example for all options)
BRAND_COMPANY_NAME="MTN Cameroon"
BRAND_COUNTRY="CM"
BRAND_CURRENCY="XAF"
BRAND_LANGUAGE="fr"
BRAND_PRIMARY_COLOR="#FFCB05"
BRAND_SECONDARY_COLOR="#000000"

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=microsoft_marketplace
DB_USERNAME=root
DB_PASSWORD=your_password

# Microsoft Partner Center
MICROSOFT_TENANT_ID=your_tenant_id
MICROSOFT_CLIENT_ID=your_client_id
MICROSOFT_CLIENT_SECRET=your_client_secret
```

### 3. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed
```

### 4. Storage & Assets

```bash
# Create storage link
php artisan storage:link

# Build frontend assets
npm run build
```

### 5. Start Development Server

```bash
# Start Laravel development server
php artisan serve

# In another terminal, start queue worker
php artisan queue:work

# In another terminal, start Redis (if using)
redis-server
```

Visit `http://localhost:8000` in your browser!

## 🎨 Customizing for Your Country

### Method 1: Admin Panel (Easiest)

1. Login to admin panel: `/admin`
2. Go to Settings > Branding
3. Use "Quick Country Switch" dropdown
4. Select your country (Cameroon, South Africa, or Ghana)
5. Click "Switch Country"
6. Upload your logo
7. Adjust colors and details as needed

### Method 2: Environment Variables

Edit your `.env` file:

```env
# For South Africa
BRAND_COMPANY_NAME="Microsoft Solutions SA"
BRAND_COUNTRY="ZA"
BRAND_CURRENCY="ZAR"
BRAND_CURRENCY_SYMBOL="R"
BRAND_LANGUAGE="en"
BRAND_TIMEZONE="Africa/Johannesburg"
BRAND_PRIMARY_COLOR="#0078D4"
```

### Method 3: Config File

Edit `config/branding.php` to add new country configurations:

```php
'countries' => [
    'NG' => [
        'name' => 'Nigeria',
        'currency' => 'NGN',
        'currency_symbol' => '₦',
        'language' => 'en',
        'timezone' => 'Africa/Lagos',
        'payment_methods' => ['paystack', 'flutterwave'],
    ],
],
```

## 🔧 Microsoft Partner Center Setup

### Prerequisites

1. **Become a Microsoft Partner**
   - Register at https://partner.microsoft.com
   - Complete partner onboarding
   - Sign Microsoft Partner Agreement (MPA)

2. **Choose CSP Model**
   - **Indirect CSP** (Recommended for start): Partner with existing CSP provider
   - **Direct CSP**: Requires $300K annual revenue

### API Registration

1. Go to Azure Portal: https://portal.azure.com
2. Navigate to Azure Active Directory > App Registrations
3. Click "New Registration"
4. Configure:
   - Name: "Microsoft Marketplace API"
   - Supported account types: "Accounts in this organizational directory only"
   - Redirect URI: Leave blank
5. After creation, note:
   - **Application (client) ID** → `MICROSOFT_CLIENT_ID`
   - **Directory (tenant) ID** → `MICROSOFT_TENANT_ID`
6. Go to "Certificates & secrets"
7. Create new client secret → `MICROSOFT_CLIENT_SECRET`
8. Go to "API permissions"
9. Add Partner Center permissions:
   - Microsoft Partner Center API
   - user_impersonation

### Testing the Integration

```bash
# Test Microsoft API connection
php artisan microsoft:test-connection

# Sync products from Microsoft
php artisan microsoft:sync-products

# Test customer creation
php artisan microsoft:create-test-customer
```

## 💳 Payment Gateway Setup

### MTN Mobile Money (Cameroon)

1. Register at https://momodeveloper.mtn.com
2. Create API user and key
3. Subscribe to Collections API
4. Add to `.env`:
```env
MTN_MOMO_API_USER=your_user
MTN_MOMO_API_KEY=your_key
MTN_MOMO_SUBSCRIPTION_KEY=your_subscription_key
MTN_MOMO_ENVIRONMENT=sandbox
```

### Flutterwave (Multiple Countries)

1. Register at https://flutterwave.com
2. Get API keys from Settings
3. Add to `.env`:
```env
FLUTTERWAVE_PUBLIC_KEY=your_public_key
FLUTTERWAVE_SECRET_KEY=your_secret_key
FLUTTERWAVE_ENCRYPTION_KEY=your_encryption_key
```

## 🌐 Deployment

### Production Checklist

```bash
# Update environment
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev

# Build assets
npm run build

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Deployment Options

#### Option 1: Azure App Service (Recommended)

Best integration with Microsoft ecosystem:

```bash
# Install Azure CLI
curl -sL https://aka.ms/InstallAzureCLIDeb | sudo bash

# Login and deploy
az login
az webapp up --name microsoft-marketplace --resource-group your-rg
```

#### Option 2: DigitalOcean App Platform

```yaml
# .do/app.yaml
name: microsoft-marketplace
services:
  - name: web
    github:
      repo: your-username/microsoft-marketplace
      branch: main
    build_command: |
      composer install --no-dev
      npm install && npm run build
    run_command: php artisan serve --host=0.0.0.0 --port=8080
```

#### Option 3: Traditional VPS (Ubuntu)

```bash
# Install requirements
sudo apt update
sudo apt install php8.1 php8.1-fpm nginx mysql-server redis-server

# Clone and setup
git clone <your-repo> /var/www/microsoft-marketplace
cd /var/www/microsoft-marketplace
composer install --no-dev
php artisan migrate --force

# Configure Nginx (see docs/nginx.conf)
sudo systemctl restart nginx
```

### SSL Certificate

```bash
# Using Let's Encrypt (Free)
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com
```

## 📊 Features Roadmap

### Current Features
- ✅ Multi-country support (3 countries)
- ✅ White-label branding
- ✅ Microsoft Partner Center integration
- ✅ Product catalog
- ✅ Shopping cart
- ✅ Multiple payment gateways
- ✅ Multi-language (English, French)
- ✅ Admin dashboard
- ✅ Order management
- ✅ Subscription tracking

### Coming Soon
- 🔄 Automated license renewals
- 🔄 Customer portal improvements
- 🔄 Advanced reporting
- 🔄 WhatsApp notifications
- 🔄 SMS alerts
- 🔄 Multi-currency support
- 🔄 API for mobile apps

## 🔐 Security

- All API credentials stored in environment variables
- CSRF protection on all forms
- SQL injection prevention via Eloquent ORM
- XSS protection enabled
- Rate limiting on API endpoints
- Secure password hashing
- Payment data never stored locally
- Regular security updates

## 📱 API Documentation

API endpoints for mobile apps or integrations:

```
GET /api/products - List products
GET /api/products/{id} - Get product details
POST /api/cart/add - Add to cart
POST /api/orders - Create order
GET /api/orders/{id} - Get order status
```

Full API documentation: See `docs/api.md`

## 🤝 Support

- **Documentation**: See `/docs` folder
- **Email**: support@tmokk5.com
- **Issues**: GitHub Issues

## 📄 License

This project is proprietary software developed by TMOKK5 (PTY) LTD.

## 👨‍💻 Developer

**Tshepo Matlala**  
Lead Software Engineer  
TMOKK5 (PTY) LTD  
South Africa

---

## Quick Start Commands

```bash
# Fresh installation
composer install && npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
npm run build
php artisan serve

# Update after git pull
composer install
npm install
php artisan migrate
npm run build
php artisan config:cache

# Test Microsoft integration
php artisan microsoft:test-connection

# Switch to South Africa
php artisan tinker
>>> Setting::set('branding.country', 'ZA')
>>> Setting::set('branding.currency', 'ZAR')
>>> Setting::set('branding.language', 'en')
```

## Environment Examples

### Cameroon (MTN)
```env
BRAND_COMPANY_NAME="MTN Cameroon"
BRAND_COUNTRY="CM"
BRAND_CURRENCY="XAF"
BRAND_LANGUAGE="fr"
BRAND_PRIMARY_COLOR="#FFCB05"
FEATURE_MTN_MOMO=true
```

### South Africa
```env
BRAND_COMPANY_NAME="Microsoft Solutions SA"
BRAND_COUNTRY="ZA"
BRAND_CURRENCY="ZAR"
BRAND_LANGUAGE="en"
BRAND_PRIMARY_COLOR="#0078D4"
FEATURE_CARD_PAYMENTS=true
```

### Ghana
```env
BRAND_COMPANY_NAME="Microsoft Solutions Ghana"
BRAND_COUNTRY="GH"
BRAND_CURRENCY="GHS"
BRAND_LANGUAGE="en"
BRAND_PRIMARY_COLOR="#0078D4"
FEATURE_MTN_MOMO=true
```

---

**Built with ❤️ for Microsoft CSP Partners**
# marketplace
