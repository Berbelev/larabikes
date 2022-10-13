<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()    {
        // indacar que usamos bootstrap para el paginador
        Paginator::useBootstrap();
    }
}
