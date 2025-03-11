# A useful package to have user management in your mailcoach project

[![Latest Version on Packagist](https://img.shields.io/packagist/v/combindma/mailcoach-skeleton.svg?style=flat-square)](https://packagist.org/packages/combindma/mailcoach-skeleton)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/combindma/mailcoach-skeleton/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/combindma/mailcoach-skeleton/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/combindma/mailcoach-skeleton/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/combindma/mailcoach-skeleton/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/combindma/mailcoach-skeleton.svg?style=flat-square)](https://packagist.org/packages/combindma/mailcoach-skeleton)


## About Combind Agency

[Combine Agency](https://combind.ma?utm_source=github&utm_medium=banner&utm_campaign=package_name) is a leading web development agency specializing in building innovative and high-performance web applications using modern technologies. Our experienced team of developers, designers, and project managers is dedicated to providing top-notch services tailored to the unique needs of our clients.

If you need assistance with your next project or would like to discuss a custom solution, please feel free to [contact us](mailto:hello@combind.ma) or visit our [website](https://combind.ma?utm_source=github&utm_medium=banner&utm_campaign=package_name) for more information about our services. Let's build something amazing together!

## Getting Started

Before you begin, make sure you have the Mailcoach package installed and configured in your new Laravel project. You can find the installation instructions [here](https://www.mailcoach.app/self-hosted/documentation/v8/getting-started/installation/in-an-existing-laravel-app).

## Installation

You can install the package via composer:

```bash
composer require combindma/mailcoach-skeleton
```

Update the User model to this:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Mailcoach\Domain\Settings\Models\MailcoachUser;
use Spatie\Mailcoach\Domain\Shared\Traits\UsesMailcoachModels;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;


class User extends Authenticatable implements MailcoachUser
{
    use HasApiTokens;
    use Notifiable;
    use ReceivesWelcomeNotification;
    use UsesMailcoachModels;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function personalAccessTokens(): MorphMany
    {
        return $this->morphMany(PersonalAccessToken::class, 'tokenable');
    }

    public function canViewMailcoach(): bool
    {
        return true;
    }
}
```

Add this to your file app/providers/AppServiceProvider.php:
```php
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Combindma\MailcoachSkeleton\Listeners\SetupMailcoach;
use Spatie\Mailcoach\Domain\Shared\Events\ServingMailcoach;

public function boot(): void
{
        Event::listen(
            Registered::class,
            SendEmailVerificationNotification::class,
        );
        Event::listen(
            ServingMailcoach::class,
            SetupMailcoach::class,
        );
}
```

You must register the routes needed. Add this in your web file:
```php
MailcoachSkeleton::routes('app');
```

You can publish and run Laravel default migrations ('create_users_table', 'create_sessions_table', 'create_password_resets_table', 'create_jobs_table', 'create_failed_jobs_table') with:

```bash
php artisan vendor:publish --tag="mailcoach-skeleton-migrations"
php artisan migrate
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="mailcoach-skeleton-views"
```

## Creating the first user

After that you can create an initial user by executing ```php artisan mailcoach:make-user```. You can use the created user to login at Mailcoach. New user can be made on the users screen in mailcoach.

## Registering custom action: wait for a date
You can register our custom action by adding the classname to the mailcoach.automation.flows.actions config key.
```php
[
    'actions' => AutomationAction::defaultActions()->merge([
               \Combindma\MailcoachSkeleton\Actions\WaitForDateAction::class,
    ])->toArray(),
]
```

## Credits

- [Combind](https://github.com/combindma)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
