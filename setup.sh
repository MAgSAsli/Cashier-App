#!/bin/bash

# Install dependencies
composer install --no-interaction --prefer-dist

# Copy .env jika belum ada
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Generate app key
php artisan key:generate --force

# Clear cache
php artisan config:clear
php artisan cache:clear

# Migrate & seed
php artisan migrate --force --seed

echo "Setup selesai! Jalankan: php artisan serve --host=0.0.0.0 --port=8080"
