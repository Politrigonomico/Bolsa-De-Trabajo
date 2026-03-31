<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InformeController;

// ============================================================================
// INICIO
// ============================================================================
Route::get('/', [IndexController::class, 'index'])->name('index');

// ============================================================================
// POSTULANTES
// ============================================================================
Route::prefix('postulantes')->name('postulantes.')->group(function () {
    Route::get('/',                          [PostulanteController::class, 'index'])->name('index');
    Route::get('/nuevo',                     [PostulanteController::class, 'create'])->name('create');
    Route::post('/nuevo',                    [PostulanteController::class, 'store'])->name('store');
    Route::put('/{id}',                      [PostulanteController::class, 'update'])->name('update');
    Route::delete('/{postulante}',           [PostulanteController::class, 'destroy'])->name('destroy');
    Route::get('/{postulante}/cv',           [PostulanteController::class, 'mostrarCV'])->name('cv.mostrar');
    Route::get('/{postulante}/cv/descargar', [PostulanteController::class, 'descargarCV'])->name('cv.descargar');
});

// Aliases legacy
Route::get('/postulante_nuevo',  [PostulanteController::class, 'create'])->name('postulante_nuevo');
Route::post('/postulante_nuevo', [PostulanteController::class, 'store'])->name('postulante.store');
Route::get('/busqueda',          [PostulanteController::class, 'index'])->name('busqueda');

// ============================================================================
// EMPRESAS
// ============================================================================
Route::prefix('empresas')->name('empresas.')->group(function () {
    Route::get('/',             [EmpresaController::class, 'index'])->name('index');
    Route::get('/nueva',        [EmpresaController::class, 'create'])->name('create');
    Route::post('/nueva',       [EmpresaController::class, 'store'])->name('store');
    Route::put('/{empresa}',    [EmpresaController::class, 'update'])->name('update');
    Route::delete('/{empresa}', [EmpresaController::class, 'destroy'])->name('destroy');
});

// Aliases legacy
Route::get('/empresa_nuevo',     [EmpresaController::class, 'create'])->name('empresa_nuevo');
Route::post('/empresa_nuevo',    [EmpresaController::class, 'store'])->name('empresa.store');
Route::get('/buscar_empresa',    [EmpresaController::class, 'index'])->name('buscar_empresa');
Route::put('/empresa/{empresa}', [EmpresaController::class, 'update'])->name('empresa.update');

// ============================================================================
// INFORMES
// ============================================================================
Route::prefix('informes')->name('informes.')->group(function () {
    Route::get('/',        [InformeController::class, 'index'])->name('index');
    Route::get('/filtrar', [InformeController::class, 'filtrar'])->name('filtrar');
    Route::get('/pdf',     [InformeController::class, 'pdf'])->name('pdf');
});

// ============================================================================
// CONFIGURACIÓN
// ============================================================================
Route::prefix('configuracion')->name('configuracion.')->group(function () {

    // Panel principal
    Route::get('/', [ConfiguracionController::class, 'index'])->name('index');

    // Rubros / Profesiones
    Route::get('/rubros',            [ConfiguracionController::class, 'rubrosIndex'])->name('rubros.index');
    Route::post('/rubros',           [ConfiguracionController::class, 'rubrosStore'])->name('rubros.store');
    Route::put('/rubros/{rubro}',    [ConfiguracionController::class, 'rubrosUpdate'])->name('rubros.update');
    Route::delete('/rubros/{rubro}', [ConfiguracionController::class, 'rubrosDestroy'])->name('rubros.destroy');

    // Carnets
    Route::get('/carnets',             [ConfiguracionController::class, 'carnetsIndex'])->name('carnets.index');
    Route::post('/carnets',            [ConfiguracionController::class, 'carnetsStore'])->name('carnets.store');
    Route::put('/carnets/{carnet}',    [ConfiguracionController::class, 'carnetsUpdate'])->name('carnets.update');
    Route::delete('/carnets/{carnet}', [ConfiguracionController::class, 'carnetsDestroy'])->name('carnets.destroy');

    // Localidades
    Route::get('/localidades',                [ConfiguracionController::class, 'localidadesIndex'])->name('localidades.index');
    Route::post('/localidades',               [ConfiguracionController::class, 'localidadesStore'])->name('localidades.store');
    Route::put('/localidades/{localidad}',    [ConfiguracionController::class, 'localidadesUpdate'])->name('localidades.update');
    Route::delete('/localidades/{localidad}', [ConfiguracionController::class, 'localidadesDestroy'])->name('localidades.destroy');

    // Exportar
    Route::get('/exportar/postulantes', [ConfiguracionController::class, 'exportarPostulantes'])->name('exportar.postulantes');
    Route::get('/exportar/empresas',    [ConfiguracionController::class, 'exportarEmpresas'])->name('exportar.empresas');
});



// ============================================================================
// BÚSQUEDA RÁPIDA (sidebar)
// ============================================================================
Route::get('/buscar', function (\Illuminate\Http\Request $request) {
    $query = $request->get('q');
    if (!$query) {
        return redirect()->route('index');
    }

    $postulantes = \App\Models\Postulante::where('nombre', 'like', "%{$query}%")
        ->orWhere('apellido', 'like', "%{$query}%")
        ->orWhere('dni', 'like', "%{$query}%")
        ->orWhere('email', 'like', "%{$query}%")
        ->limit(10)
        ->get();

    $empresas = \App\Models\Empresa::where('razon_social', 'like', "%{$query}%")
        ->orWhere('cuit', 'like', "%{$query}%")
        ->limit(10)
        ->get();

    return view('busqueda-rapida', compact('query', 'postulantes', 'empresas'));
})->name('buscar');

// ============================================================================
// FALLBACK
// ============================================================================
Route::fallback(function () {
    return redirect()->route('index')->with('error', 'Página no encontrada.');
});