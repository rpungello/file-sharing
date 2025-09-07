<?php

namespace App\Observers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class FileObserver
{
    public function creating(File $file): void
    {
        $file->download_token = Uuid::uuid4()->toString();
        if (empty($file->disk)) {
            $file->disk = config('filesystems.default');
        }
    }

    public function deleted(File $file): void
    {
        Storage::disk($file->disk)->delete($file->path);
        $file->update([
            'path' => null,
            'disk' => null,
        ]);
    }
}
