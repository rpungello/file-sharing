<?php

namespace App\Observers;

use App\Models\FileRequest;
use Ramsey\Uuid\Uuid;

class FileRequestObserver
{
    public function creating(FileRequest $request): void
    {
        $request->upload_token = Uuid::uuid4()->toString();
    }
}
