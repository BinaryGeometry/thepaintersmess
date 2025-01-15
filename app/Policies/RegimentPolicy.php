<?php

namespace App\Policies;

use App\Models\Regiment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegimentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, Regiment $regiment): bool {}

    public function create(User $user): bool {}

    public function update(User $user, Regiment $regiment): bool {}

    public function delete(User $user, Regiment $regiment): bool {}

    public function restore(User $user, Regiment $regiment): bool {}

    public function forceDelete(User $user, Regiment $regiment): bool {}
}
