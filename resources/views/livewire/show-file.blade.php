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
</div>
