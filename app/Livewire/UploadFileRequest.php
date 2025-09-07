<?php

namespace App\Livewire;

use App\Models\File;
use App\Models\FileRequest;
use CraigPaul\Mail\TemplatedMailable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class UploadFileRequest extends Component
{
    use WithFileUploads;

    public FileRequest $fileRequest;

    #[Validate(['required', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'file'])]
    public ?TemporaryUploadedFile $file = null;

    public function mount(Request $request): void
    {
        if ($this->fileRequest->upload_token !== $request->input('token')) {
            abort(403);
        }

        $this->title = $this->fileRequest->title;
    }

    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.upload-file-request');
    }

    public function uploadFile(): void
    {
        /** @var File $file */
        $file = $this->fileRequest->user->files()->create(
            [
                'file_request_id' => $this->fileRequest->getKey(),
                'title' => $this->title,
                'filename' => $this->file->getClientOriginalName(),
                'path' => $this->file->store('files'),
                'size' => $this->file->getSize(),
            ]
        );

        $this->file->delete();
        $this->fileRequest->delete();

        $mailable = tap(new TemplatedMailable)
            ->identifier(config('services.postmark.template.request_uploaded'))
            ->include([
                'request_title' => $this->fileRequest->title,
                'file_title' => $this->title,
                'file_download_url' => $file->getDownloadUrl(),
            ]);

        Mail::to($this->fileRequest->user)->queue($mailable);

        $this->redirectRoute('requests.uploaded');
    }
}
