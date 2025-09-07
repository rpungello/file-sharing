<?php

namespace App\Livewire;

use App\Facades\Shlink;
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

    #[Validate(['required', 'file'])]
    public ?TemporaryUploadedFile $file = null;

    public function render(): View
    {
        return view('livewire.upload-file');
    }

    #[Computed]
    public function folders(): Collection
    {
        return auth()->user()->folders()->orderBy('title')->get();
    }

    public function uploadFile(): void
    {
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

        $this->redirectRoute('files.show', $file->getKey());
    }
}
