# Installation Fix Guide

## What Happened?

When you ran `composer install`, you saw these errors:

```
Class App\Models\Product located in ... does not comply with psr-4 autoloading standard. Skipping.
Class App\Models\Order located in ... does not comply with psr-4 autoloading standard. Skipping.
...
Could not open input file: artisan
```

**Why?** Laravel expects one model per file (PSR-4 standard), and some core files were missing.

## ✅ I've Fixed It!

I've updated the ZIP file with:
- ✅ Separate model files (Product.php, Order.php, etc.)
- ✅ Core Laravel files (artisan, bootstrap/app.php, public/index.php)
- ✅ All necessary directories
- ✅ Fix script to clean up your installation

---

## 🚀 How to Fix Your Current Installation

You have TWO options:

### Option 1: Re-download (Easiest)

1. Delete your current `microsoft-marketplace` folder
2. Download the NEW ZIP file from above
3. Extract it
4. Run installation commands again

### Option 2: Run the Fix Script (If you want to keep your changes)

In your PowerShell terminal:

```powershell
cd C:\Users\TMOKK5\Projects\microsoft-marketplace

# Run the fix script
.\fix-installation.ps1
```

The script will:
- Remove the old Models.php file
- Create all necessary directories
- Regenerate autoload files
- Run Laravel setup commands

---

## ⚙️ Manual Fix (If script doesn't work)

If you prefer to fix manually:

```powershell
cd C:\Users\TMOKK5\Projects\microsoft-marketplace

# 1. Remove old Models.php (if it exists)
Remove-Item app\Models\Models.php -ErrorAction SilentlyContinue

# 2. Regenerate autoload
composer dump-autoload

# 3. Make sure .env exists
if (-Not (Test-Path .env)) { Copy-Item .env.example .env }

# 4. Generate app key
php artisan key:generate

# 5. Clear caches
php artisan config:clear
php artisan cache:clear
```

---

## 📋 Verify Everything is Fixed

Run these commands to verify:

```powershell
# Check if artisan works
php artisan --version

# You should see: Laravel Framework 10.x.x
```

If you see the Laravel version, everything is fixed! ✅

---

## 🎯 Continue Installation

Now continue with the normal setup:

```powershell
# 1. Configure .env
# Edit .env with your database credentials and Microsoft API keys

# 2. Run migrations
php artisan migrate

# 3. Install frontend dependencies (if not done)
npm install
npm run build

# 4. Start server
php artisan serve
```

Visit: http://localhost:8000

---

## 🆘 Still Having Issues?

### Error: "php not recognized"
**Fix**: Add PHP to your PATH or use full path:
```powershell
C:\php\php.exe artisan serve
```

### Error: "composer not recognized"
**Fix**: Install Composer from https://getcomposer.org/download/

### Error: "npm not recognized"
**Fix**: Install Node.js from https://nodejs.org/

### Database connection errors
**Fix**: Check your .env database settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=microsoft_marketplace
DB_USERNAME=root
DB_PASSWORD=your_password
```

Make sure MySQL is running!

---

## ✨ Success Checklist

After fixing, you should have:

- ✅ `php artisan --version` works
- ✅ No PSR-4 autoload errors
- ✅ `.env` file exists with APP_KEY
- ✅ All model files in app/Models/ (Product.php, Order.php, etc.)
- ✅ storage/ and bootstrap/cache/ directories exist
- ✅ `php artisan serve` starts the server

---

## 📦 What's in the Fixed Package?

**New Files Added:**
- `artisan` - Laravel command-line interface
- `bootstrap/app.php` - Application bootstrap
- `public/index.php` - Application entry point
- `routes/console.php` - Console routes
- `app/Providers/AppServiceProvider.php` - Service provider
- `app/Models/Product.php` - Product model (separate file)
- `app/Models/Order.php` - Order model (separate file)
- `app/Models/OrderItem.php` - OrderItem model (separate file)
- `app/Models/Subscription.php` - Subscription model (separate file)
- `app/Models/Setting.php` - Setting model (separate file)
- `fix-installation.ps1` - Automated fix script

**Directories Created:**
- `storage/app/public`
- `storage/framework/{cache,sessions,views}`
- `storage/logs`
- `bootstrap/cache`

---

## 🎉 You're All Set!

Once fixed, you'll have a fully functional Laravel application ready to:
- Connect to Microsoft Partner Center API
- Sell Microsoft licenses
- Support multiple countries (Cameroon, South Africa, Ghana)
- Process payments via MTN Mobile Money, Orange Money, etc.

Happy coding! 🚀
