# Content Management System - News Portal

## Description
This project is a news portal that allows users to view news articles, View Polls and vote. The admin can add news articles, add polls, view polls and view news articles.

## Requirements
- PHP 8.1 or higher
- Composer
- MySQL
- XAMPP (for MySQL and Apache server)

## Installation
1. **Install Composer**: Download and install Composer from [https://getcomposer.org/Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)
2. **Install XAMPP**: Download and install XAMPP to set up MySQL and Apache server.
3.  **Clone the Repository**: 
    ```bash
    git clone git@github.com:Riaz-Mahmud/Content-management-system---News-Portal.git
    ```
4. Run `composer install` to install dependencies
    ```bash
    composer install
    ```
5. Create a database in MySQL with the name `news_portal` or any other name you prefer but make sure to update the database name in the `.env` file
    ```bash
    DB_DATABASE=news_portal
    ```
6. Run `php artisan migrate --seed` to create the tables and seed the database
    ```bash
    php artisan migrate --seed
    ```
7. Run `php artisan storage:link` to create a symbolic link to the storage folder
    ```bash
    php artisan storage:link
    ```
8. Run `php artisan serve` to start the server
    ```bash
    php artisan serve
    ```
9. Visit `http://localhost:8000` in your browser

## Portal URLs & Credentials
- **User Portal**: `http://localhost:8000`
- **Admin Panel**: `http://localhost:8000/admin/dashboard`
- **Admin Credentials**:
    - Email: almahmudr1@gmail.com
    - Password: pass

## Features

### User
- View news articles
- View Polls
- Vote on Polls
- View Poll Results
- View ADs

### Admin
- Dashboard with statistics and analytics
- Slider management
- Category management
- Tags management
- News management
- Poll management
- Menu management
- Pages management
- AD management
- User management
- Settings management
- Roles & Permissions management

## Technologies
- Laravel 10
- MySQL 8.0
- PHP 8.1
- HTML
- CSS
- JavaScript
- Bootstrap 5
- jQuery

## Usage

### User
Browse the news portal to view news articles, polls, and ADs. Vote on polls and view the results.

### Admin
Access the admin panel by visiting `http://127.0.0.1:8000/admin/dashboard` and logging in with the credentials
- Email: almahmudr1@gmail.com
- Password: pass

## License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Contributors
- [https://github.com/Riaz-Mahmud/](Abdul Al Mahmud Riaz)
