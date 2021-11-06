<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ExamPolicy
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
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Exam $exam)
    {
        return in_array($user->role,["teacher","student"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    public function viewTeacher(User $user){
        return $user->role === 'teacher' ? Response::allow() : Response::deny('You are not an teacher.');
    }

    public function viewStudent(User $user){
        return $user->role === 'student' ? Response::allow() : Response::deny('You are not an student.');
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role === 'teacher' ? Response::allow() : Response::deny('You are not an teacher.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Exam $exam)
    {
        return $user->role === 'teacher' ? Response::allow() : Response::deny('You are not an teacher.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Exam $exam)
    {
        return $user->role === 'teacher' ? Response::allow() : Response::deny('You are not an teacher.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Exam $exam)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Exam $exam)
    {
        //
    }

    public function downloadExamQuestions(User $user, Exam $exam)
    {
        return in_array($user->role,["teacher","student"]) ? Response::allow() : Response::deny('You cannot access.');
    }

    public function downloadExamAnswer(User $user, Exam $exam)
    {
        return $user->role === 'teacher' ? Response::allow() : Response::deny('You are not an teacher.');
    }

    public function submitExam(User $user)
    {
        return $user->role === 'student' ? Response::allow() : Response::deny('You are not an student.');
    }

    public function exportScore(User $user)
    {
        return $user->role === 'teacher' ? Response::allow() : Response::deny('You are not an teacher.');
    }

    public function viewListSubmit(User $user)
    {
        return $user->role === 'teacher' ? Response::allow() : Response::deny('You are not an teacher.');
    }
}
