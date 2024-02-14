<x-mailcoach::automation-action :index="$index" :action="$action" :editing="$editing" :editable="$editable" :deletable="$deletable">
    <x-slot name="legend">
        {{__mc('Wait till') }}
        <span class="form-legend-accent">
            {{ $this->description }}
        </span>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-8 sm:col-span-4">
            <x-mailcoach::date-field
                :label="__mc('Date')"
                name="date"
                :value="$date"
                wire:model.live="date"
                :required="true"
            />
        </div>
    </x-slot>
</x-mailcoach::automation-action>
