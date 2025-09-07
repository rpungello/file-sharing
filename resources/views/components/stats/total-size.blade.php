<flux:card class="min-w-48">
    <flux:text>{{ __('Total Size') }}</flux:text>
    <flux:heading size="xl" class="mt-2 tabular-nums">
        {{ \Illuminate\Support\Number::fileSize($bytes) }}
    </flux:heading>
</flux:card>
