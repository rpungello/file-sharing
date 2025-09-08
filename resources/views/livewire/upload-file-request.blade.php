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
        <!-- User Display -->
        <flux:input readonly :value="$fileRequest->user->name" :label="__('Requested By')" />

        <!-- Title Input -->
        <flux:input wire:model="title" :label="__('Title')" :badge="__('Required')" />

        <!-- Description Display -->
        <flux:textarea readonly :label="__('Description')">
            {{ $fileRequest->description }}
        </flux:textarea>

        <!-- Folder Display -->
        @if(!empty($fileRequest->folder_id))
            <flux:input readonly :value="$fileRequest->folder?->title" :label="__('Folder')" />
        @endif

        <!-- File Input -->
        <flux:input.file :label="__('File')" wire:model="file" />

        <!-- Progress Bar -->
        <div x-show="uploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>

        <!-- Upload Button -->
        <flux:button variant="primary" type="submit" icon="arrow-up-tray" :disabled="empty($file)">
            {{ __('Upload') }}
        </flux:button>
    </div>
</form>
