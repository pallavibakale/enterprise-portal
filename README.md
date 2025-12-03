# Enterprise Client Collaboration Portal

A secure, role-based collaboration platform built using **PHP (Yii2 MVC)** and **MySQL**.

## 🎥 Demo

![Demo](demo.gif)

## 📦 Features

- Role-based authentication
- Client & project management
- AJAX discussion threads
- Bootstrap 5 responsive UI
- Secure Yii2 backend

## 🚀 Setup

1. Install dependencies:

```
composer install
```

2. Create database:

```
CREATE DATABASE enterprise_portal;
```

3. Run migrations:

```
php yii migrate
```

4. Seed admin:

```
php yii seed/admin
```

5. Run server:

```
cd web
php -S 127.0.0.1:8080 index.php
```

## 🧩 Tech Stack

- PHP 8.x
- Yii2 MVC
- MySQL
- Bootstrap 5
- Vanilla JS (fetch API)
