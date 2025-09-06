<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, File $file): bool
    {
        return $user->getKey() === $file->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, File $file): bool
    {
        return $this->view($user, $file);
    }

    public function delete(User $user, File $file): bool
    {
        return $this->update($user, $file);
    }

    public function restore(User $user, File $file): bool
    {
        return $this->delete($user, $file);
    }

    public function forceDelete(User $user, File $file): bool
    {
        return $this->delete($user, $file);
    }
}
