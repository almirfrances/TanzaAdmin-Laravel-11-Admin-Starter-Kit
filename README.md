
# TanzaAdmin - Laravel 11 Admin Starter Kit

TanzaAdmin is a starter kit built with **Laravel 11** that provides a comprehensive admin panel for managing users, vendors, and various web settings. This project enables users and vendors to register, log in, manage their profiles, and access their respective dashboards. In the admin panel, administrators have full control to manage everything, including web settings like the logo, favicon, and email configurations.

## Features

- User and Vendor Management
  - Registration and login for users and vendors
  - Profile management for users and vendors
  - Dashboard access for users, vendors, and admins
- Admin Panel
  - Manage users and vendors
  - Configure web settings (logo, favicon, email settings, etc.)
- Security
  - Password reset functionality
- Customization
  - Easily switch between SQLite (default) and other supported databases

## Requirements

- PHP 8.1+
- Composer
- Database: SQLite (default), MySQL, PostgreSQL, or any other supported by Laravel

## Installation

Follow these steps to set up the project on your local machine.

### 1. Clone the Repository

git clone https://github.com/your-username/TanzaAdmin.git
cd TanzaAdmin
2. Install Dependencies
Make sure you have Composer installed, then run:

composer install

## 3. Configure Environment
   a. Copy the .env.example file
cp .env.example .env
   b. Update the .env file
By default, TanzaAdmin uses SQLite. To use SQLite, ensure the following settings in your .env file:

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/your/database.sqlite
To use another database (e.g., MySQL), update the .env file as shown:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
If using SQLite, create the database file:

touch database/database.sqlite
Then set the .env to:

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/your/project/database/database.sqlite

## 4. Generate Application Key

php artisan key:generate


## 5. Run Migrations and Seed the Database

php artisan migrate
php artisan db:seed
## 6. Start the Development Server

php artisan serve
Once the server is running, you can access the application at:

http://localhost:8000

### Admin Credentials
After running the database seeds, log in to the admin panel using the following credentials:

Admin URL: /admin
Username: tanzaadmin
Password: tanzahost

### Usage
Accessing the Admin Panel

Navigate to /admin on your local server.
Use the provided admin credentials to log in.
From the admin dashboard, manage users, vendors, and configure web settings.
Managing Users and Vendors

## Users:
Register and log in through the user interface.
Manage profiles and access the user dashboard.

## Vendors:
Register, log in, manage profiles, and access the vendor dashboard.
Web Settings

## Logo: Upload and update the website logo.
Favicon: Set the favicon for the website.

## Email Settings: Configure email templates and settings for notifications.

### Contributing
Feel free to fork this repository and submit pull requests to improve the project. Contributions are welcome!

#### License
This project is licensed under the MIT License. See the LICENSE file for more information.

Notes:
Admin Seeder: Ensure you have an admin seeder that sets up the default admin username and password as tanzaadmin and tanzahost.
