<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;   // include BikeController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
| (Portada)
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Web Routes de BikeController
|--------------------------------------------------------------------------
|   CRUD DE MOTOS
|
*/
Route::resource('bikes', BikeController::class);

// confirmación eliminación de moto
Route::get('bikes/{bike}/delete', [BikeController::class , 'delete'])
    ->name('bikes.delete');
