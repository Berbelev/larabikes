<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\BikeComposer;

class ComposerServiceProvider extends ServiceProvider{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()    {
        // Vincula el ViewComposer a la vista de listado
        View::composer('*', BikeComposer::class);
    }
}
