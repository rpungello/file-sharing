<?php

namespace App\Livewire;

use App\Models\FileRequest;
use Flux\Flux;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ManageFileRequests extends Component
{
    public function render(): View
    {
        return view('livewire.manage-file-requests');
    }

    public function addNew(): void
    {
        auth()->user()->folders()->create(
            $this->validate()
        );
        $this->reset('title');

        Flux::toast('Folder created successfully.', variant: 'success');
    }

    public function removeRequest(FileRequest $request): void
    {
        $this->authorize('delete', $request);
        $request->delete();

        Flux::toast("Folder $request->title deleted successfully.", variant: 'success');
    }

    #[Computed]
    public function requests(): LengthAwarePaginator
    {
        return auth()->user()->requests()->orderByDesc('created_at')->paginate();
    }
}
