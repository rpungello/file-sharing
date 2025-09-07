<div class="space-y-4">
    <div>
        <flux:heading size="xl" level="1">
            {{ $file->title }}
        </flux:heading>
        <flux:heading size="lg" level="2" class="mb-4">
            {{ $file->filename }} ({{ \Illuminate\Support\Number::fileSize($file->size)  }})
        </flux:heading>
    </div>

    <div>
        @foreach($file->tags as $tag)
            <flux:badge>
                {{ $tag->name }}
            </flux:badge>
        @endforeach
    </div>

    <flux:input :value="$file->download_short_url ?: $file->getDownloadUrl()" readonly copyable />

    <flux:button variant="primary"
                 icon="arrow-down-tray"
                 :href="$file->getDownloadUrl()"
    >
        {{ __('Download') }}
    </flux:button>

    <div>
        <flux:heading size="lg" level="2">
            {{ __('Downloads') }}
        </flux:heading>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>{{ __('IP Address') }}</flux:table.column>
                <flux:table.column>{{ __('Timestamp') }}</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach($file->downloads()->orderByDesc('created_at')->get() as $download)
                    <flux:table.row>
                        <flux:table.cell>{{ $download->ip_address }}</flux:table.cell>
                        <flux:table.cell>{{ $download->created_at->format('F j, Y g:ia') }}</flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
</div>
