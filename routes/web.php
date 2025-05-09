<?php

use Illuminate\Support\Facades\Route;


// Página principal usa index.blade.php
Route::view('/', 'index') ->name('index');

// Vista de Ingresos
Route::view('/ingresos', 'ingresos')->name('ingresos');

// Vista de Postulante
Route::view('/postulante', 'postulante')->name('postulante');