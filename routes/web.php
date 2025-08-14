<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InformeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



// Página principal
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::view('/ingresos', 'ingresos')->name('ingresos');

// ============================================================================
// POSTULANTES - CRUD COMPLETO
// ============================================================================
Route::prefix('postulantes')->name('postulantes.')->group(function () {
    // Listado y búsqueda
    Route::get('/busqueda', [PostulanteController::class, 'index'])->name('index');
    
    // Crear nuevo postulante
    Route::get('/nuevo', [PostulanteController::class, 'create'])->name('create');
    Route::post('/nuevo', [PostulanteController::class, 'store'])->name('store');
    
    // Ver, editar y eliminar postulante
    Route::get('/{postulante}/edit', [PostulanteController::class, 'edit'])->name('edit');
    Route::put('/{postulante}', [PostulanteController::class, 'update'])->name('update');
    Route::delete('/{postulante}', [PostulanteController::class, 'destroy'])->name('destroy');
    
    // CV - Ver y descargar
    Route::get('/{postulante}/cv', [PostulanteController::class, 'mostrarCV'])->name('cv.mostrar');
    Route::get('/{postulante}/cv/descargar', [PostulanteController::class, 'descargarCV'])->name('cv.descargar');
});

// Rutas legacy (mantener compatibilidad)
Route::get('/postulante_nuevo', [PostulanteController::class, 'create'])->name('postulante_nuevo');
Route::post('/postulante_nuevo', [PostulanteController::class, 'store'])->name('postulante.store');
Route::get('/busqueda', [PostulanteController::class, 'index'])->name('busqueda');
Route::put('/postulantes/{id}', [PostulanteController::class, 'update'])->name('postulantes.update');

// ============================================================================
// EMPRESAS - CRUD COMPLETO
// ============================================================================
Route::prefix('empresas')->name('empresas.')->group(function () {
    // Listado
    Route::get('/', [EmpresaController::class, 'index'])->name('index');
    
    // Crear nueva empresa
    Route::get('/nueva', [EmpresaController::class, 'create'])->name('create');
    Route::post('/nueva', [EmpresaController::class, 'store'])->name('store');
    
    // Editar y actualizar empresa
    Route::get('/{empresa}/edit', [EmpresaController::class, 'edit'])->name('edit');
    Route::put('/{empresa}', [EmpresaController::class, 'update'])->name('update');
    Route::delete('/{empresa}', [EmpresaController::class, 'destroy'])->name('destroy');
});

// Rutas legacy para empresas
Route::get('/empresa_nuevo', [EmpresaController::class, 'create'])->name('empresa_nuevo');
Route::post('/empresa_nuevo', [EmpresaController::class, 'store'])->name('empresa.store');
Route::get('/buscar_empresa', [EmpresaController::class, 'index'])->name('buscar_empresa');
Route::put('/empresa/{empresa}', [EmpresaController::class, 'update'])->name('empresa.update');

// ============================================================================
// INFORMES AVANZADOS
// ============================================================================
Route::prefix('informes')->name('informes.')->group(function () {
    // Vista principal de informes
    Route::get('/', [InformeController::class, 'index'])->name('index');
    
    // Generar informes con filtros
    Route::get('/filtrar', [InformeController::class, 'filtrar'])->name('filtrar');
    
    // Exportar informes
    Route::get('/pdf', [InformeController::class, 'pdf'])->name('pdf');
    Route::get('/excel', [InformeController::class, 'excel'])->name('excel');
    
    // Informes especiales
    Route::get('/resumen-mensual', [InformeController::class, 'resumenMensual'])->name('resumen-mensual');
    Route::get('/comparativo', [InformeController::class, 'comparativo'])->name('comparativo');
    
    // Programar informes automáticos
    Route::post('/programar', [InformeController::class, 'programarInforme'])->name('programar');
    Route::get('/programados', [InformeController::class, 'informesProgramados'])->name('programados');
    Route::delete('/programados/{id}', [InformeController::class, 'cancelarInforme'])->name('cancelar');
});

