<?php

namespace Combindma\MailcoachSkeleton\Actions;

use Carbon\Carbon;
use Combindma\MailcoachSkeleton\Livewire\Actions\WaitForDateActionComponent;
use Spatie\Mailcoach\Domain\Automation\Models\ActionSubscriber;
use Spatie\Mailcoach\Domain\Automation\Support\Actions\AutomationAction;
use Spatie\Mailcoach\Domain\Automation\Support\Actions\Enums\ActionCategoryEnum;

class WaitForDateAction extends AutomationAction
{
    public function __construct(
        public Carbon $date
    ) {
        parent::__construct();
    }

    public static function getCategory(): ActionCategoryEnum
    {
        return ActionCategoryEnum::Pause;
    }

    public static function make(array $data): self
    {
        return new self(
            date: Carbon::parse($data['date']),
        );
    }

    public static function getName(): string
    {
        return (string) __mc('Wait for a date');
    }

    public static function getComponent(): ?string
    {
        return WaitForDateActionComponent::class;
    }

    public static function getIcon(): string
    {
        return 'heroicon-s-clock';
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date->format('Y-m-d'),
        ];
    }

    public function shouldContinue(ActionSubscriber $actionSubscriber): bool
    {
        if (now() >= $this->date) {
            return true;
        }

        return false;
    }
}
