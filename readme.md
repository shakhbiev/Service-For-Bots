## Installation

Clone the repo locally:

```sh
git clone https://github.com/ramzantg/Service-For-Bots.git laravel
cd laravel
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm ci
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Run database migrations:

```sh
php artisan migrate
```

