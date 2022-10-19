<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;


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

        /**
         *| Mostrar la variable autor en todas las vistas
         *| con share() dela facada View
         */
         View::share('autor','Robert Sallent');

         /**
         *| Definición de un marco para las respuestas
         *|
         */

    }
}
