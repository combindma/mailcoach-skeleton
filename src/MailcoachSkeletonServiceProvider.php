<?php

namespace Combindma\MailcoachSkeleton;

use Combindma\MailcoachSkeleton\Commands\MakeUserCommand;
use Combindma\MailcoachSkeleton\Livewire\AccountComponent;
use Combindma\MailcoachSkeleton\Livewire\Actions\WaitForDateActionComponent;
use Combindma\MailcoachSkeleton\Livewire\CreateUserComponent;
use Combindma\MailcoachSkeleton\Livewire\EditUserComponent;
use Combindma\MailcoachSkeleton\Livewire\UsersComponent;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MailcoachSkeletonServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('mailcoach-skeleton')
            ->hasViews()
            ->hasMigrations(
                'create_users_table',
                'create_sessions_table',
                'create_password_resets_table',
                'create_jobs_table',
                'create_failed_jobs_table',
                'create_personal_access_tokens_table',
            )
            ->hasCommand(MakeUserCommand::class);
    }

    public function packageBooted(): void
    {
        Livewire::component('mailcoach-skeleton::account', AccountComponent::class);
        Livewire::component('mailcoach-skeleton::create-user', CreateUserComponent::class);
        Livewire::component('mailcoach-skeleton::edit-user', EditUserComponent::class);
        Livewire::component('mailcoach-skeleton::users', UsersComponent::class);
        Livewire::component('mailcoach-skeleton::waitForDate', WaitForDateActionComponent::class);
    }

    public function registeringPackage(): void
    {
        $this->app->bind(MailcoachSkeleton::class, function () {
            return new MailcoachSkeleton();
        });
    }
}
