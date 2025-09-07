<?php

namespace App\Livewire;

use App\Facades\Shlink;
use App\Models\FileRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Throwable;

class CreateFileRequest extends Component
{
    #[Validate(['required', 'max:255'])]
    public string $title = '';

    #[Validate(['nullable', 'string'])]
    public string $description = '';

    public function render(): View
    {
        return view('livewire.create-file-request');
    }

    public function submit(): void
    {
        /** @var FileRequest $request */
        $request = auth()->user()->requests()->create(
            $this->validate()
        );

        try {
            $request->update([
                'upload_short_url' => Shlink::createShortUrl($request->getUploadUrl()),
            ]);
        } catch (Throwable $t) {
            Log::error($t);
        }

        $this->redirectRoute('requests.index');
    }
}
