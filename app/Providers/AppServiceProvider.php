<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });
            \App\Models\User::saved(fn () => \Artisan::call('permission:cache-reset'));
        \Spatie\Permission\Models\Role::saved(fn () => \Artisan::call('permission:cache-reset'));
        }
}
