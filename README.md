[![Actions Status](https://github.com/artengin/laravel-pint-artisan/actions/workflows/ci.yml/badge.svg)](https://github.com/artengin/laravel-pint-artisan/actions) 
[![Coverage Status](https://coveralls.io/repos/github/artengin/laravel-pint-artisan/badge.svg?branch=master)](https://coveralls.io/github/artengin/laravel-pint-artisan?branch=master)
[![Latest Stable Version](http://poser.pugx.org/artengin/laravel-pint-artisan/v)](https://packagist.org/packages/artengin/laravel-pint-artisan) 
[![License](http://poser.pugx.org/artengin/laravel-pint-artisan/license)](https://packagist.org/packages/artengin/laravel-pint-artisan)  

# Laravel Pint Artisan

Run [Laravel Pint](https://laravel.com/docs/pint) via the Artisan console using the `php artisan pint` command, with full support for all arguments, flags, and file paths.

## Requirements

- PHP 8.3+
- Laravel 12.0+
- Laravel Pint 1.25+

## Installation

```bash
composer require artengin/laravel-pint-artisan --dev
```

## Usage

Run Pint with any options it supports:

Example:
```bash
# Format all files
php artisan pint

# Use specific preset
php artisan pint --preset=laravel

# Format specific directories/files
php artisan pint app src tests

# Combine options
php artisan pint --dirty --preset=psr12 app config

...
```

All arguments and flags are passed directly to the Pint binary. Output with formatting results is displayed.

## License

Laravel Pint Artisan package is open-sourced software licensed under the [MIT license](LICENSE.md).
