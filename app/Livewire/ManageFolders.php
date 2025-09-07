<?php

namespace App\Livewire;

use App\Models\Folder;
use Flux\Flux;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ManageFolders extends Component
{
    #[Validate(['required', 'max:255'])]
    public string $title = '';

    public function render(): View
    {
        return view('livewire.manage-folders');
    }

    public function addNew(): void
    {
        auth()->user()->folders()->create(
            $this->validate()
        );
        $this->reset('title');

        Flux::toast('Folder created successfully.', variant: 'success');
    }

    #[Computed]
    public function folders(): LengthAwarePaginator
    {
        return auth()->user()->folders()->orderByDesc('created_at')->paginate();
    }
}
