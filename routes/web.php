<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Página principal usa index.blade.php
Route::view('/', 'index')->name('home');

// Vista de Ingresos
Route::view('/ingresos', 'ingresos')->name('ingresos');

// Vista de Postulante
Route::view('/postulante', 'postulante')->name('postulante');