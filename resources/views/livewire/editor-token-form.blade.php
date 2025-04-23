<div class="flex grid grid-cols-2 gap-4 items-end">

    <div class="col-span-2">
        <flux:input wire:model="name" label="{{ __('Name') }}" />
    </div>

    <flux:select wire:model="type" placeholder="{{ __('Choose type...') }}">
        @foreach ($types as $type)
            <flux:select.option value="{{ $type->value }}">{{ $type->label($type->value) }}</flux:select.option>
        @endforeach
    </flux:select>

    <flux:select wire:model="icon" placeholder="{{ __('Choose icon...') }}">
        @foreach ($icons as $icon)
            <flux:select.option value="{{ $icon->value }}">
                {{ $icon->label($icon->value) }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:field variant="inline" class="w-fit">
        <flux:label>{{ __('Has global value') }}</flux:label>
        <flux:switch wire:model.live="hasGlobalValue" />
        <flux:error name="hasGlobalValue" />
    </flux:field>

    <div class="flex justify-end col-span-2">
        <flux:button variant="primary" wire:click="save()">{{ __('Save') }}</flux:button>
    </div>
</div>