// ============================================================================
// CONFIGURACIÓN Y ADMINISTRACIÓN
// ============================================================================
Route::prefix('configuracion')->name('configuracion.')->group(function () {
    // Panel principal de configuración
    Route::get('/', [ConfiguracionController::class, 'index'])->name('index');
    
    // Gestión de rubros/profesiones
    Route::get('/rubros', [ConfiguracionController::class, 'rubros'])->name('rubros.index');
    Route::get('/rubros/crear', [ConfiguracionController::class, 'create'])->name('create');
    Route::post('/rubros/crear', [ConfiguracionController::class, 'store'])->name('store');
    Route::put('/rubros/{rubro}', [ConfiguracionController::class, 'updateRubro'])->name('rubros.update');
    Route::delete('/rubros/{rubro}', [ConfiguracionController::class, 'deleteRubro'])->name('rubros.delete');
    
    // Gestión de carnets
    Route::get('/carnets', [ConfiguracionController::class, 'carnets'])->name('carnets.index');
    Route::post('/carnets', [ConfiguracionController::class, 'storeCarnet'])->name('carnets.store');
    Route::put('/carnets/{carnet}', [ConfiguracionController::class, 'updateCarnet'])->name('carnets.update');
    Route::delete('/carnets/{carnet}', [ConfiguracionController::class, 'deleteCarnet'])->name('carnets.delete');
    
    // Gestión de localidades
    Route::get('/localidades', [ConfiguracionController::class, 'localidades'])->name('localidades.index');
    Route::post('/localidades', [ConfiguracionController::class, 'storeLocalidad'])->name('localidades.store');
    Route::put('/localidades/{localidad}', [ConfiguracionController::class, 'updateLocalidad'])->name('localidades.update');
    Route::delete('/localidades/{localidad}', [ConfiguracionController::class, 'deleteLocalidad'])->name('localidades.delete');
    
    // Backup y mantenimiento
    Route::get('/backup', [ConfiguracionController::class, 'backup'])->name('backup.index');
    Route::post('/backup/crear', [ConfiguracionController::class, 'crearBackup'])->name('backup.crear');
    Route::get('/backup/descargar/{archivo}', [ConfiguracionController::class, 'descargarBackup'])->name('backup.descargar');
    Route::delete('/backup/{archivo}', [ConfiguracionController::class, 'eliminarBackup'])->name('backup.eliminar');
    
    // Importar/Exportar datos
    Route::get('/importar', [ConfiguracionController::class, 'importar'])->name('importar');
    Route::post('/importar/postulantes', [ConfiguracionController::class, 'importarPostulantes'])->name('importar.postulantes');
    Route::post('/importar/empresas', [ConfiguracionController::class, 'importarEmpresas'])->name('importar.empresas');
    Route::get('/exportar/todo', [ConfiguracionController::class, 'exportarTodo'])->name('exportar.todo');
});

// Rutas legacy para configuración
Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion');
Route::get('/configuracion/ingresar', [ConfiguracionController::class, 'create'])->name('configuracion.create');
Route::post('/configuracion/ingresar', [ConfiguracionController::class, 'store'])->name('configuracion.store');

// ============================================================================
// API ENDPOINTS (para funcionalidades AJAX)
// ============================================================================
Route::prefix('api')->name('api.')->group(function () {
    // Búsquedas dinámicas
    Route::get('/postulantes/buscar', [PostulanteController::class, 'buscarAPI'])->name('postulantes.buscar');
    Route::get('/empresas/buscar', [EmpresaController::class, 'buscarAPI'])->name('empresas.buscar');
    
    // Autocompletar
    Route::get('/rubros/buscar', [ConfiguracionController::class, 'buscarRubros'])->name('rubros.buscar');
    Route::get('/localidades/buscar', [ConfiguracionController::class, 'buscarLocalidades'])->name('localidades.buscar');
    
    // Estadísticas rápidas
    Route::get('/estadisticas/dashboard', [IndexController::class, 'estadisticasAPI'])->name('estadisticas.dashboard');
    Route::get('/estadisticas/graficos', [InformeController::class, 'datosGraficos'])->name('estadisticas.graficos');
    
    // Validaciones
    Route::post('/validar/dni', [PostulanteController::class, 'validarDNI'])->name('validar.dni');
    Route::post('/validar/email', [PostulanteController::class, 'validarEmail'])->name('validar.email');
    Route::post('/validar/cuit', [EmpresaController::class, 'validarCUIT'])->name('validar.cuit');
});

// ============================================================================
// COMANDOS Y UTILIDADES
// ============================================================================
Route::prefix('utilidades')->name('utilidades.')->middleware(['auth'])->group(function () {
    // Panel de mantenimiento (solo para administradores)
     Route::get('/utilidades/mantenimiento', function () {
     return view('configuracion_ingresar'); // o 'configuracion' si esa fuera la correcta
     })->name('utilidades.mantenimiento');

    
    // Ejecutar migraciones y seeders
    Route::post('/migrar', function () {
        Artisan::call('migrate', ['--force' => true]);
        return back()->with('success', 'Migraciones ejecutadas correctamente.');
    })->name('migrar');
    
    Route::post('/seed', function () {
        Artisan::call('db:seed', ['--force' => true]);
        return back()->with('success', 'Datos de prueba cargados correctamente.');
    })->name('seed');
    
    // Limpiar cachés
    Route::post('/limpiar-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return back()->with('success', 'Cachés limpiados correctamente.');
    })->name('limpiar-cache');
    
    // Optimizar aplicación
    Route::post('/optimizar', function () {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
        return back()->with('success', 'Aplicación optimizada correctamente.');
    })->name('optimizar');
});

