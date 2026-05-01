<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

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

        Inertia::share([
        'app' => function () {
            return [
                'logo' => setting('logo')
                    ? asset('storage/' . setting('logo'))
                    : asset('images/logo.png'),

                'favicon' => setting('favicon')
                    ? asset('storage/' . setting('favicon'))
                    : asset('images/favicon.ico'),
            ];
        }
    ]);
    }
}
