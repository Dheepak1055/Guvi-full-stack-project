# GUVI Full Stack User Management System

## Project Overview

This project is a complete user management application built for a GUVI internship submission. It demonstrates secure registration, login, profile management, and logout workflows using a modern full-stack architecture.

## Features

- User registration with password hashing
- User login with localStorage-based authentication state
- Profile creation and update using MongoDB
- Redis-enabled session architecture preserved
- AJAX-driven frontend communication
- Input validation on frontend and backend
- SQL injection and XSS-safe design patterns
- Responsive user interface with Bootstrap

## Tech Stack

- PHP
- MySQL
- MongoDB
- Redis
- HTML/CSS
- JavaScript
- jQuery
- Bootstrap

## Installation

1. Clone or copy the project folder to your web server document root.
2. Ensure PHP is installed with the Redis and MongoDB extensions.
3. Start MySQL, MongoDB, and Redis services.
4. Open the project in your browser via your local web server.

## MySQL Setup

1. Create a database named `guvi project`.
2. Create the `users` table using this example structure:

```sql
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
);
```

3. Update `php/db.php` if your MySQL host, port, or credentials differ.

## MongoDB Setup

1. Start MongoDB locally.
2. The application stores profile documents in the `guvi_mongo` database and `profiles` collection.
3. No additional MongoDB configuration is required unless your instance uses authentication.

## Redis Setup

1. Start Redis locally on the default port.
2. The Redis session settings are configured in `php/config.php`.
3. Redis is preserved for session architecture support and does not alter current localStorage login flow.

## Project Structure

```
project-root/
├── assets/
│   ├── icons/
│   └── images/
├── css/
├── js/
├── php/
├── vendor/
├── README.md
├── composer.json
└── composer.lock
```

## Screenshots

_Add screenshots here if needed._

## Testing Checklist

- Register a new user successfully.
- Login and verify localStorage contains `isLoggedIn`, `userEmail`, `userName`, and `userId`.
- Open `profile.html` directly while logged in and validate access.
- Save and update profile data and verify persistence.
- Logout and verify localStorage is cleared.

## Assignment Requirements Covered

- Registration using MySQL
- Login with password hashing
- Profile stored and updated in MongoDB
- AJAX communication across frontend and backend
- Redis integration retained for session architecture
- Login state maintained via browser localStorage
- Frontend and backend validation
- No session-based authentication dependence in profile access

## Notes

- The image asset is organized under `assets/images/` for a cleaner project layout.
- The core authentication and data workflows remain unchanged.
