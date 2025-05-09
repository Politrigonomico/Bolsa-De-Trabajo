<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Página principal usa index.blade.php
Route::view('/', 'index')->name('home');

Route::view('/ingresos', 'ingresos')->name('ingresos');

