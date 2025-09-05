# Laravel AtaKimi - Hospital Management System

A simple and modern hospital management system built with the Laravel 12 framework and styled with Bootstrap. This project provides basic CRUD (Create, Read, Update, Delete) functionality for managing hospital data.

## ✨ Features

* **Secure Authentication**: Built-in login and registration system using Laravel Breeze.

* **Hospital CRUD**: Easily add, view, edit, and delete hospital records.

* **AJAX-powered Deletion**: Smoothly delete records without a full page reload for a better user experience.

* **Pagination**: Clean and simple pagination for browsing through a large list of hospitals.

* **Responsive UI**: A clean user interface styled with Bootstrap that works on both desktop and mobile devices.

## 🚀 Installation

Follow these steps to get the project up and running on your local machine.

### Prerequisites

* PHP >= 8.2

* Composer

* Node.js & NPM

* A local database server (e.g., MySQL, MariaDB via Laragon or XAMPP)

### Setup Steps

1. **Clone the repository:**

git clone https://github.com/AtaKimi/laravel_atakimi.git

cd laravel_atakimi


2. **Install dependencies:**
Install both Composer and NPM packages.

composer install

npm install


3. **Set up your environment file:**
Copy the example environment file and generate your application key.

cp .env.example .env

php artisan key:generate


4. **Configure your database:**

Open the `.env` file and update the `DB_*` variables with your database credentials.

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=your_database_name

DB_USERNAME=your_username

DB_PASSWORD=your_password

5. **Run database migrations:**
This will create the necessary tables in your database.


php artisan migrate --seed


6. **Compile front-end assets:**

npm run dev


## ▶️ Usage

1. **Start the development server:**

php artisan serve

2. **Access the application:**
Open your web browser and navigate to `http://127.0.0.1:8000`.

3. **Register a new user:**
Create an account using the "Register" link to access the hospital management dashboard.
