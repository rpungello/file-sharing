<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Folder $folder): bool
    {
        return $user->getKey() === $folder->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Folder $folder): bool
    {
        return $this->view($user, $folder);
    }

    public function delete(User $user, Folder $folder): bool
    {
        return $this->update($user, $folder);
    }

    public function restore(User $user, Folder $folder): bool
    {
        return $this->delete($user, $folder);
    }

    public function forceDelete(User $user, Folder $folder): bool
    {
        return $this->delete($user, $folder);
    }
}
