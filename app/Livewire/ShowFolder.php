<?php

namespace App\Livewire;

use App\Models\Folder;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowFolder extends Component
{
    public Folder $folder;

    public function mount(): void
    {
        $this->authorize('view', $this->folder);
    }

    public function render(): View
    {
        return view('livewire.show-folder');
    }
}
