## Requirements

- PHP 8.1+ (with `pdo_mysql`)
- MySQL 8 / MariaDB
- Composer (used only for PSR-4 autoloading, no packages)

## Setup

```bash
composer install
mysql -u root < database/fa_task.sql
php database/seed.php
php -S localhost:8000 -t public
```