<x-mailcoach::automation-action :index="$index" :action="$action" :editing="$editing" :editable="$editable" :deletable="$deletable">
    <x-slot name="legend">
        {{__mc('Wait till') }}
        <span class="form-legend-accent">
            {{ $this->description }}
        </span>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-12">
            <div class="form-field">
                <label class="label label-required" for="date">
                    {{ __mc('Datetime') }}
                </label>

                <input
                    type="datetime-local"
                    name="date"
                    id="date"
                    class="input max-w-sm"
                    value="{{ old('date', $date) }}"
                    min="{{ now()->format('Y-m-d H:i') }}"
                    wire:model.live="date"
                    required>

                @error('date')
                <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </x-slot>
</x-mailcoach::automation-action>
