<?php

namespace Combindma\MailcoachSkeleton\Triggers;

use Spatie\Mailcoach\Domain\Audience\Events\UnconfirmedSubscriberCreatedEvent;
use Spatie\Mailcoach\Domain\Automation\Support\Triggers\AutomationTrigger;
use Spatie\Mailcoach\Domain\Automation\Support\Triggers\TriggeredByEvents;

class UnconfirmedSubscriptionTrigger extends AutomationTrigger implements TriggeredByEvents
{
    public static function getName(): string
    {
        return (string) __mc('When a unconfirmed subscriber gets added');
    }

    public function subscribe($events): void
    {
        $events->listen(
            UnconfirmedSubscriberCreatedEvent::class,
            function ($event) {
                $this->runAutomation($event->subscriber);
            }
        );
    }
}
