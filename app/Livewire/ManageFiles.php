<?php

namespace App\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ManageFiles extends Component
{
    public function render(): View
    {
        return view('livewire.manage-files');
    }

    #[Computed]
    public function files(): LengthAwarePaginator
    {
        return auth()->user()->files()->orderByDesc('created_at')->paginate();
    }
}
