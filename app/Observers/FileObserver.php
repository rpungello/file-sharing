<?php

namespace App\Observers;

use App\Models\File;

class FileObserver
{
    public function creating(File $file): void
    {
        if (empty($file->disk)) {
            $file->disk = config('filesystems.default');
        }
    }
}
