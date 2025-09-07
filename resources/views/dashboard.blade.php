<x-layouts.app :title="__('Dashboard')">
    <div class="flex flex-row flex-wrap gap-4">
        <x-stats.total-files />
        <x-stats.total-size />
        <x-stats.total-downloads />
    </div>
</x-layouts.app>
