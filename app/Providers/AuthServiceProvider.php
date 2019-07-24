<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('RH',function($user){
            return $user->role == 2;
        });

        Gate::define('ADMIN',function($user){
            return $user->role == 0;
        });

        Gate::define('COMUM',function($user){
            return $user->role == 1;
        });

        Gate::before(function ($user) {
            if ($user->role == User::ROLE_ADMIN ) {
                return true;
            }
        });
    }
}
