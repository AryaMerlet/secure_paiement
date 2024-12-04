#!/bin/bash

# Script to install Laravel packages
# Usage: ./install_laravel_packages.sh

# Exit on error
set -e

echo "Starting Laravel package installation..."

echo "Configuring Composer to allow plugins..."
composer config --no-interaction allow-plugins.dealerdirect/phpcodesniffer-composer-installer true

# Update composer dependencies
echo "Updating composer..."
composer update

# Install Larastan
echo "Installing Larastan..."
composer require --dev "larastan/larastan:^3.0"

# Install Bouncer
echo "Installing Bouncer..."
composer require silber/bouncer

# Install IDE Helper
echo "Installing IDE Helper..."
composer require --dev barryvdh/laravel-ide-helper

# Install PHP Insights
echo "Installing PHP Insights..."
composer require nunomaduro/phpinsights --dev -W

# Install Laravel Debugbar
echo "Installing Laravel Debugbar..."
composer require barryvdh/laravel-debugbar --dev

# Install Laravel Lang
echo "Installing Laravel Lang..."
composer require --dev laravel-lang/lang

echo "Laravel package installation completed successfully!"

# Optional post-installation tasks

echo "Running post-installation tasks..."

echo "Creating phpstan.neon file for Larastan..."
cat <<EOL >phpstan.neon
includes:
    - vendor/larastan/larastan/extension.neon
    - vendor/nesbot/carbon/extension.neon

parameters:

    paths:
        - app/

    # Level 10 is the highest level
    level: 7

#    ignoreErrors:
#        - '#PHPDoc tag @var#'
#
#    excludePaths:
#        - ./*/*/FileToBeExcluded.php
EOL

echo "phpstan.neon file created successfully."

# IDE Helper generation
php artisan ide-helper:generate
php artisan ide-helper:models --nowrite
php artisan ide-helper:meta

# Bouncer setup
echo "Setting up Bouncer..."
php artisan vendor:publish --tag="bouncer.migrations"
php artisan migrate

# PHP Insights configuration (optional)
echo "Initializing PHP Insights configuration..."
php artisan vendor:publish --provider="NunoMaduro\PhpInsights\Application\Adapters\Laravel\InsightsServiceProvider"

# Laravel Lang setup (optional)
echo "Publishing Laravel Lang files..."
php artisan lang:add en fr

echo "All done! You may now use the installed packages."
