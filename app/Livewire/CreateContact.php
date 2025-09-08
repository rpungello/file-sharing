<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateContact extends Component
{
    #[Validate(['required', 'max:255'])]
    public string $name = '';

    #[Validate(['nullable', 'max:255'])]
    public string $company = '';

    #[Validate(['required', 'email', 'max:255'])]
    public string $email = '';

    public function render(): View
    {
        return view('livewire.create-contact');
    }

    public function create(): void
    {
        auth()->user()->contacts()->create(
            $this->validate()
        );

        $this->redirectRoute('contacts.index');
    }
}
