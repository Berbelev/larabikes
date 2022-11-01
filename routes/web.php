<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\BikeController;   // include BikeController
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Support\Facades\Auth;


/*
|==========================================================================
| Web Routes
|==========================================================================
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
/*==========================================================================
| Autenticación
*///==========================================================================
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*==========================================================================
| WelcomeControler Web Routes
|==========================================================================
| (Portada)
|   Single action Controler __invoke()
*/

Route::get('/', WelcomeController::class)->name('portada');



/*==========================================================================
| BikeControler Web Routes
|==========================================================================
|   CRUD
*/

// ATAJO para EDITAR la ÚLTIMA moto creada(para el ejemplo de cookies)
Route::get('/bikes/editlast', [BikeController::class, 'editLast'])
        ->name('bikes.editlast');

// FORMULARIO para BUSQUEDA de motos
// buscar motos por marca(obligatorio) y modelo (opcional)
Route::match(['GET','POST'], '/motos/buscar',
                            [BikeController::class, 'search'])
        ->name('bikes.search');
/*
//FIXME:2 mostrar la query string de forma amigable
Route::get('/bikes/search/{marca?}/{modelo?}',[BikeController::class, 'search'])
        ->name('bikes.search');
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

// FORMULARIO de CONFIRMACIÓN para la ELIMINACIÓN de una moto
Route::get('motos/{bike}/borrar', [BikeController::class , 'delete'])
    ->name('bikes.delete')
    ->middleware('throttle:3,1');

// ELIMINACIÓN DEFINITIVA DE LA MOTO
// va por DELETE
Route::delete('/bikes/purge', [BikeController::class,'purge'])
    ->name('bikes.purge');

// RESTAURACIÓN DE LA MOTO
Route::get('/bikes/{bike}/restore', [BikeController::class,'restore'])
    ->name('bikes.restore');


/*==========================================================================
| ContactoController Web Routes
|==========================================================================
|   index() muestra formulario
|   send() recibe datos y envía mail
*/
// RUTA PRA EL FORUMUARIO DE CONTACTO
Route::get('/contacto',[ContactoController::class, 'index'])
->name('contacto');

// RUTA PARA EL ENVÍO DEL EMAIL DE CONTACTO
Route::post('/contacto',[ContactoController::class, 'send'])
->name('contacto.mail');


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


