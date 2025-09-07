<?php

namespace App\Policies;

use App\Models\Download;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DownloadPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Download $download): bool
    {
        return $user->getKey() === $download->file->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Download $download): bool
    {
        return false;
    }

    public function delete(User $user, Download $download): bool
    {
        return $this->view($user, $download);
    }

    public function restore(User $user, Download $download): bool
    {
        return $this->delete($user, $download);
    }

    public function forceDelete(User $user, Download $download): bool
    {
        return $this->delete($user, $download);
    }
}
