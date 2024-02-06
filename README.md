<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Project Setup

Follow these steps to set up the Laravel project:

## Step 1: Install SQLite

First, you need to install SQLite on your system.

## Step 2: Enable SQLite Extension

Next, enable the SQLite extension in your `php.ini` file. You can do this by uncommenting or adding the following line: extension=pdo_sqlite

## Step 3: Enable SQLite Extension

Finally, start the migration process. The database used was SQLite, it is located within `database/database.sqlite`. Remember to add the environment variables.

## Database Schema One-to-Many

The database consists of two tables: `users` and `tasks`.

### Users Table

The `users` table has the following fields:

-   `id`: A unique identifier for each user.
-   `name`: The name of the user.
-   `email`: The email of the user. This field is unique for each user.
-   `email_verified_at`: The timestamp when the user's email was verified. This field can be null if the email is not yet verified.
-   `password`: The password of the user.
-   `rememberToken`: A token used to remember the user for future sessions.
-   `timestamps`: This includes two fields, `created_at` and `updated_at`, which Laravel automatically manages.

### Tasks Table

The `tasks` table has the following fields:

-   `id`: A unique identifier for each task.
-   `user_id`: A foreign key that references the `id` in the `users` table. This establishes a relationship between the `users` and `tasks` tables, where each task is associated with a user.
-   `name`: The name of the task.
-   `description`: A text description of the task.
-   `is_completed`: A boolean value indicating whether the task is completed.
-   `timestamps`: This includes two fields, `created_at` and `updated_at`, which Laravel automatically manages.

## Authentication

We are using Laravel's built-in authentication method called `auth:sanctum` for handling the endpoints.

## Postman Documentation

You can download the Postman collection for this Laravel application [by clicking here](https://drive.google.com/file/d/1gseekgPezt0vHlvNsLN3L76HL-FqfLhI/view?usp=drive_link).
