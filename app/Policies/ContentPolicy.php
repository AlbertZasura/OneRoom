<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ContentPolicy
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
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not an Admin.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Content $content)
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
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Content $content)
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not an Admin.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Content $content)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Content $content)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Content $content)
    {
        //
    }
}