// ============================================================================
// RUTAS DE DESARROLLO (solo en modo debug)
// ============================================================================
if (config('app.debug')) {
    Route::prefix('dev')->name('dev.')->group(function () {
        // Generar datos de prueba
        Route::get('/generar-postulantes/{cantidad?}', function ($cantidad = 50) {
            Artisan::call('db:seed', [
                '--class' => 'PostulantesTableSeeder',
                '--force' => true
            ]);
            return redirect()->route('busqueda')->with('success', "Se generaron {$cantidad} postulantes de prueba.");
        })->name('generar-postulantes');
        
        Route::get('/generar-empresas/{cantidad?}', function ($cantidad = 20) {
            Artisan::call('db:seed', [
                '--class' => 'EmpresasSeeder', 
                '--force' => true
            ]);
            return redirect()->route('buscar_empresa')->with('success', "Se generaron {$cantidad} empresas de prueba.");
        })->name('generar-empresas');
        
        // Limpiar todos los datos
        Route::post('/limpiar-datos', function () {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('postulantes')->truncate();
            DB::table('empresas')->truncate(); 
            DB::table('rrhhs')->truncate();
            DB::table('postulante_rubro')->truncate();
            DB::table('postulante_carnet')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            // Limpiar archivos
            Storage::disk('public')->deleteDirectory('cvs');
            Storage::disk('public')->deleteDirectory('fotos');
            Storage::disk('public')->makeDirectory('cvs');
            Storage::disk('public')->makeDirectory('fotos');
            
            return back()->with('success', 'Todos los datos fueron eliminados correctamente.');
        })->name('limpiar-datos');
        
        // Ver información del sistema
        Route::get('/info', function () {
            return view('dev.info', [
                'php_version' => PHP_VERSION,
                'laravel_version' => app()->version(),
                'database' => config('database.default'),
                'queue' => config('queue.default'),
                'cache' => config('cache.default'),
                'mail' => config('mail.default'),
                'storage' => config('filesystems.default'),
                'debug' => config('app.debug'),
                'env' => config('app.env'),
            ]);
        })->name('info');
    });
}

// ============================================================================
// WEBHOOKS Y INTEGRACIONES EXTERNAS
// ============================================================================
Route::prefix('webhooks')->name('webhooks.')->group(function () {
    // Webhook para recibir postulantes desde formularios externos
    Route::post('/postulante-externo', [PostulanteController::class, 'recibirPostulanteExterno'])
          ->name('postulante-externo');
    
    // Webhook para recibir empresas desde integraciones
    Route::post('/empresa-externa', [EmpresaController::class, 'recibirEmpresaExterna'])
          ->name('empresa-externa');
    
    // Notificaciones de backup
    Route::post('/backup-status', function (\Illuminate\Http\Request $request) {
        Log::info('Backup status received', $request->all());
        return response()->json(['status' => 'received']);
    })->name('backup-status');
});

// ============================================================================
// REDIRECCIONES Y RUTAS DE ACCESO RÁPIDO
// ============================================================================
// Página de estadísticas rápidas
Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');

// Búsqueda rápida
Route::get('/buscar', function (\Illuminate\Http\Request $request) {
    $query = $request->get('q');
    if (!$query) {
        return redirect()->route('index');
    }
    
    // Buscar en postulantes
    $postulantes = \App\Models\Postulante::where('nombre', 'like', "%{$query}%")
                                        ->orWhere('apellido', 'like', "%{$query}%")
                                        ->orWhere('dni', 'like', "%{$query}%")
                                        ->orWhere('email', 'like', "%{$query}%")
                                        ->limit(10)
                                        ->get();
    
    // Buscar en empresas
    $empresas = \App\Models\Empresa::where('razon_social', 'like', "%{$query}%")
                                  ->orWhere('cuit', 'like', "%{$query}%")
                                  ->limit(10)
                                  ->get();
    
    return view('busqueda-rapida', compact('query', 'postulantes', 'empresas'));
})->name('buscar');

// Exportaciones rápidas
Route::get('/exportar/postulantes-excel', [PostulanteController::class, 'exportarExcel'])->name('exportar.postulantes-excel');
Route::get('/exportar/empresas-excel', [EmpresaController::class, 'exportarExcel'])->name('exportar.empresas-excel');

// Fallback para rutas no encontradas dentro de la aplicación
Route::fallback(function () {
    return redirect()->route('index')->with('error', 'Página no encontrada. Redirigido al inicio.');
});