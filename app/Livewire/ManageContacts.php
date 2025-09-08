<?php

namespace App\Livewire;

use App\Models\Contact;
use Flux\Flux;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ManageContacts extends Component
{
    public function render(): View
    {
        return view('livewire.manage-contacts');
    }

    public function removeContact(Contact $contact): void
    {
        $this->authorize('delete', $contact);
        $contact->delete();

        Flux::toast("Contact $contact->name deleted successfully.", variant: 'success');
    }

    #[Computed]
    public function contacts(): LengthAwarePaginator
    {
        return auth()->user()->contacts()->paginate();
    }
}
