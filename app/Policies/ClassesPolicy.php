<?php

namespace App\Policies;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ClassesPolicy
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
        return (in_array($user->role,["teacher","student","admin"]) || !$user->classes->isEmpty()) ? Response::allow() : Response::deny('You cannot access!');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Classes $classes)
    {
        return (in_array($user->role,["teacher","student","admin"]) || !$user->classes->isEmpty()) ? Response::allow() : Response::deny('You cannot access!');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not an Admin.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Classes $classes)
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not an Admin.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Classes $classes)
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not an Admin.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Classes $classes)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Classes $classes)
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not an Admin.');
    }

    public function user_list(User $user)
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not an Admin.');
    }

    public function assign_user(User $user)
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not an Admin.');
    }
}
