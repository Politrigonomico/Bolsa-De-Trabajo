<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EmpresaController;
use App\Models\Empresa;
use App\Models\RRHH;

// Página principal
Route::view('/', 'index')->name('index');
Route::view('/ingresos', 'ingresos')->name('ingresos');

// INTEGRACIÓN DE POSTULANTES
// Mostrar formulario para crear un nuevo postulante
Route::get('/postulante_nuevo', [PostulanteController::class, 'create'])
     ->name('postulante_nuevo');
// Guardar un postulante
Route::post('/postulante_nuevo', [PostulanteController::class, 'store'])
     ->name('postulante.store');
// Editar postulante
Route::get('/postulantes/{postulante}/edit', [PostulanteController::class, 'edit'])
     ->name('postulantes.edit');
// Actualizar postulante
Route::put('/postulantes/{id}', [PostulanteController::class, 'update'])
     ->name('postulantes.update');
// Eliminar postulante
Route::delete('/postulantes/{postulante}', [PostulanteController::class, 'destroy'])
     ->name('postulantes.destroy');
// Listado/búsqueda de postulantes
Route::get('/busqueda', [PostulanteController::class, 'index'])
     ->name('busqueda');

// CONFIGURACIÓN DE RUBROS (u otros datos)
Route::get('/configuracion', [ConfiguracionController::class, 'index'])
     ->name('configuracion');
// Formulario para agregar un nuevo rubro
Route::get('/configuracion/ingresar', [ConfiguracionController::class, 'create'])
     ->name('configuracion.create');
// Guardar rubro
Route::post('/configuracion/ingresar', [ConfiguracionController::class, 'store'])
     ->name('configuracion.store');


// ─── RUTAS PARA EMPRESAS ───────────────────────────────────────────────────────
// 1) Mostrar formulario para crear una empresa
Route::get('/empresa_nuevo', [EmpresaController::class, 'create'])
     ->name('empresa_nuevo');

// 2) Guardar la empresa (submit del formulario)
Route::post('/empresa_nuevo', [EmpresaController::class, 'store'])
     ->name('empresa.store');

// 3) Listar todas las empresas
//    (Esta ruta invoca el método index() y carga la vista buscar_empresa.blade.php)
$empresas = Empresa::with('rrhh')->get();
Route::get('/buscar_empresa', [EmpresaController::class, 'index'])
     ->name('buscar_empresa');

// 4) Editar una empresa
Route::put('/empresa/{empresa}', [EmpresaController::class, 'update'])
     ->name('empresa.update');

Route::get('/empresa/{empresa}/edit', [EmpresaController::class, 'edit'])
     ->name('empresa.edit');

