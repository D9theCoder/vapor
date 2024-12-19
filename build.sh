#!/bin/bash

# Install composer dependencies
composer install

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Optimize the application
php artisan optimize

# Build assets if you're using something like Mix or Vite
npm install