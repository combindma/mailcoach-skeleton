<?php

namespace Combindma\MailcoachSkeleton\Commands;

use Illuminate\Console\Command;

class MailcoachSkeletonCommand extends Command
{
    public $signature = 'mailcoach-skeleton';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
