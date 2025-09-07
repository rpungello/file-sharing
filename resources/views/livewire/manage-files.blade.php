<div>
    <flux:button variant="primary" :href="route('files.upload')" icon="arrow-up-tray">
        {{ __('Upload') }}
    </flux:button>

    <flux:table :paginate="$this->files">
        <flux:table.columns>
            <flux:table.column>{{ __('Title') }}</flux:table.column>
            <flux:table.column>{{ __('Filename') }}</flux:table.column>
            <flux:table.column>{{ __('Folder') }}</flux:table.column>
            <flux:table.column>{{ __('Size') }}</flux:table.column>
            <flux:table.column>{{ __('Created') }}</flux:table.column>
            <flux:table.column />
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this->files as $file)
                <flux:table.row>
                    <flux:table.cell>{{ $file->title }}</flux:table.cell>
                    <flux:table.cell>{{ $file->filename }}</flux:table.cell>
                    <flux:table.cell>{{ $file->folder?->title }}</flux:table.cell>
                    <flux:table.cell>{{ \Illuminate\Support\Number::fileSize($file->size) }}</flux:table.cell>
                    <flux:table.cell>{{ $file->created_at->format('F j, Y g:ia') }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:button variant="primary"
                                     size="sm"
                                     :href="route('files.download', ['file' => $file->getKey(), 'token' => $file->download_token])"
                                     icon="arrow-down-tray"
                        />
                        <flux:button variant="primary"
                                     size="sm"
                                     icon="share"
                                     wire:click="share({{ $file->getKey() }})"
                        />
                        <flux:button variant="danger"
                                     size="sm"
                                     icon="trash"
                                     wire:click="removeFile({{ $file->getKey() }})"
                        />
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <flux:modal name="share-file" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Share Link') }}</flux:heading>
            </div>
            <flux:input :value="$shareModelLink" readonly copyable />
        </div>
    </flux:modal>
</div>
