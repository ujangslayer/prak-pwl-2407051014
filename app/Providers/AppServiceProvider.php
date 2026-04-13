<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
      protected $policies = [
      ] ;
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      
        Gate::define('view-users', function ($user) {
            return $user->hasRole('dosen');
        });
        Gate::define('create-users', function ($user) {
            return $user->hasRole('dosen');
        });
        Gate::define('update-users', function ($user) {
            return $user->hasRole('dosen');
        });
        Gate::define('delete-users', function ($user) {
            return $user->hasRole('dosen');});
    }
}
