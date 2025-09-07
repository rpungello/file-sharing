<?php

namespace App\Livewire;

use App\Models\Tag;
use Flux\Flux;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\UniqueConstraintViolationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ManageTags extends Component
{
    #[Validate(['required', 'max:255'])]
    public string $name = '';

    public function render(): View
    {
        return view('livewire.manage-tags');
    }

    public function addNew(): void
    {
        try {
            auth()->user()->tags()->create(
                $this->validate()
            );
            $this->reset('name');

            Flux::toast('Tag created successfully.', variant: 'success');
        } catch (UniqueConstraintViolationException) {
            Flux::toast('Tag name must be unique.', variant: 'danger');
        }
    }

    public function removeTag(Tag $tag): void
    {
        $this->authorize('delete', $tag);
        $tag->delete();

        Flux::toast('Tag deleted successfully.', variant: 'success');
    }

    #[Computed]
    public function tags(): LengthAwarePaginator
    {
        return auth()->user()->tags()->orderBy('name')->paginate();
    }
}
