@php use Illuminate\Support\Number; @endphp
<flux:card size="sm" class="sm:min-w-48">
    <flux:text>{{ __('Total Size') }}</flux:text>
    <flux:heading size="xl" class="mt-2 tabular-nums">
        {{ Number::fileSize($bytes) }}
    </flux:heading>
</flux:card>
