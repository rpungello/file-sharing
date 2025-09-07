<?php

namespace App\Actions;

use App\Models\File;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsCommand;
use Lorisleiva\Actions\Concerns\AsJob;
use Lorisleiva\Actions\Concerns\AsObject;

class FileDeleteExpired
{
    use AsCommand, AsJob, AsObject;

    public string $commandSignature = 'file:delete-expired';

    public string $commandDescription = 'Deletes any files where the expiration timestamp has passed';

    public function handle(): void
    {
        File::where('expires_at', '<', now())->each(fn (File $file) => $file->delete());
    }

    public function asCommand(Command $command)
    {
        $this->handle();

        $command->info('Done');
    }
}
