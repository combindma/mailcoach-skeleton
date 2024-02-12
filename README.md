# A useful package to have user management in your mailcoach project

[![Latest Version on Packagist](https://img.shields.io/packagist/v/combindma/mailcoach-mailcoach-skeleton.svg?style=flat-square)](https://packagist.org/packages/combindma/mailcoach-mailcoach-skeleton)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/combindma/mailcoach-mailcoach-skeleton/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/combindma/mailcoach-mailcoach-skeleton/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/combindma/mailcoach-mailcoach-skeleton/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/combindma/mailcoach-mailcoach-skeleton/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/combindma/mailcoach-mailcoach-skeleton.svg?style=flat-square)](https://packagist.org/packages/combindma/mailcoach-mailcoach-skeleton)


## About Combind Agency

[Combine Agency](https://combind.ma?utm_source=github&utm_medium=banner&utm_campaign=package_name) is a leading web development agency specializing in building innovative and high-performance web applications using modern technologies. Our experienced team of developers, designers, and project managers is dedicated to providing top-notch services tailored to the unique needs of our clients.

If you need assistance with your next project or would like to discuss a custom solution, please feel free to [contact us](mailto:hello@combind.ma) or visit our [website](https://combind.ma?utm_source=github&utm_medium=banner&utm_campaign=package_name) for more information about our services. Let's build something amazing together!


## Installation

You can install the package via composer:

```bash
composer require combindma/mailcoach-skeleton
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="mailcoach-skeleton-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="mailcoach-skeleton-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="mailcoach-skeleton-views"
```

## Usage

```php
$mailcoachSkeleton = new Combindma\MailcoachSkeleton();
echo $mailcoachSkeleton->echoPhrase('Hello, Combindma!');
```

## Credits

- [Combind](https://github.com/combindma)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
