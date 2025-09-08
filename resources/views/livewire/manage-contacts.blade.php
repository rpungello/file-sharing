<div class="space-y-4">
    <flux:table>
        <flux:table.columns>
            <flux:table.column>{{ __('Name') }}</flux:table.column>
            <flux:table.column>{{ __('Email') }}</flux:table.column>
            <flux:table.column>{{ __('Company') }}</flux:table.column>
            <flux:table.column />
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this->contacts as $contact)
                <flux:table.row>
                    <flux:table.cell>{{ $contact->name }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:link href="mailto:{{ $contact->email }}">
                            {{ $contact->email }}
                        </flux:link>
                    </flux:table.cell>
                    <flux:table.cell>{{ $contact->company }}</flux:table.cell>
                    <flux:table.cell>
                        @can('update', $contact)
                            <flux:button size="sm"
                                         icon="pencil"
                                         :href="route('contacts.edit', $contact)"
                            />
                        @endcan
                        @can('delete', $contact)
                            <flux:button variant="danger"
                                         size="sm"
                                         icon="trash"
                                         wire:click="removeContact({{ $contact->getKey() }})"
                            />
                        @endcan
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <flux:button icon="plus"
                 variant="primary"
                 :href="route('contacts.create')"
    >
        {{ __('Create') }}
    </flux:button>
</div>
