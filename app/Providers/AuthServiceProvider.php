<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\Models\Role;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // reject admin and normal user access
        Gate::define('isSuperAdmin', function($user){
            return $user->role_id === Role::SUPER_ADMIN;
        });

        // reject normal user access 
        Gate::define('notAuthor', function($user){
            return $user->Role->role != 'author';
        });


      /*   Gate::define('isAdmin', function($user){
            return ($user->role != 'normal')
                ? Response::allow()
                : Response::deny('You should be admin');2
        }); */
    }
}
