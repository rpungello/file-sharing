<x-layouts.app :title="__('Dashboard')">
    <div class="grid grid-cols-2 sm:flex sm:flex-row sm:flex-wrap gap-4">
        <x-stats.total-files />
        <x-stats.total-size />
        <x-stats.total-downloads />
    </div>
</x-layouts.app>
