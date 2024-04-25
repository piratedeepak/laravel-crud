# Laravel CRUD

## Introduction

Welcome to our Laravel backend! This backend serves as the foundation for our application, providing RESTful API endpoints for various functionalities.

## Setup

1. **Clone the Repository:** 
   ```
   git clone <repository_url>
   ```

2. **Install Dependencies:** 
   ```
   cd <project_directory>
   composer install
   ```

3. **Setup Environment Variables:**
   - Copy the `.env.example` file to `.env`.
   - Configure the database connection settings and other necessary environment variables in the `.env` file.

4. **Generate Application Key:**
   ```
   php artisan key:generate
   ```

5. **Run Migrations:**
   ```
   php artisan migrate
   ```

6. **Start the Development Server:**
   ```
   php artisan serve
   ```

## API Endpoints

- **Users:**
  - `/api/users` - GET - Get all users.
  - `/api/users/{id}` - GET - Get user by ID.
  - `/api/users/{id}` - PUT - Update user by ID.
  - `/api/users/{id}` - DELETE - Delete user by ID.


## Postman Collection

We have provided a Postman collection to ease the testing of our API endpoints. You can import it into your Postman application.

[Download Postman Collection](placeholder_link)