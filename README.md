# Laravel Pint Artisan

Run [Laravel Pint](https://laravel.com/docs/pint) through Artisan console using the `php artisan pint` command, with full support for all arguments, flags, and file paths.

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
