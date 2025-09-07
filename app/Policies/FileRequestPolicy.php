<?php

namespace App\Policies;

use App\Models\FileRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FileRequestPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {
        return true;
    }

    public function view(User $user, FileRequest $fileRequest): bool {
        return $user->getKey() === $fileRequest->user_id;
    }

    public function create(User $user): bool {
        return true;
    }

    public function update(User $user, FileRequest $fileRequest): bool {
        return $this->view($user, $fileRequest);
    }

    public function delete(User $user, FileRequest $fileRequest): bool {
        return $this->update($user, $fileRequest);
    }

    public function restore(User $user, FileRequest $fileRequest): bool {
        return $this->delete($user, $fileRequest);
    }

    public function forceDelete(User $user, FileRequest $fileRequest): bool {
        return $this->delete($user, $fileRequest);
    }
}
