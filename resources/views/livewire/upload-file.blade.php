<form wire:submit.prevent="uploadFile">
    <div
        x-data="{ uploading: false, progress: 0 }"
        x-on:livewire-upload-start="uploading = true"
        x-on:livewire-upload-finish="uploading = false"
        x-on:livewire-upload-cancel="uploading = false"
        x-on:livewire-upload-error="uploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        class="space-y-4"
    >
        <!-- Title Input -->
        <flux:input wire:model="title" :label="__('Title')" />

        <!-- Folder Select -->
        <flux:select variant="listbox"
                     searchable
                     clearable
                     placeholder="Choose a folder"
                     :label="__('Folder')"
                     wire:model="folder_id"
        >
            @foreach($this->folders as $folder)
                <flux:select.option :value="$folder->getKey()">
                    {{ $folder->title }}
                </flux:select.option>
            @endforeach
        </flux:select>

        <!-- File Input -->
        <flux:input.file :label="__('File')" wire:model="file" />

        <!-- Progress Bar -->
        <div x-show="uploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>

        <!-- Upload Button -->
        <flux:button variant="primary" type="submit" icon="arrow-up-tray">
            {{ __('Upload') }}
        </flux:button>
    </div>
</form>
