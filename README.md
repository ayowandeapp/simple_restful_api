# Simple Restful API

This repository contains a Simple Restful API app, built with Laravel, designed to manage users and posts. It also has tests written.

## Table of Contents

- [Features](#features)
- [API Documentation](#api-documentation)
- [Installation](#installation)
- [Testing](#testing)
- [Postman Collection](#postman-collection)

## Features

- **CRUD Operations:**
  - Manage Posts
- **User Operations:**
  - Create Users
  - Login Users
- **Validation and Error Handling:**
  - Comprehensive input validation and error responses.

## API Documentation

The API documentation is available through the Postman collection provided in this repository. It covers all the endpoints for managing post, and users.

### Endpoints Overview

- **Users**
  - `POST /api/sanctum/token/register` - Create a new users
  - `POST /api/sanctum/token` - login user

- **Posts**
  - `POST /api/posts` - Create a new post
  - `GET /api/posts/{id}` - Fetch a specific post
  - `PUT /api/posts/{id}` - Update a post
  - `DELETE /api/posts/{id}` - Delete a post

## Installation

**Install dependencies**
```
composer install
```

**Set up the environment**
- Duplicate the .env.example file and rename it to .env.
- Configure the environment variables, including database connection details.
- Configure the .env.testing file, include the test database connection details

**Serve the application**
```
php artisan serve
```

## Testing

In the command line, run
```
php artisan test
```

## Postman Collection

The Postman collection file (Simple Restful API.postman_collection.json) is included in the repository. Import this collection into Postman to test the API.
Also, [Published collection](https://documenter.getpostman.com/view/37584024/2sAYQakB7A)
