# Laravel App Installation Guide

## Prerequisites

Ensure the following software is installed on your Linux system:

1. **PHP**: Version 8.1 or higher
2. **Composer**: Dependency management tool for PHP
3. **Web Server**: Apache or Nginx
4. **Database**: MySQL or PostgreSQL
5. **Node.js & npm**: Required for frontend asset compilation (optional but recommended)
6. **Git**: To clone the repository

---

## Installation Steps

### 1. Clone the Repository

Run the following command to clone the repository to your local system:
    git clone https://github.com/AryaMerlet/secure_paiement.git
    cd secure_paiement

Ensure the storage and bootstrap/cache directories are writable by your server:
    chmod -R 775 storage bootstrap/cache

Use Composer to install dependencies   
    composer install

Create a .env file by copying the example .env.example file:
    cp .env.example .env

Edit the .env file to configure your database environment:
    nano .env

Run the following command to generate the application key:
    php artisan key:generate

Run migrations to set up the database schema:
    php artisan migrate

(Optional) Seed the database with sample data:
    php artisan db:seed

Install and run NPM :
    npm install
    npm run build

Start the Laravel development server:
    php artisan serve



