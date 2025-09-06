# Install Requirements for IFlyFirstClass

## Missing Requirements
PHP and Composer are not installed on your system.

## Install PHP and Composer on macOS

### Option 1: Using Homebrew (Recommended)
```bash
# Install Homebrew if not installed
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Install PHP
brew install php

# Install Composer
brew install composer

# Install MySQL
brew install mysql
brew services start mysql
```

### Option 2: Using XAMPP/MAMP
1. Download XAMPP from https://www.apachefriends.org/
2. Install and start Apache + MySQL
3. PHP will be available at `/Applications/XAMPP/bin/php`

### Option 3: Using PHP built-in (macOS Monterey+)
```bash
# Check if PHP is available
/usr/bin/php -v

# If available, install Composer manually
curl -sS https://getcomposer.org/installer | /usr/bin/php
mv composer.phar /usr/local/bin/composer
```

## After Installation, Run:
```bash
cd /Users/mateoramos/Desktop/github/iflyfirstclass

# Install dependencies
composer install

# Initialize project
php init --env=Development --overwrite=y

# Create database
mysql -u root -p -e "CREATE DATABASE iflyfirstclass CHARACTER SET utf8 COLLATE utf8_unicode_ci;"

# Run migrations
php yii migrate

# Start servers
php yii serve --docroot=frontend/web --port=8080 &
php yii serve --docroot=backend/web --port=8081 &
```

## Access URLs
- Frontend: http://localhost:8080
- Backend: http://localhost:8081