<div>
    <form wire:submit.prevent="addNew" class="space-y-4">
        <flux:input wire:model="title" :label="__('Title')" />
        <flux:button variant="primary" icon="plus" type="submit">{{ __('Save') }}</flux:button>
    </form>

    <flux:table :paginate="$this->folders">
        <flux:table.columns>
            <flux:table.column>{{ __('Title') }}</flux:table.column>
            <flux:table.column>{{ __('# of Files') }}</flux:table.column>
            <flux:table.column>{{ __('Total Size') }}</flux:table.column>
            <flux:table.column>{{ __('Created') }}</flux:table.column>
            <flux:table.column />
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this->folders as $folder)
                <flux:table.row>
                    <flux:table.cell>{{ $folder->title }}</flux:table.cell>
                    <flux:table.cell>{{ $folder->files()->count() }}</flux:table.cell>
                    <flux:table.cell>{{ $folder->files()->sum('size') }}</flux:table.cell>
                    <flux:table.cell>{{ $folder->created_at->format('F j, Y g:ia') }}</flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
