<?php

namespace App\Livewire;

use App\Models\File;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditFile extends Component
{
    public File $file;

    #[Validate(['required', 'max:255'])]
    public string $title;

    #[Validate(['nullable', 'exists:folders,id'])]
    public ?int $folder_id;

    #[Validate(['array'])]
    public array $tag_ids = [];

    public function mount(): void
    {
        $this->authorize('view', $this->file);

        $this->title = $this->file->title;
        $this->folder_id = $this->file->folder_id;
        $this->tag_ids = $this->file->tags->pluck('id')->toArray();
    }

    public function render(): View
    {
        return view('livewire.edit-file');
    }

    public function saveFile(): void
    {
        $this->authorize('update', $this->file);

        $this->file->update(
            $this->validate()
        );

        $this->file->tags()->sync($this->tag_ids);

        Flux::toast('File updated successfully.', variant: 'success');
    }

    #[Computed]
    public function folders(): Collection
    {
        return auth()->user()->folders()->orderBy('title')->get();
    }

    #[Computed]
    public function tags(): Collection
    {
        return auth()->user()->tags()->orderBy('name')->get();
    }
}
