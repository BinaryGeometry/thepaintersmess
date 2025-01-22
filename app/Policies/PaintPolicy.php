<?php

namespace App\Policies;

use App\Models\Paint;
use App\Models\User;

class PaintPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Paint $paint): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Paint $paint): bool
    {
        return $paint->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Paint $paint): bool
    {
        return $this->update($user, $paint);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Paint $paint): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Paint $paint): bool
    {
        return false;
    }

    public function image(User $user, Paint $paint): bool
    {
        return false;
    }
}
