<?php

namespace App\Livewire;

use App\Models\Contact;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditContact extends Component
{
    #[Validate(['required', 'max:255'])]
    public Contact $contact;

    #[Validate(['nullable', 'max:255'])]
    public string $name;

    #[Validate(['required', 'email', 'max:255'])]
    public string $email;

    public ?string $company;

    public function mount(): void
    {
        $this->name = $this->contact->name;
        $this->email = $this->contact->email;
        $this->company = $this->contact->company;
    }

    public function render(): View
    {
        return view('livewire.edit-contact');
    }

    public function saveContact(): void
    {
        $this->authorize('update', $this->contact);

        $this->contact->update(
            $this->validate()
        );

        Flux::toast('Contact updated successfully.', variant: 'success');
    }
}
