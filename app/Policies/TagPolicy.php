<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tag $tag): bool
    {
        return $user->getKey() === $tag->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Tag $tag): bool
    {
        return $this->view($user, $tag);
    }

    public function delete(User $user, Tag $tag): bool
    {
        return $this->update($user, $tag);
    }

    public function restore(User $user, Tag $tag): bool
    {
        return $this->delete($user, $tag);
    }

    public function forceDelete(User $user, Tag $tag): bool
    {
        return $this->delete($user, $tag);
    }
}
