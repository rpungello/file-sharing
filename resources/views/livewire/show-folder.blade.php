<div class="space-y-4">
    <div>
        <flux:heading size="xl" level="1">
            {{ $folder->title }}
        </flux:heading>
    </div>

    <!-- Desktop Table -->
    <flux:table class="hidden md:table">
        <flux:table.columns>
            <flux:table.column>{{ __('Title') }}</flux:table.column>
            <flux:table.column>{{ __('Filename') }}</flux:table.column>
            <flux:table.column>{{ __('Folder') }}</flux:table.column>
            <flux:table.column>{{ __('Tags') }}</flux:table.column>
            <flux:table.column>{{ __('Size') }}</flux:table.column>
            <flux:table.column class="hidden xl:table-cell">{{ __('Created') }}</flux:table.column>
            <flux:table.column />
        </flux:table.columns>
        <flux:table.rows>
            @foreach($folder->files as $file)
                <flux:table.row>
                    <flux:table.cell>{{ $file->title }}</flux:table.cell>
                    <flux:table.cell>{{ $file->filename }}</flux:table.cell>
                    <flux:table.cell>{{ $file->folder?->title }}</flux:table.cell>
                    <flux:table.cell>
                        @foreach($file->tags as $tag)
                            <flux:badge size="sm">
                                {{ $tag->name }}
                            </flux:badge>
                        @endforeach
                    </flux:table.cell>
                    <flux:table.cell>{{ \Illuminate\Support\Number::fileSize($file->size) }}</flux:table.cell>
                    <flux:table.cell class="hidden xl:table-cell">{{ $file->created_at->format('F j, Y g:ia') }}</flux:table.cell>
                    <flux:table.cell>
                        @can('view', $file)
                            <flux:button size="sm"
                                         :href="route('files.show', $file)"
                                         icon="eye"
                            />
                        @endcan
                        @can('update', $file)
                            <flux:button size="sm"
                                         :href="route('files.edit', $file)"
                                         icon="pencil"
                            />
                        @endcan
                        @can('view', $file)
                            <flux:button size="sm"
                                         :href="route('files.download', ['file' => $file->getKey(), 'token' => $file->download_token])"
                                         icon="arrow-down-tray"
                            />
                            <flux:button size="sm"
                                         icon="share"
                                         wire:click="share({{ $file->getKey() }})"
                            />
                        @endcan
                        @can('delete', $file)
                            <flux:button variant="danger"
                                         size="sm"
                                         icon="trash"
                                         wire:click="removeFile({{ $file->getKey() }})"
                            />
                        @endcan
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <!-- Mobile List -->
    <ul class="block md:hidden space-y-4">
        @foreach($folder->files as $file)
            <li>
                <flux:card size="sm" class="space-y-2">
                    <flux:heading>
                        {{ $file->title }} / {{ $file->filename }}
                    </flux:heading>

                    @foreach($file->tags as $tag)
                        <flux:badge size="sm">
                            {{ $tag->name }}
                        </flux:badge>
                    @endforeach

                    <flux:input :value="$file->download_short_url ?: $file->getDownloadUrl()" readonly copyable />
                </flux:card>
            </li>
        @endforeach
    </ul>
</div>
