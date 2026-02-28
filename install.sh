#!/bin/bash

# Microsoft Marketplace - Quick Installation Script
# For Ubuntu/Debian servers

echo "🚀 Microsoft Marketplace - Quick Install"
echo "========================================"
echo ""

# Check if running as root
if [ "$EUID" -ne 0 ]; then 
  echo "❌ Please run as root (sudo ./install.sh)"
  exit
fi

echo "📦 Installing dependencies..."

# Update system
apt update

# Install PHP 8.1 and extensions
add-apt-repository ppa:ondrej/php -y
apt update
apt install -y php8.1 php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring \
  php8.1-curl php8.1-zip php8.1-gd php8.1-redis php8.1-intl

# Install Composer
if ! command -v composer &> /dev/null; then
    echo "📦 Installing Composer..."
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi

# Install Node.js
if ! command -v node &> /dev/null; then
    echo "📦 Installing Node.js..."
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
    apt install -y nodejs
fi

# Install Nginx
apt install -y nginx

# Install MySQL
apt install -y mysql-server

# Install Redis
apt install -y redis-server

echo "✅ Dependencies installed!"
echo ""

# Install Laravel dependencies
echo "📦 Installing Laravel dependencies..."
cd /var/www/microsoft-marketplace
composer install --no-dev --optimize-autoloader
npm install
npm run build

echo "✅ Dependencies installed!"
echo ""

# Setup environment
if [ ! -f .env ]; then
    echo "⚙️  Setting up environment..."
    cp .env.example .env
    php artisan key:generate
fi

# Database setup
echo "🗄️  Setting up database..."
read -p "Enter MySQL root password: " MYSQL_ROOT_PASSWORD
read -p "Enter database name [microsoft_marketplace]: " DB_NAME
DB_NAME=${DB_NAME:-microsoft_marketplace}
read -p "Enter database user [marketplace]: " DB_USER
DB_USER=${DB_USER:-marketplace}
read -p "Enter database password: " DB_PASSWORD

mysql -u root -p$MYSQL_ROOT_PASSWORD <<MYSQL_SCRIPT
CREATE DATABASE IF NOT EXISTS $DB_NAME;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
MYSQL_SCRIPT

# Update .env with database credentials
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env

# Run migrations
php artisan migrate --force

# Setup permissions
echo "🔐 Setting permissions..."
chown -R www-data:www-data /var/www/microsoft-marketplace
chmod -R 755 /var/www/microsoft-marketplace/storage
chmod -R 755 /var/www/microsoft-marketplace/bootstrap/cache

# Storage link
php artisan storage:link

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "✅ Installation complete!"
echo ""
echo "📝 Next steps:"
echo "1. Configure Nginx (see DEPLOYMENT.md)"
echo "2. Install SSL certificate with certbot"
echo "3. Configure .env with your settings:"
echo "   - Microsoft API credentials"
echo "   - Payment gateway keys"
echo "   - Upload your logo"
echo "4. Setup supervisor for queue workers"
echo ""
echo "🎉 Your Microsoft Marketplace is ready!"
