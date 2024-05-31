#!/bin/bash

# Copy environment file
cp .env.example .env

# Install composer dependencies
composer install

# Wait for 5 seconds
sleep 5

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed the database
php artisan db:seed

# Create symbolic link to storage
php artisan storage:link

# Serve the application
php artisan serve &

# Give it a few seconds to start
sleep 5

# Open the application in the default web browser
open_url() {
  local url=$1
  if command -v xdg-open > /dev/null; then
    xdg-open "$url"
  elif command -v open > /dev/null; then
    open "$url"
  elif command -v start > /dev/null; then
    start "$url"
  else
    echo "Please open a browser and go to $url"
  fi
}

# Open the application in the default web browser
open_url "http://127.0.0.1:8000/login"
