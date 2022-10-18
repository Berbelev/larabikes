<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;   // include BikeController
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;

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
    ->name('bikes.delete');


/*
|==========================================================================
|  RUTA DE FALLBACK (debe ser la ultima en el fichero)
|==========================================================================
*/
Route::fallback([WelcomeController::class, 'index']);


