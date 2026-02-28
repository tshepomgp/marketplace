# Deployment Guide - Microsoft Marketplace

## Quick Deployment for Each Country

### 🇨🇲 Cameroon Deployment (MTN)

```bash
# 1. Clone and install
git clone <repo-url> mtn-cameroon
cd mtn-cameroon
composer install
npm install

# 2. Configure environment
cp .env.example .env

# Edit .env - Uncomment Cameroon section, comment others
nano .env

# Key settings:
BRAND_COMPANY_NAME="MTN Cameroon"
BRAND_COUNTRY="CM"
BRAND_CURRENCY="XAF"
BRAND_LANGUAGE="fr"
BRAND_PRIMARY_COLOR="#FFCB05"
BRAND_SECONDARY_COLOR="#000000"

# 3. Setup database and storage
php artisan key:generate
php artisan migrate
php artisan storage:link
npm run build

# 4. Upload MTN logo to public/images/
# - mtn-cameroon-logo.png (main logo)
# - mtn-cameroon-logo-dark.png (dark version)
# - favicon.ico

# 5. Configure Microsoft Partner Center
# Add your credentials to .env:
MICROSOFT_TENANT_ID=xxx
MICROSOFT_CLIENT_ID=xxx
MICROSOFT_CLIENT_SECRET=xxx

# 6. Configure MTN Mobile Money
MTN_MOMO_API_USER=xxx
MTN_MOMO_API_KEY=xxx
MTN_MOMO_SUBSCRIPTION_KEY=xxx

# 7. Start application
php artisan serve
```

### 🇿🇦 South Africa Deployment

```bash
# Same steps as above, but configure for South Africa:

# .env settings:
BRAND_COMPANY_NAME="Microsoft Solutions SA"
BRAND_COUNTRY="ZA"
BRAND_CURRENCY="ZAR"
BRAND_LANGUAGE="en"
BRAND_PRIMARY_COLOR="#0078D4"

# Upload logo:
# - logo-sa.png
# - logo-sa-dark.png

# Payment gateway: Paystack or Ozow
PAYSTACK_PUBLIC_KEY=xxx
PAYSTACK_SECRET_KEY=xxx
```

### 🇬🇭 Ghana Deployment

```bash
# Same steps, Ghana configuration:

# .env settings:
BRAND_COMPANY_NAME="Microsoft Solutions Ghana"
BRAND_COUNTRY="GH"
BRAND_CURRENCY="GHS"
BRAND_LANGUAGE="en"
BRAND_PRIMARY_COLOR="#0078D4"

# Upload logo:
# - logo-gh.png
# - logo-gh-dark.png

# Payment gateway: MTN Mobile Money + Paystack
MTN_MOMO_API_USER=xxx
PAYSTACK_PUBLIC_KEY=xxx
```

## Production Deployment (Azure)

### Option A: Azure App Service (Recommended)

```bash
# 1. Install Azure CLI
curl -sL https://aka.ms/InstallAzureCLIDeb | sudo bash

# 2. Login
az login

# 3. Create resource group
az group create --name microsoft-marketplace --location southafricano rth

# 4. Create App Service plan
az appservice plan create \
  --name marketplace-plan \
  --resource-group microsoft-marketplace \
  --sku B1 \
  --is-linux

# 5. Create web app
az webapp create \
  --name mtn-cameroon-marketplace \
  --resource-group microsoft-marketplace \
  --plan marketplace-plan \
  --runtime "PHP:8.1"

# 6. Configure deployment
az webapp deployment source config \
  --name mtn-cameroon-marketplace \
  --resource-group microsoft-marketplace \
  --repo-url <your-git-repo> \
  --branch main \
  --manual-integration

# 7. Set environment variables
az webapp config appsettings set \
  --name mtn-cameroon-marketplace \
  --resource-group microsoft-marketplace \
  --settings \
    APP_ENV=production \
    APP_DEBUG=false \
    BRAND_COUNTRY=CM \
    BRAND_CURRENCY=XAF

# 8. Create MySQL database
az mysql flexible-server create \
  --name marketplace-db \
  --resource-group microsoft-marketplace \
  --admin-user dbadmin \
  --admin-password 'YourSecurePassword123!' \
  --sku-name Standard_B1ms

# 9. Configure database connection
az webapp config connection-string set \
  --name mtn-cameroon-marketplace \
  --resource-group microsoft-marketplace \
  --connection-string-type MySQL \
  --settings \
    DefaultConnection="Server=marketplace-db.mysql.database.azure.com;Database=marketplace;User=dbadmin;Password=YourSecurePassword123!"
```

### Option B: DigitalOcean Droplet

