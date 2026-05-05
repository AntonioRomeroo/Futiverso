<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JerseyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('inicio');

// Ruta para novedades (mantiene su vista propia con carruseles)
Route::get('/novedades', function () {
    return view('novedades');
})->name('novedades');

// RUTA DINÁMICA: Esta ruta maneja todas las categorías (laliga, premier, espana, etc.)
// Se coloca al final para que no interfiera con otras posibles rutas fijas.
Route::get('/{slug}', [JerseyController::class, 'show'])->name('categoria');