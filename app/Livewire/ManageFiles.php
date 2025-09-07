<?php

namespace App\Livewire;

use App\Models\File;
use Flux\Flux;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ManageFiles extends Component
{
    public ?string $shareModelLink = null;

    public function render(): View
    {
        return view('livewire.manage-files');
    }

    #[Computed]
    public function files(): LengthAwarePaginator
    {
        return auth()->user()->files()->orderByDesc('created_at')->paginate();
    }

    public function share(File $file): void
    {
        if (empty($file->download_short_url)) {
            $this->shareModelLink = route('files.download', [
                'file' => $file->getKey(),
                'token' => $file->download_token,
            ]);
        } else {
            $this->shareModelLink = $file->download_short_url;
        }

        Flux::modal('share-file')->show();
    }
}
