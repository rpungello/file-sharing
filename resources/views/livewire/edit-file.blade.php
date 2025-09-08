<form class="space-y-4" wire:submit.prevent="saveFile">
    <!-- Title Input -->
    <flux:input wire:model="title" :label="__('Title')" />

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

    <!-- Tags -->
    <flux:select variant="listbox"
                 :label="__('Tags')"
                 multiple
                 placeholder="Select tags..."
                 wire:model="tag_ids"
    >
        @foreach($this->tags as $tag)
            <flux:select.option :value="$tag->getKey()">
                {{ $tag->name }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:button type="submit" variant="primary">
        {{ __('Save') }}
    </flux:button>
</form>
