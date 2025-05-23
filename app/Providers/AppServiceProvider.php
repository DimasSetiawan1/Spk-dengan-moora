<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
// use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
// use Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\Barryvdh\DomPDF\ServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void


    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        /**
         * ROLE
         */
        Gate::define('superadmin', function (User $user) {
            return $user->role === 'superadmin'
                ? Response::allow()
                : Response::deny('You must be a super administrator.');
        });

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin' || $user->role === 'superadmin'
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });
    }
}
