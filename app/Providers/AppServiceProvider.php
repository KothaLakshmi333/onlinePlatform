<?php

namespace App\Providers;
use Illuminate\Routing\Router;  
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

}
