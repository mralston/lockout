# Locks user accounts after a set number of failed login attempts.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mralston/lockout.svg?style=flat-square)](https://packagist.org/packages/mralston/lockout)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/mralston/lockout/run-tests?label=tests)](https://github.com/mralston/lockout/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/mralston/lockout/Check%20&%20fix%20styling?label=code%20style)](https://github.com/mralston/lockout/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mralston/lockout.svg?style=flat-square)](https://packagist.org/packages/mralston/lockout)

---
## Installation

You can install the package via composer:

```bash
composer require mralston/lockout
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Mralston\Lockout\LockoutServiceProvider" --tag="lockout-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Mralston\Lockout\LockoutServiceProvider" --tag="lockout-config"
```

This is the contents of the published config file:

```php
return [
    'max_attempts' => env('MAX_LOGIN_ATTEMPTS', 10),
];
```

## Usage

The package will automatically prevent a user from logging in after `max_attempts` failed login attempts.

A locked user account can be manually unlocked using the following command:

```shell
php artisan lockout:unlock <user_id>
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Matt Ralston](https://github.com/mralston)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
