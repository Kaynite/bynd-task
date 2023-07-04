## How to install

1- Clone the repo
2- cd to the project directory

```bash
cd <project-directory>
```

then run the following commands

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
touch database/database.sqlite
```

```bash
php artisan migrate --seed
```

```bash
php artisan serve
```
