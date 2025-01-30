<?php

namespace App\Policies;

use App\Models\Regiment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegimentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Regiment $regiment): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Regiment $regiment): bool
    {
        return $regiment->user()->is($user);
    }

    public function delete(User $user, Regiment $regiment): bool
    {
        return $this->update($user, $regiment);
    }

    public function restore(User $user, Regiment $regiment): bool
    {
        return false;
    }

    public function forceDelete(User $user, Regiment $regiment): bool
    {
        return false;
    }

    public function image(User $user, Regiment $regiment): bool
    {
        return false;
    }
}
