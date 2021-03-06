<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AssignmentPolicy
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
        return in_array($user->role,["teacher","student"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Assignment $assignment)
    {
        return in_array($user->role,["teacher"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return in_array($user->role,["teacher"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Assignment $assignment)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Assignment $assignment)
    {
        return in_array($user->role,["teacher"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Assignment $assignment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Assignment $assignment)
    {
        //
    }

    public function upload(User $user)
    {
        return in_array($user->role,["student"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    public function download(User $user, Assignment $assignment)
    {
        return in_array($user->role,["teacher", "student"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    public function scoring(User $user, Assignment $assignment)
    {
        return in_array($user->role,["teacher"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    public function export(User $user, Assignment $assignment)
    {
        return in_array($user->role,["teacher"]) ? Response::allow() : Response::deny('You cannot access.');
    }
}
