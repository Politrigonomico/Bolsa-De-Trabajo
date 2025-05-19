<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostulanteController;

// Página principal
Route::view('/', 'index')->name('index');

Route::view('/postulante_nuevo', 'postulante_nuevo')->name('postulante_nuevo');

// Vistas estáticas
Route::view('/ingresos', 'ingresos')->name('ingresos');
Route::view('/postulante', 'postulante')->name('postulante');
Route::view('/empresa', 'empresa')->name('empresa');

// Carga y guardado de postulantes
Route::get('/postulantes', [PostulanteController::class, 'create'])->name('postulante.create');
Route::post('/postulantes', [PostulanteController::class, 'store'])->name('postulante.store');


// Búsqueda y listado de postulantes
Route::get('/busqueda', [PostulanteController::class, 'index'])->name('busqueda');


