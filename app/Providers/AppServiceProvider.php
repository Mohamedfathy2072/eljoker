<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use App\Interfaces\SavedSearchInterface;
use App\Repositories\SavedSearchRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\CarRepositoryInterface::class,
            \App\Repositories\CarRepository::class
        );

        $this->app->bind(
            \App\Interfaces\SavedSearchInterface::class,
            \App\Repositories\SavedSearchRepository::class
        );


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
        Schema::defaultStringLength(191);
    }
}
