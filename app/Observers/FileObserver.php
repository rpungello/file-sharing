<?php

namespace App\Observers;

use App\Models\File;
use Ramsey\Uuid\Uuid;

class FileObserver
{
    public function creating(File $file): void
    {
        $file->uuid = Uuid::uuid4()->toString();
        if (empty($file->disk)) {
            $file->disk = config('filesystems.default');
        }
    }
}
