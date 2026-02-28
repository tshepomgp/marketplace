# Quick Fix Script for Windows
# Run this in PowerShell: .\fix-installation.ps1

Write-Host "🔧 Fixing Microsoft Marketplace Installation..." -ForegroundColor Cyan
Write-Host ""

# Check if we're in the right directory
if (-Not (Test-Path "composer.json")) {
    Write-Host "❌ Error: Not in project directory!" -ForegroundColor Red
    Write-Host "Please run this script from the microsoft-marketplace folder" -ForegroundColor Yellow
    exit 1
}

# Remove the old Models.php file if it exists
if (Test-Path "app\Models\Models.php") {
    Write-Host "🗑️  Removing old Models.php file..." -ForegroundColor Yellow
    Remove-Item "app\Models\Models.php"
}

# Create necessary directories
Write-Host "📁 Creating storage directories..." -ForegroundColor Yellow
$directories = @(
    "storage\app\public",
    "storage\framework\cache\data",
    "storage\framework\sessions",
    "storage\framework\testing",
    "storage\framework\views",
    "storage\logs",
    "bootstrap\cache"
)

foreach ($dir in $directories) {
    if (-Not (Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
    }
}

# Run composer dump-autoload to fix the PSR-4 errors
Write-Host "🔄 Regenerating autoload files..." -ForegroundColor Yellow
composer dump-autoload

# Run artisan commands
Write-Host "🎨 Running Laravel setup commands..." -ForegroundColor Yellow

# Key generate
if (-Not (Select-String -Path ".env" -Pattern "APP_KEY=base64:" -Quiet)) {
    php artisan key:generate
}

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

Write-Host ""
Write-Host "✅ Installation fixed!" -ForegroundColor Green
Write-Host ""
Write-Host "📝 Next steps:" -ForegroundColor Cyan
Write-Host "1. Configure your .env file (database, Microsoft API, etc.)"
Write-Host "2. Run: php artisan migrate"
Write-Host "3. Run: php artisan serve"
Write-Host ""
Write-Host "🚀 Your application will be available at: http://localhost:8000" -ForegroundColor Green
