<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\TeatroController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('festival', FestivalController::class);
Route::resource('sala', SalaController::class);
Route::resource('teatro', TeatroController::class);
Route::resource('pelicula', PeliculaController::class);
Route::resource('boleta', BoletaController::class);
Route::resource('horario', HorarioController::class);
Route::resource('cliente', ClienteController::class);


/* asignación */
Route::post('/festival/teatro', [FestivalController::class, 'sincronizarFestivalTeatro']);
Route::post('/pelicula/horario', [HorarioController::class, 'sincronizarHorarioPelicula']);
Route::post('/pelicula/salas', [PeliculaController::class, 'sincronizarPeliculaSala']);
