<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // set the file/style used by the paginator
        Paginator::useTailwind();
        // allow mass assignment for all models
        Model::unguard();
        // add an ability which can be used in the can middleware
        Gate::define('admin', function () {
            return auth()->user()?->username === 'basakest';
        });
        // add a custom admin blade conditional directive
        Blade::if('admin', function () {
            return auth()->user()?->username === 'basakest';
        });
    }
}
