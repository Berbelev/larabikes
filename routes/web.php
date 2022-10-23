<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;   // include BikeController
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;

// atajo para editar la última moto creada (para el ejemplo de cookies)
Route::get('/bikes/editlast', [BikeController::class, 'editLast'])
        ->name('bikes.editlast');

// formulario para la busqueda de motos
//.FIXME:2 ¿deben de ir los parametros opcionales por la query string?
Route::get('/bikes/search/{marca?}/{modelo?}',[BikeController::class, 'search'])
        ->name('bikes.search');
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
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('portada');

/*
|==========================================================================
| Web Routes de BikeController
|==========================================================================
|   CRUD DE MOTOS
|
*/


Route::resource('bikes', BikeController::class);

// FORMULARIO de confirmación para la eliminación de una moto
Route::get('bikes/{bike}/delete', [BikeController::class , 'delete'])
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
Route::fallback([WelcomeController::class, 'index']);


/** TODO: Poner las rutas en chaché
 * .../larabikes$ php artisan route:cache
* Route cache cleared!
* Routes cached successfully!
*  .../larabikes$ php artisan rout:clear
* Route cache cleared!
 */
