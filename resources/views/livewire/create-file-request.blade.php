<form wire:submit.prevent="submit" class="space-y-4">
    <!-- Title Input -->
    <flux:input wire:model="title" :label="__('Title')" />

    <!-- Description Input -->
    <flux:textarea wire:model="description" :label="__('Description')"/>

    <!-- Folder Select -->
    <flux:select variant="listbox"
                 searchable
                 clearable
                 placeholder="Choose a folder..."
                 :label="__('Folder')"
                 wire:model="folder_id"
    >
        @foreach($this->folders as $folder)
            <flux:select.option :value="$folder->getKey()">
                {{ $folder->title }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:button type="submit" variant="primary">
        {{ __('Save') }}
    </flux:button>
</form>
