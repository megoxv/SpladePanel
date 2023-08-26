
# SpladePanel

Welcome to SpladePanel, where you can dive into a world of elegance and simplicity. Unleash the power of SpladePanel to effortlessly create stunning dashboards that combine speed and visual allure using the intuitive SPA-building features of Laravel Splade.

## Features

-   Utilizes Laravel 10 framework
-   Integrates with Jetstream
-   Smart Error Tracker to keep you informed
-   Comprehensive Tracking System to monitor every aspect
-   Site Configuration System for easy setup
-   Multilingual system
-   Advanced Permission System for fine-grained control
-   Ready-to-use Plugins System for easy expansion
-   Dark Mode
-   RTL Support

## Setup Instructions

To get started with SpladePanel, follow these steps:

1.  Install the required dependencies using Composer:

    ```php
    composer install
    ```
2. Copy the `.env.example` file to `.env`:

    ```php
    cp .env.example .env
    ```

3. Generate a security key and link the storage file:

    ```php
    php artisan key:generate
    php artisan storage:link
    ```
5.  Configure your database connection by updating the `.env` file.
6.  Run database migrations and seed initial data:

    ```php
    php artisan migrate:fresh
	php artisan db:seed
     ```
8. Start server:
    ```php
    php artisan serve
     ```
## Credentials

Access the login page: [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

-   Email: [admin@admin.com](mailto:admin@admin.com)
-   Password: password

## Learn More

For further information and to explore the possibilities of Laravel Splade, visit the official website: [https://splade.dev/](https://splade.dev/)

Take your dashboard creation experience to the next level with SpladePanel. Embrace the simplicity, speed, and beauty that it offers.
