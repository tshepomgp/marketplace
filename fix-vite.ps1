# Fix Vite Build - PowerShell Script
# Run this in your project root: .\fix-vite.ps1

Write-Host "🔧 Fixing Vite configuration..." -ForegroundColor Cyan
Write-Host ""

# Check if we're in the right directory
if (-Not (Test-Path "composer.json")) {
    Write-Host "❌ Error: Not in project directory!" -ForegroundColor Red
    Write-Host "Please run this script from the microsoft-marketplace folder" -ForegroundColor Yellow
    exit 1
}

# Create vite.config.js
Write-Host "📝 Creating vite.config.js..." -ForegroundColor Yellow
@"
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
"@ | Out-File -FilePath "vite.config.js" -Encoding UTF8

# Create tailwind.config.js
Write-Host "📝 Creating tailwind.config.js..." -ForegroundColor Yellow
@"
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
"@ | Out-File -FilePath "tailwind.config.js" -Encoding UTF8

# Create postcss.config.js
Write-Host "📝 Creating postcss.config.js..." -ForegroundColor Yellow
@"
export default {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
}
"@ | Out-File -FilePath "postcss.config.js" -Encoding UTF8

# Create resources/js directory if it doesn't exist
if (-Not (Test-Path "resources\js")) {
    New-Item -ItemType Directory -Path "resources\js" -Force | Out-Null
}

# Create resources/css directory if it doesn't exist
if (-Not (Test-Path "resources\css")) {
    New-Item -ItemType Directory -Path "resources\css" -Force | Out-Null
}

# Create resources/js/app.js
Write-Host "📝 Creating resources/js/app.js..." -ForegroundColor Yellow
@"
import './bootstrap';
"@ | Out-File -FilePath "resources\js\app.js" -Encoding UTF8

# Create resources/js/bootstrap.js
Write-Host "📝 Creating resources/js/bootstrap.js..." -ForegroundColor Yellow
@"
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
"@ | Out-File -FilePath "resources\js\bootstrap.js" -Encoding UTF8

# Create resources/css/app.css
Write-Host "📝 Creating resources/css/app.css..." -ForegroundColor Yellow
@"
@tailwind base;
@tailwind components;
@tailwind utilities;
"@ | Out-File -FilePath "resources\css\app.css" -Encoding UTF8

Write-Host ""
Write-Host "✅ All files created!" -ForegroundColor Green
Write-Host ""
Write-Host "📦 Now run:" -ForegroundColor Cyan
Write-Host "   npm run build" -ForegroundColor White
Write-Host ""
