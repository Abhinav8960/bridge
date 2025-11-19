<?php

namespace App\Providers;

use App\Models\Backend\Packages;

use App\Models\Institute;
use App\Models\Institute\Information\Center;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Blade::if('student', function () {
            return Auth::guard('students')->check();
        });

        Blade::if('isAuthenticated', function () {
            return Auth::check() || Auth::guard('students')->check();
        });

        Gate::define('admin', function ($user) {
            if (Auth::check()) {
                if (Auth::User()->role_id == User::ROLE_ADMIN) {
                    return true;
                }
            }
            return false;
        });




    }
}
