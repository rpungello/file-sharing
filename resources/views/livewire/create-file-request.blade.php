<form wire:submit.prevent="submit" class="space-y-4">
    <!-- Title Input -->
    <flux:input wire:model="title" :badge="__('Required')" :label="__('Title')" />

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

    <!-- Contact Select -->
    <flux:select variant="listbox"
                 searchable
                 clearable
                 placeholder="Choose a contact..."
                 :label="__('Contact')"
                 wire:model="contact_id"
    >
        @foreach($this->contacts as $contact)
            <flux:select.option :value="$contact->getKey()">
                <div class="flex flex-col">
                    <flux:text>{{ $contact->name }}</flux:text>
                    <flux:text variant="subtle">{{ $contact->email }}</flux:text>
                </div>
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:button type="submit" variant="primary">
        {{ __('Save') }}
    </flux:button>
</form>
