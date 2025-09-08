@php use Illuminate\Support\Number; @endphp
<flux:card size="sm" class="sm:min-w-48">
    <flux:text>{{ __('Total Files') }}</flux:text>
    <flux:heading size="xl" class="mt-2 tabular-nums">
        {{ Number::format($count) }}
    </flux:heading>
</flux:card>