```bash
# 1. Create Ubuntu 22.04 droplet ($12/month)

# 2. SSH into droplet
ssh root@your-droplet-ip

# 3. Install LAMP stack
apt update
apt install -y software-properties-common
add-apt-repository ppa:ondrej/php
apt update
apt install -y php8.1 php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl php8.1-zip php8.1-gd
apt install -y nginx mysql-server redis-server composer npm

# 4. Clone repository
cd /var/www
git clone <your-repo> microsoft-marketplace
cd microsoft-marketplace
composer install --no-dev
npm install && npm run build

# 5. Configure environment
cp .env.example .env
nano .env
# Set all production values

# 6. Setup database
mysql -u root -p
CREATE DATABASE microsoft_marketplace;
CREATE USER 'marketplace'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON microsoft_marketplace.* TO 'marketplace'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# 7. Run migrations
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache

# 8. Set permissions
chown -R www-data:www-data /var/www/microsoft-marketplace
chmod -R 755 /var/www/microsoft-marketplace/storage
chmod -R 755 /var/www/microsoft-marketplace/bootstrap/cache

# 9. Configure Nginx
nano /etc/nginx/sites-available/microsoft-marketplace

# Paste the following:
```

#### Nginx Configuration

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/microsoft-marketplace/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

```bash
# Enable site
ln -s /etc/nginx/sites-available/microsoft-marketplace /etc/nginx/sites-enabled/
nginx -t
systemctl restart nginx

# 10. Install SSL certificate
apt install certbot python3-certbot-nginx
certbot --nginx -d yourdomain.com

# 11. Setup supervisor for queue workers
apt install supervisor
nano /etc/supervisor/conf.d/laravel-worker.conf
```

#### Supervisor Configuration

```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/microsoft-marketplace/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasneeded=false
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/microsoft-marketplace/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
supervisorctl reread
supervisorctl update
supervisorctl start laravel-worker:*
```

## Environment-Specific Configurations

### Staging Environment

```env
APP_ENV=staging
APP_DEBUG=true
APP_URL=https://staging.yourdomain.com

# Use sandbox/test credentials
MICROSOFT_SANDBOX_MODE=true
MTN_MOMO_ENVIRONMENT=sandbox
FLUTTERWAVE_ENVIRONMENT=test
```

### Production Environment

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Use live credentials
MICROSOFT_SANDBOX_MODE=false
MTN_MOMO_ENVIRONMENT=production
FLUTTERWAVE_ENVIRONMENT=live

# Enable caching
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

## Post-Deployment Checklist

- [ ] Verify Microsoft API connection
- [ ] Test payment gateway integration
- [ ] Upload and test logo display
- [ ] Verify email sending
- [ ] Test product catalog loading
- [ ] Create test order
- [ ] Verify license provisioning
- [ ] Check all translations
- [ ] Test mobile responsiveness
- [ ] Setup backup cron jobs
- [ ] Configure monitoring (New Relic, Sentry)
- [ ] Enable HTTPS and force SSL
- [ ] Test all payment methods
- [ ] Verify webhook endpoints
- [ ] Load test with 100+ concurrent users

## Monitoring & Maintenance

### Daily Tasks
```bash
# Check logs
tail -f storage/logs/laravel.log

# Check queue status
php artisan queue:monitor
```

### Weekly Tasks
```bash
# Database backup
php artisan backup:run

# Clear old logs
php artisan log:clear

# Check failed jobs
php artisan queue:failed
```

### Monthly Tasks
- Update dependencies: `composer update`
- Review and optimize database
- Check for security updates
- Review and archive old orders

## Troubleshooting

### Issue: Microsoft API not connecting
```bash
# Test connection
php artisan tinker
>>> app(App\Services\MicrosoftPartnerCenterService::class)->getCustomers()

# Check credentials
php artisan config:clear
cat .env | grep MICROSOFT
```

### Issue: Payment webhook not receiving
```bash
# Check webhook logs
tail -f storage/logs/webhooks.log

# Verify webhook URL is accessible
curl https://yourdomain.com/webhooks/mtn-momo

# Test with ngrok for local testing
ngrok http 8000
```

### Issue: Queue not processing
```bash
# Check queue worker status
supervisorctl status laravel-worker:*

# Restart workers
supervisorctl restart laravel-worker:*

# Check failed jobs
php artisan queue:failed
```

## Scaling Considerations

### 100+ Users
- Enable Redis caching
- Add database read replicas

### 1,000+ Users
- Setup load balancer
- Multiple web servers
- Dedicated queue servers
- CDN for static assets

### 10,000+ Users
- Implement full CDN
- Database clustering
- Multi-region deployment
- Microservices architecture

## Security Hardening

```bash
# Disable directory listing
# Add to Nginx config
autoindex off;

# Hide PHP version
# Add to php.ini
expose_php = Off

# Enable firewall
ufw allow 22
ufw allow 80
ufw allow 443
ufw enable

# Setup fail2ban
apt install fail2ban
systemctl enable fail2ban
```

---

**Need help?** Contact support@tmokk5.com
