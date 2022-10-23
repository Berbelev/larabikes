<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\BikeController;   // include BikeController
use App\Http\Controllers\WelcomeController;


/*
|==========================================================================
| Web Routes
|==========================================================================
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| (Portada)
|   Single action Controler __invoke()
*/

Route::get('/', WelcomeController::class)->name('portada');

// ATAJO PARA EDITAR LA ÚLTIMA MOTO CREADA (para el ejemplo de cookies)
Route::get('/bikes/editlast', [BikeController::class, 'editLast'])
        ->name('bikes.editlast');

// FORMULARIO PARA BUSQUEDA DE MOTOS
// buscar motos por marca(obligatorio) y modelo (opcional)
Route::match(['GET','POST'], '/motos/buscar',
                            [BikeController::class, 'search'])
        ->name('bikes.search');
/*
//FIXME:2 mostrar la query string de forma amigable
Route::get('/bikes/search/{marca?}/{modelo?}',[BikeController::class, 'search'])
        ->name('bikes.search');
*/

/*==========================================================================
| Web Routes de BikeController
|==========================================================================
|   CRUD
*/

Route::resource('/motos', BikeController::class)
    ->names([
        'show'=>'bikes.show',
        'index'=>'bikes.index',
        'create'=>'bikes.create',
        'store'=>'bikes.store',
        'edit'=>'bikes.edit',
        'update'=>'bikes.update',
        'destroy'=>'bikes.destroy'])
    ->parameters(['motos'=>'bike']);
/*
// VARIOS RESURCES CONTROLLER:
Route::resources([
    '/bikes'=> BikeController::class,
    '/shops'=> ShopController::class
]);
*/

// FORMULARIO de confirmación para la eliminación de una moto
Route::get('motos/{bike}/borrar', [BikeController::class , 'delete'])
    ->name('bikes.delete')
    ->middleware('throttle:3,1');


/*
|==========================================================================
|  ZONA PARA PRUEBAS
|==========================================================================
*/

// FIN DE LA ZONA DE PRUEBAS

/*
|==========================================================================
|  RUTA DE FALLBACK (debe ser la ultima en el fichero)
|==========================================================================
*/
Route::fallback(WelcomeController::class);


/** TODO: Poner las rutas en chaché =======================================
 * .../larabikes$ php artisan route:cache
* Route cache cleared!
* Routes cached successfully!
*  .../larabikes$ php artisan rout:clear
* Route cache cleared!
 */
