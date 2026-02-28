# Quick Start Guide - Microsoft Marketplace

## 5-Minute Setup for Local Development

### Prerequisites Installed?
- ✅ PHP 8.1+
- ✅ Composer
- ✅ MySQL or PostgreSQL
- ✅ Node.js & NPM

### Step 1: Install (2 minutes)

```bash
# Clone the project
cd microsoft-marketplace

# Install dependencies
composer install
npm install
```

### Step 2: Configure (2 minutes)

```bash
# Create environment file
cp .env.example .env

# Edit .env - Choose your country
nano .env

# For Cameroon (MTN): Use the default settings (already configured)
# For South Africa: Uncomment the ZA section, comment CM section
# For Ghana: Uncomment the GH section, comment CM section

# Generate app key
php artisan key:generate
```

### Step 3: Database (1 minute)

```bash
# Create database
mysql -u root -p
CREATE DATABASE microsoft_marketplace;
EXIT;

# Run migrations
php artisan migrate

# (Optional) Seed with sample data
php artisan db:seed
```

### Step 4: Assets & Storage

```bash
# Link storage
php artisan storage:link

# Build frontend assets
npm run build
```

### Step 5: Start!

```bash
# Start Laravel
php artisan serve

# Visit http://localhost:8000
```

## That's It! 🎉

Your Microsoft Marketplace is now running!

## Next Steps

### Upload Your Logo
1. Place your logo in `public/images/`
2. Update `.env`:
   ```env
   BRAND_LOGO="/images/your-logo.png"
   ```

### Connect to Microsoft
1. Get your Partner Center credentials
2. Add to `.env`:
   ```env
   MICROSOFT_TENANT_ID=xxx
   MICROSOFT_CLIENT_ID=xxx
   MICROSOFT_CLIENT_SECRET=xxx
   ```

### Configure Payments
1. For MTN Mobile Money:
   ```env
   MTN_MOMO_API_USER=xxx
   MTN_MOMO_API_KEY=xxx
   ```

2. For Card Payments (Flutterwave):
   ```env
   FLUTTERWAVE_PUBLIC_KEY=xxx
   FLUTTERWAVE_SECRET_KEY=xxx
   ```

## Switch Countries Instantly

### Via Environment File:
```bash
# Switch to South Africa
nano .env
# Change these lines:
BRAND_COUNTRY="ZA"
BRAND_CURRENCY="ZAR"
BRAND_LANGUAGE="en"

# Restart server
php artisan serve
```

### Via Admin Panel:
1. Login to `/admin`
2. Go to Settings > Branding
3. Use "Quick Country Switch" dropdown
4. Select country and click "Switch"

## Default Admin Access

```
Email: admin@example.com
Password: password
```

**⚠️ Change this immediately in production!**

## Common Commands

```bash
# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run queue worker
php artisan queue:work

# Test Microsoft connection
php artisan tinker
>>> app(App\Services\MicrosoftPartnerCenterService::class)->getCustomers()
```

## Customization Quick Wins

### Change Colors
Edit `.env`:
```env
BRAND_PRIMARY_COLOR="#YOUR_COLOR"
BRAND_SECONDARY_COLOR="#YOUR_COLOR"
```

### Change Company Name
Edit `.env`:
```env
BRAND_COMPANY_NAME="Your Company Name"
```

### Add More Products
1. Login to admin panel
2. Go to Products > Add New
3. Enter Microsoft product details
4. Save!

## Deployment in 10 Minutes

### Using DigitalOcean
1. Create $12/month droplet (Ubuntu 22.04)
2. SSH into server
3. Run automated setup:
```bash
curl -o setup.sh https://raw.githubusercontent.com/your-repo/scripts/setup.sh
chmod +x setup.sh
./setup.sh
```

### Using Azure App Service
```bash
az login
az webapp up --name your-app-name
```

## Getting Help

- 📖 Full documentation: See `README.md`
- 🚀 Deployment guide: See `DEPLOYMENT.md`
- 💼 API docs: See `docs/api.md`
- 🐛 Issues: GitHub Issues
- 📧 Email: support@tmokk5.com

## Troubleshooting

### "Class not found" error?
```bash
composer dump-autoload
```

### Database connection failed?
Check `.env` database credentials:
```env
DB_DATABASE=microsoft_marketplace
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Assets not loading?
```bash
npm run build
php artisan storage:link
```

### Queue not working?
```bash
# Start queue worker
php artisan queue:work
```

---

**You're all set!** Start building your Microsoft marketplace! 🚀
