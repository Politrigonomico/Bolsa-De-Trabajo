<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ConfiguracionController;

// Página principal
Route::view('/', 'index')->name('index');

// Vistas estáticas que sí siguen siendo estáticas
Route::view('/ingresos', 'ingresos')->name('ingresos');
Route::view('/empresa_nuevo', 'empresa_nuevo')->name('empresa_nuevo');

// Route::view('/postulante_nuevo', 'postulante_nuevo')->name('postulante_nuevo');

// Ahora redirigimos todo a tu controlador:
Route::get('/postulante_nuevo', [PostulanteController::class, 'create'])
     ->name('postulante_nuevo');

Route::post('/postulante_nuevo', [PostulanteController::class, 'store'])
     ->name('postulante.store');

// Búsqueda y listado de postulantes
Route::get('/busqueda', [PostulanteController::class, 'index'])->name('busqueda');

// Configuración de rubros…
Route::get('/configuracion', [ConfiguracionController::class, 'index'])
     ->name('configuracion');
Route::get('/configuracion/ingresar', [ConfiguracionController::class, 'create'])
     ->name('configuracion.create');
Route::post('/configuracion/ingresar', [ConfiguracionController::class, 'store'])
     ->name('configuracion.store');
