<?php

namespace App\Providers;

use App\Models\Classes;
use App\Models\Message;
use App\Policies\ClassesPolicy;
use App\Policies\MessagePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Message::class => MessagePolicy::class,
        Classes::class => ClassesPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isVerify', function($user){
            return $user->hasVerifiedEmail();
        });
        Gate::define('isAdmin', function($user){
            return $user->role == 'admin';
        });
        Gate::define('isStudent', function($user){
            return $user->role == 'student';
        });
        Gate::define('isTeacher', function($user){
            return $user->role == 'teacher';
        });

    }
}
