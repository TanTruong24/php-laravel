# Laravel Stores API

Laravel Stores API is a RESTful API built with Laravel framework to manage stores and products. It provides endpoints for user authentication, store management, and product management.

## Features

- **User Authentication**: Users can register, log in, log out, and manage their authentication tokens.
- **Store Management**: Users can create, update, delete, and list their stores.
- **Product Management**: Users can create, update, delete, list, and search products within their stores.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/TanTruong24/php-laravel.git
2. **Navigate to the project directory**
    ```bash
    cd laravel-stores-api
3. **Install Composer dependencies:**
    ```bash
    composer install
4. **Create a copy of the .env.example file and rename it to .env. Update the database and other configuration settings in the .env file.**
5. **Generate an application key:**
    ```bash
    php artisan key:generate
6. **Run database migrations and seeders**
    ```bash
    php artisan migrate --seed

## API Endpoints
- **Authentication:**

    - `POST /api/register`: Register a new user.
    - `POST /api/login`: Log in an existing user.
    - `POST /api/logout`: Log out the authenticated user.

- **Store Management:**

    - `GET /api/stores`: List all stores owned by the authenticated user.
    - `POST /api/stores`: Create a new store for the authenticated user.
    - `GET /api/stores/{id}`: Retrieve details of a specific store.
    - `PUT /api/stores/{id}`: Update details of a specific store.
    - `DELETE /api/stores/{id}`: Delete a specific store.

- **Product Management:**

    - `GET /api/products`: List all products within the authenticated user's stores.
    - `POST /api/products`: Create a new product within the authenticated user's store.
    - `GET /api/products/{id}`: Retrieve details of a specific product.
    - `PUT /api/products/{id}`: Update details of a specific product.
    - `DELETE /api/products/{id}`: Delete a specific product.

## **Authentication**
Authentication is handled using Laravel's built-in authentication system. Users can register for an account, log in with their credentials, and obtain an authentication token. This token should be included in the Authorization header of subsequent requests as Bearer <token> to authenticate the user.

## **Testing**
The project includes PHPUnit tests to ensure the functionality of the API endpoints. You can run the tests using the following command:

```bash
php artisan test