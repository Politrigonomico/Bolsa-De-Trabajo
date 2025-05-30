<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EmpresaController;

// Página principal
Route::view('/', 'index')->name('index');

// Vistas estáticas que sí siguen siendo estáticas
Route::view('/ingresos', 'ingresos')->name('ingresos');
// Route::view('/postulante_nuevo', 'postulante_nuevo')->name('postulante_nuevo');

// Ahora redirigimos todo a tu controlador:
Route::get('/postulante_nuevo', [PostulanteController::class, 'create'])
     ->name('postulante_nuevo');

Route::post('/postulante_nuevo', [PostulanteController::class, 'store'])
     ->name('postulante.store');

Route::put('/postulantes/{id}', [PostulanteController::class, 'update'])->name('postulantes.update');
Route::get('/postulantes/{postulante}/edit', [PostulanteController::class, 'edit'])->name('postulantes.edit');
Route::delete('/postulantes/{postulante}', [PostulanteController::class, 'destroy'])->name('postulantes.destroy');

// Búsqueda y listado de postulantes
Route::get('/busqueda', [PostulanteController::class, 'index'])->name('busqueda');

// Configuración de rubros…
Route::get('/configuracion', [ConfiguracionController::class, 'index'])
     ->name('configuracion');
Route::get('/configuracion/ingresar', [ConfiguracionController::class, 'create'])
     ->name('configuracion.create');
Route::post('/configuracion/ingresar', [ConfiguracionController::class, 'store'])
     ->name('configuracion.store');

// Rutas para la gestión de empresas
Route::view('empresa_nuevo', 'empresa_nuevo')->name('empresa_nuevo');

Route::get('empresas/create', [EmpresaController::class, 'create'])
    ->name('empresas.create');

Route::post('empresas', [EmpresaController::class, 'store'])
    ->name('empresas.store');

Route::get('empresas', [EmpresaController::class, 'index'])
    ->name('empresas.index');