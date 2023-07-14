# Simple Laravel Article

## Requirements

-   PHP 8.1
-   Composer

## Access CMS

- URL: localhost:8001/cms
- Credentials for admin:
- email: super-admin@article-apps.com
- password: demopassword

## Installation

Requires Composer

1. Clone This Project
2. Install dependencies using composer

```bash
cd project-directory
composer install
```

3. Copy the `.env.example` to `.env`

```bash
cp .env.example .env
```

4. Generate key

```bash
php artisan key:generate
```

5. setting the database

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=article_apps
DB_USERNAME=root
DB_PASSWORD=
```

6. Run the migration

```bash
php artisan migrate
```

7. Seed the database

```bash
php artisan db:seed
```

8. Run the project using:

```bash
php artisan serve
```
