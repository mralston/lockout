# Lockout

Locks user accounts and IP addresses after repeated failed login attempts.

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
    'max_attempts_user' => env('MAX_LOGIN_ATTEMPTS_USER', 10),
    'max_attempts_ip' => env('MAX_LOGIN_ATTEMPTS_IP', 20),
    'lockout_duration_user' => env('LOCKOUT_DURATION_USER', 15 * 60),
    'lockout_duration_ip' => env('LOCKOUT_DURATION_IP', 60 * 60 * 24 * 7),
];
```

## Basic Usage

The package will automatically block a user account or IP address after too many failed attempts within the specified time interval.

`MAX_LOGIN_ATTEMPTS_USER` determines how many failed logins should be permitted for a specific user before being locked out.

`MAX_LOGIN_ATTEMPTS_IP` determines how many failed logins should be permitted from a specific IP address before being locked out.

`LOCKOUT_DURATION_USER` determines how long a user account should be locked for. Set to zero or null for a permanent ban.

`LOCKOUT_DURATION_IP` determines how long an IP address should be locked for. Set to zero or null for a permanent ban.

## Unlocking Users & IP addresses

A locked user account or IP address can be manually unlocked using the following commands:

```shell
php artisan lockout:unlock --user=123
php artisan lockout:unlock --email=somebody@example.com
php artisan lockout:unlock --ip=1.2.3.5
```

## Maintenance

Stale records of failed authentication attempts can be pruned with the following command, which can be run manually or through the scheduler:

```shell
php artisan lockout:prune
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
