<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $authUser): bool
    {
        return $authUser->role->name === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $authUser, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $authUser): bool
    {
        return $authUser->role->name === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser, User $funcionario): bool
    {
        Log::info('Policy update chamada', [
            'authUser' => $authUser->id,
            'funcionario' => $funcionario->id,
            'role' => $authUser->role->name,
        ]);
        // Se for admin, pode editar qualquer funcionário
        if ($authUser->role->name === 'admin') {
            return true;
        }

        // Se for funcionário, só pode editar o próprio perfil
        return $authUser->id === $funcionario->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $authUser, User $model): bool
    {
        return $authUser->role->name === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
