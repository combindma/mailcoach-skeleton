<?php

namespace Combindma\MailcoachSkeleton;

use Combindma\MailcoachSkeleton\Commands\MailcoachSkeletonCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MailcoachSkeletonServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('mailcoach-skeleton')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_mailcoach-skeleton_table')
            ->hasCommand(MailcoachSkeletonCommand::class);
    }
}
