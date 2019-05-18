[![Build Status](https://travis-ci.org/Ponup/oscar.svg?branch=master)](https://travis-ci.org/Ponup/oscar)

# OSCAR

**O**pen **S**ource **CA**r **R**ental .

## Features

- Rental
- Calendar
- Company and client management
- Stats and reporting

### Setup instructions

Install dependencies

```sh
$ composer install
$ npm install
```

Create database
```sh
$ mysql -u YOUR_USER -p 
$ CREATE DATABASE YOUR_DATABASE; quit;
```

Define environment variables for the app

```sh
$ cp .env.example .env
$ php artisan key:generate
```

Run the docker database

```sh
$ docker-compose up
```

Create the database schema

```sh
$ php artisan migrate:install
$ php artisan db:seed
```

### Run instructions

Start the artisan webapp

```sh
$ php artisan serve
```

Or run unit tests

```sh
$ vendor/bin/phpunit
```
