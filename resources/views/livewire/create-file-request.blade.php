<form wire:submit.prevent="submit" class="space-y-4">
    <flux:input wire:model="title" :label="__('Title')" />
    <flux:textarea wire:model="description" :label="__('Description')"/>

    <flux:button type="submit" variant="primary">
        {{ __('Save') }}
    </flux:button>
</form>
