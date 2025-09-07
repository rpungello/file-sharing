<flux:card class="min-w-48">
    <flux:text>{{ __('Total Files') }}</flux:text>
    <flux:heading size="xl" class="mt-2 tabular-nums">
        {{ \Illuminate\Support\Number::format($count) }}
    </flux:heading>
</flux:card>
