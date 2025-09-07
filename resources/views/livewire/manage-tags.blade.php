<div>
    <form wire:submit.prevent="addNew" class="space-y-4">
        <flux:input wire:model="name" :label="__('Name')" />
        <flux:button variant="primary" icon="plus" type="submit">{{ __('Save') }}</flux:button>
    </form>

    <flux:table :paginate="$this->tags">
        <flux:table.columns>
            <flux:table.column>{{ __('Name') }}</flux:table.column>
            <flux:table.column>{{ __('Created') }}</flux:table.column>
            <flux:table.column />
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this->tags as $tag)
                <flux:table.row>
                    <flux:table.cell>{{ $tag->name }}</flux:table.cell>
                    <flux:table.cell>{{ $tag->created_at->format('F j, Y g:ia') }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:button variant="danger"
                                     size="sm"
                                     icon="trash"
                                     wire:click="removeTag({{ $tag->getKey() }})"
                        />
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
