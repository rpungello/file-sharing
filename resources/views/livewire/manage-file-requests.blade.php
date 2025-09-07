<div class="space-y-4">
    <flux:table :paginate="$this->requests">
        <flux:table.columns>
            <flux:table.column>{{ __('Title') }}</flux:table.column>
            <flux:table.column>{{ __('Created') }}</flux:table.column>
            <flux:table.column />
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this->requests as $request)
                <flux:table.row>
                    <flux:table.cell>{{ $request->title }}</flux:table.cell>
                    <flux:table.cell>{{ $request->created_at->format('F j, Y g:ia') }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:button size="sm"
                                     :href="route('requests.upload', ['fileRequest' => $request, 'token' => $request->upload_token])"
                                     icon="share"
                        />
                        <flux:button variant="danger"
                                     size="sm"
                                     icon="trash"
                                     wire:click="removeRequest({{ $request->getKey() }})"
                        />
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <flux:button icon="plus"
                 variant="primary"
                 :href="route('requests.create')"
    >
        {{ __('Create') }}
    </flux:button>
</div>
