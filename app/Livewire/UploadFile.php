<?php

namespace App\Livewire;

use App\Facades\Shlink;
use App\Models\File;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Throwable;

class UploadFile extends Component
{
    use WithFileUploads;

    #[Validate(['required', 'max:255'])]
    public string $title = '';

    #[Validate(['nullable', 'exists:folders,id'])]
    public ?int $folder_id = null;

    #[Validate(['array', 'exists:tags,id'])]
    public array $tag_ids = [];

    #[Validate(['required', 'file'])]
    public ?TemporaryUploadedFile $file = null;

    #[Validate(['nullable', 'date', 'after:today'])]
    public ?string $expires_at = null;

    public function render(): View
    {
        return view('livewire.upload-file');
    }

    public function uploadFile(): void
    {
        if (empty($this->expires_at)) {
            $this->expires_at = null;
        }

        /** @var File $file */
        $file = auth()->user()->files()->create(
            array_merge(
                $this->validate(),
                [
                    'filename' => $this->file->getClientOriginalName(),
                    'path' => $this->file->store('files'),
                    'size' => $this->file->getSize(),
                ]
            )
        );

        try {
            $file->update([
                'download_short_url' => Shlink::createShortUrl($file->getDownloadUrl()),
            ]);
        } catch (Throwable $t) {
            Log::error($t);
        }

        foreach ($this->tag_ids as $id) {
            $file->tags()->attach($id);
        }

        $this->file->delete();
        $this->redirectRoute('files.show', $file->getKey());
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
