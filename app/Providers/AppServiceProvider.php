<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\AccountRepository::class,
            \App\Repositories\AccountRepository::class,
        );

        $this->app->bind(
            \App\Services\Contracts\AccountService::class,
            \App\Services\AccountService::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
