# IFlyFirstClass - Localhost Setup Guide

## Prerequisites

1. **PHP 7.4+ or 8.1+** with extensions:
   - pdo_mysql
   - openssl
   - intl
   - gd (for CAPTCHA)

2. **MySQL/MariaDB**
3. **Composer**

## Setup Steps

### 1. Initialize Development Environment
```bash
php init --env=Development --overwrite=y
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Create Database
```sql
CREATE DATABASE iflyfirstclass CHARACTER SET utf8 COLLATE utf8_unicode_ci;
```

### 4. Configure Database
Edit `common/config/main-local.php`:
```php
'db' => [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=localhost;dbname=iflyfirstclass',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
],
```

### 5. Run Migrations
```bash
php yii migrate
```

### 6. Start Development Server

**Frontend (Port 8080):**
```bash
php yii serve --docroot=frontend/web --port=8080
```

**Backend (Port 8081):**
```bash
php yii serve --docroot=backend/web --port=8081
```

## Access URLs

- **Frontend**: http://localhost:8080
- **Backend**: http://localhost:8081

## Default Admin User
After migrations, create admin user:
```bash
php yii user/create admin admin@example.com password123
```