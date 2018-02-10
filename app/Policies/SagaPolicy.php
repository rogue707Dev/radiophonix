<?php

namespace Radiophonix\Policies;

use Radiophonix\Models\User;
use Radiophonix\Models\Saga;
use Illuminate\Auth\Access\HandlesAuthorization;

class SagaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the saga.
     *
     * @param  User $user
     * @param  Saga $saga
     * @return mixed
     */
    public function update(User $user, Saga $saga)
    {
        return $saga->isOwnedBy($user);
    }

    /**
     * Determine whether the user can delete the saga.
     *
     * @param  User $user
     * @param  Saga $saga
     * @return mixed
     */
    public function delete(User $user, Saga $saga)
    {
        return $saga->isOwnedBy($user);
    }
}
