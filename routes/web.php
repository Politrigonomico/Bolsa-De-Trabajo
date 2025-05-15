<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostulanteController;


// Página principal usa index.blade.php
Route::view('/', 'index') ->name('index');
Route::view('/busqueda', 'busqueda') ->name('busqueda');

// Vista de Ingresos
Route::view('/ingresos', 'ingresos')->name('ingresos');

// Vista de Postulante
Route::view('/postulante', 'postulante')->name('postulante');

// Vista de Empresa
Route::view('/empresa', 'empresa')->name('empresa');

// Vista de Postulantes
Route::view('/postulantes', 'postulante_nuevo')->name('postulante_nuevo');
Route::post('/postulantes', [PostulanteController::class, 'store']) -> name('postulante.store');
