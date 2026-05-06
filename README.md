#  Modern PHP CRUD System

A sleek, responsive User Management Portal built with **PHP**, **MySQL**, and **Bootstrap 5**. This project demonstrates full CRUD (Create, Read, Update, Delete) functionality with a professional dashboard interface.



##  Features
* **Create:** Add new users via a modern, validated form.
* **Read:** Real-time data display in a clean, hover-effect table.
* **Update:** Dedicated edit page to modify existing user records.
* **Delete:** Remove users with a JavaScript confirmation safety check.
* **Responsive UI:** Fully mobile-friendly design using Bootstrap 5.
* **Notifications:** Color-coded alert system (Success/Info/Danger) for user actions.

##  Tech Stack
* **Frontend:** HTML5, CSS3, Bootstrap 5
* **Backend:** PHP 8.x
* **Database:** MySQL
* **Server Environment:** XAMPP / Apache

##  Getting Started

### 1. Prerequisites
You need to have XAMPP (or any WAMP/MAMP stack) installed on your machine.

### 2. Database Setup
1. Open **phpMyAdmin** (`http://localhost/phpmyadmin/`).
2. Create a new database named `crud_db`.
3. Click the SQL tab and run the following command to create the table:

sql
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
3. Installation
Clone or download this repository.

Move the folder into your server's root directory:

Windows: C:/xampp/htdocs/

macOS: /Applications/XAMPP/htdocs/

Ensure Apache and MySQL are running in your XAMPP Control Panel.

Open your browser and visit: http://localhost/my_crud/index.php
4.
my_crud/
├── index.php    # Main dashboard (Create, Read, Delete logic)
├── edit.php     # Update functionality page
├── README.md    # Documentation
└── (db.php)     # Optional: Database connection logic (Integrated in index.php)
