<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


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
         *| Definición de un macro para las respuestas
         *|
         */
        Response::macro('mayusculas', function($datos){
            return Response::make(strtoupper($datos));
        });

        /**
         *| Personalizacion de las rutas a castellano:
         *|
         */
        Route::resourceVerbs([
            'create'=>'crear',
            'edit'=>'editar'
        ]);

    }
}
