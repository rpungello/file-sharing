<form class="space-y-4" wire:submit.prevent="saveContact">
    <!-- Name Input -->
    <flux:input wire:model="name" :badge="__('Required')" :label="__('Name')" />

    <!-- Email Input -->
    <flux:input wire:model="email" type="email" :badge="__('Required')" :label="__('Email')" />

    <!-- Company Input -->
    <flux:input wire:model="company" :label="__('Company')" />

    <flux:button type="submit" variant="primary">
        {{ __('Save') }}
    </flux:button>
</form>
