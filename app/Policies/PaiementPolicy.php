<?php

namespace App\Policies;

use App\Models\User;
use App\Models\paiement;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PaiementPolicy
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
    public function view(User $user, paiement $paiement): bool
    {
        return $user->isAn('user') || $user->isA('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAn('user');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, paiement $paiement): bool
    {
        return $user->isA('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, paiement $paiement): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, paiement $paiement): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, paiement $paiement): bool
    {
        return false;
    }
}
