<form wire:submit.prevent="create" class="space-y-4">
    <flux:input wire:model="name" :badge="__('Required')" :label="__('Name')"/>
    <flux:input wire:model="email" type="email" :badge="__('Required')" :label="__('Email')"/>
    <flux:input wire:model="company" :label="__('Company')"/>

    <flux:button icon="plus"
                 type="submit"
                 variant="primary"
    >
        {{ __('Save') }}
    </flux:button>
</form>
