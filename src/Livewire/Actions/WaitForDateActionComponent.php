<?php

namespace Combindma\MailcoachSkeleton\Livewire\Actions;

use Carbon\Carbon;
use Spatie\Mailcoach\Livewire\Automations\AutomationActionComponent;

class WaitForDateActionComponent extends AutomationActionComponent
{
    public ?string $date = null;

    public function mount(): void
    {
        $default = now()->setTimezone(config('mailcoach.timezone')
            ?? config('app.timezone'))->addHour()->startOfHour();
        $this->date = $this->date ?? $default->format('Y-m-d');
    }

    public function getDescriptionProperty(): string
    {
        if (! $this->date) {
            return '…';
        }

        return Carbon::parse($this->date)->toFormattedDateString().' ('.Carbon::parse($this->date)->diffForHumans().')';
    }

    public function getData(): array
    {
        return [
            'date' => $this->date,
        ];
    }

    public function rules(): array
    {
        return [
            'date' => ['required'],
        ];
    }

    public function render()
    {
        return view('mailcoach-skeleton::livewire.actions.waitForDate');
    }
}
