<?php

namespace Combindma\MailcoachSkeleton\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Combindma\MailcoachSkeleton\MailcoachSkeleton
 */
class MailcoachSkeleton extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Combindma\MailcoachSkeleton\MailcoachSkeleton::class;
    }
}
