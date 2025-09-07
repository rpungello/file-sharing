<?php

namespace App\Livewire;

use App\Models\File;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowFile extends Component
{
    public File $file;

    public function render(): View
    {
        return view('livewire.show-file');
    }
}
