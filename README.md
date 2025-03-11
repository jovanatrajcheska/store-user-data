# Setup Guide

## Prerequisites

- [XAMPP](https://www.apachefriends.org/)
- PHP (Included with XAMPP, but ensure it's properly configured)
- MySQL

## Project Setup

### 1. Clone or Copy the Project

1. Open **Git Bash** or **Command Prompt**.
2. Navigate to the `htdocs` directory by running:
   ```bash
   cd C:\xampp\htdocs
   ```
3. Clone the repository using the following command:
   ```bash
   git clone https://github.com/jovanatrajcheska/store-user-data.git
   ```
4. Navigate into the project folder:
   ```bash
   cd store-user-data
   ```

### 2. Configure Database Connection

Update the database credentials in the configuration file:

#### File: `/config/config.php`

Modify the following lines with your actual database credentials:

```php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your-username');
define('DB_PASSWORD', 'your-password');
define('DB_NAME', 'your-db-name');
```

### 3. Start XAMPP Services

Ensure the following services are running in XAMPP:

- **Apache** (For running PHP)
- **MySQL** (For the database)

Open XAMPP Control Panel and click **Start** on both services.

### 4. Run the Project

Open your browser and visit:

```
http://localhost/store-user-data/public
```
