<?php

namespace App\Policies;

use App\Models\Absent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AbsentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role === 'student' ? Response::allow() : Response::deny('Cannot Access');
    }

    public function course(User $user)
    {
        return $user->role === 'student' ? Response::allow() : Response::deny('Cannot Access');
    }

    public function absentGrid(User $user)
    {
        return $user->role === 'teacher' ? Response::allow() : Response::deny('Cannot Access');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Absent $absent)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Absent $absent)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Absent $absent)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Absent $absent)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Absent $absent)
    {
        //
    }
}
