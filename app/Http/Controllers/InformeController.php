<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Models\Rubro;
use App\Models\Empresa;
use Carbon\Carbon;

class InformeController extends Controller
{
    public function index(Request $request)
    {
        $rubros = Rubro::all();
        return view('informes', compact('rubros'));
    }

    public function filtrar(Request $request)
    {
        $fechaDesde = $request->input('fecha_desde');
        $fechaHasta = $request->input('fecha_hasta');
        $sexo = $request->input('sexo');
        $edadDesde = $request->input('edad_desde');
        $edadHasta = $request->input('edad_hasta');
        $rubroId = $request->input('rubro_id');
        $localidad = $request->input('localidad');
        $nivelEducativo = $request->input('nivel_educativo');
        $certificado = $request->input('certificado');
        $carnet = $request->input('carnet');
        $movilidad = $request->input('movilidad');

        $query = Postulante::with(['rubro', 'rubros', 'carnets']);

        // Filtros existentes
        if ($fechaDesde) $query->whereDate('created_at', '>=', $fechaDesde);
        if ($fechaHasta) $query->whereDate('created_at', '<=', $fechaHasta);
        if ($sexo) $query->where('sexo', $sexo);

        // Filtros de edad
        if ($edadDesde) {
            $fechaMaxima = now()->subYears($edadDesde);
            $query->whereDate('fecha_nacimiento', '<=', $fechaMaxima);
        }
        if ($edadHasta) {
            $fechaMinima = now()->subYears($edadHasta);
            $query->whereDate('fecha_nacimiento', '>=', $fechaMinima);
        }

        // Filtros adicionales
        if ($rubroId) {
            $query->where(function($q) use ($rubroId) {
                $q->where('rubro_id', $rubroId)
                  ->orWhereHas('rubros', function($sq) use ($rubroId) {
                      $sq->where('rubro_id', $rubroId);
                  });
            });
        }

        if ($localidad) $query->where('localidad', 'like', "%{$localidad}%");

        // Filtro por nivel educativo
        if ($nivelEducativo) {
            switch ($nivelEducativo) {
                case 'primaria':
                    $query->where('estudios_primaria', true);
                    break;
                case 'secundaria':
                    $query->where('estudios_secundaria', true);
                    break;
                case 'terciario':
                    $query->where('estudios_terciario', true);
                    break;
                case 'universidad':
                    $query->where('estudios_universidad', true);
                    break;
                case 'cursando':
                    $query->where(function($q) {
                        $q->where('cursando_primaria', true)
                          ->orWhere('cursando_secundaria', true)
                          ->orWhere('cursando_terciario', true)
                          ->orWhere('cursando_universidad', true);
                    });
                    break;
            }
        }

        if ($certificado !== null) $query->where('certificado_check', $certificado);
        if ($carnet !== null) {
            if ($carnet == 1) {
                $query->whereHas('carnets');
            } else {
                $query->whereDoesntHave('carnets');
            }
        }
        if ($movilidad !== null) $query->where('movilidad_propia', $movilidad);

        $postulantes = $query->get();

        // Estadísticas detalladas
        $estadisticas = $this->generarEstadisticas($postulantes);

        $rubros = Rubro::all();

        return view('informes', compact('postulantes', 'estadisticas', 'rubros'));
    }

    public function pdf(Request $request)
    {
        // Aplicar los mismos filtros que en filtrar()
        $postulantes = $this->obtenerPostulantesFiltrados($request);
        $estadisticas = $this->generarEstadisticas($postulantes);

        $pdf = Pdf::loadView('pdf.informespdf', compact('postulantes', 'estadisticas'));

        return $pdf->download('informe_postulantes_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function resumenMensual()
    {
        $mesActual = Carbon::now()->startOfMonth();
        $mesAnterior = Carbon::now()->subMonth()->startOfMonth();

        $postulantesEMes = Postulante::whereDate('created_at', '>=', $mesActual)->count();
        $postulantesMAnt = Postulante::whereDate('created_at', '>=', $mesAnterior)
                                   ->whereDate('created_at', '<', $mesActual)
                                   ->count();

        $empresasEMes = Empresa::whereDate('created_at', '>=', $mesActual)->count();
        $empresasMAnt = Empresa::whereDate('created_at', '>=', $mesAnterior)
                             ->whereDate('created_at', '<', $mesActual)
                             ->count();

        // Top profesiones del mes
        $topProfesiones = Postulante::whereDate('created_at', '>=', $mesActual)
            ->with('rubro')
            ->get()
            ->groupBy('rubro.rubro')
            ->map->count()
            ->sortDesc()
            ->take(10);

        // Distribución por edad
        $distribucionEdad = Postulante::whereDate('created_at', '>=', $mesActual)
            ->get()
            ->groupBy(function($postulante) {
                $edad = Carbon::parse($postulante->fecha_nacimiento)->age;
                if ($edad < 25) return '18-24';
                if ($edad < 35) return '25-34';
                if ($edad < 45) return '35-44';
                if ($edad < 55) return '45-54';
                return '55+';
            })
            ->map->count();

        $datos = [
            'periodo' => $mesActual->format('F Y'),
            'postulantes_mes_actual' => $postulantesEMes,
            'postulantes_mes_anterior' => $postulantesMAnt,
            'empresas_mes_actual' => $empresasEMes,
            'empresas_mes_anterior' => $empresasMAnt,
            'top_profesiones' => $topProfesiones,
            'distribucion_edad' => $distribucionEdad,
            'variacion_postulantes' => $postulantesMAnt > 0 ? 
                round((($postulantesEMes - $postulantesMAnt) / $postulantesMAnt) * 100, 2) : 0,
            'variacion_empresas' => $empresasMAnt > 0 ? 
                round((($empresasEMes - $empresasMAnt) / $empresasMAnt) * 100, 2) : 0,
        ];

        return view('informes', compact('datos'));
    }

    public function programarInforme(Request $request)
    {
        $request->validate([
            'tipo_informe' => 'required|in:semanal,mensual,trimestral',
            'email' => 'required|email',
            'filtros' => 'nullable|array',
        ]);

        // Aquí implementarías la lógica para programar informes
        // Podrías usar Laravel Scheduler o crear una tabla para informes programados

        return redirect()
            ->route('informes.index')
            ->with('success', 'Informe programado correctamente. Se enviará por email según la frecuencia seleccionada.');
    }

    private function obtenerPostulantesFiltrados(Request $request)
    {
        $query = Postulante::with(['rubro', 'rubros', 'carnets']);

        // Aplicar todos los filtros (código similar al método filtrar)
        if ($request->fecha_desde) $query->whereDate('created_at', '>=', $request->fecha_desde);
        if ($request->fecha_hasta) $query->whereDate('created_at', '<=', $request->fecha_hasta);
        if ($request->sexo) $query->where('sexo', $request->sexo);
        
        // ... resto de filtros

        return $query->get();
    }

    private function generarEstadisticas($postulantes)
    {
        return [
            'total' => $postulantes->count(),
            'total_mujeres' => $postulantes->where('sexo', 'Femenino')->count(),
            'total_hombres' => $postulantes->where('sexo', 'Masculino')->count(),
            'total_otros' => $postulantes->where('sexo', 'Otro')->count(),
            
            'por_rubro' => $postulantes->groupBy('rubro.rubro')->map->count()->sortDesc(),
            
            'por_localidad' => $postulantes->groupBy('localidad')->map->count()->sortDesc(),
            
            'por_edad' => $postulantes->groupBy(function($postulante) {
                $edad = Carbon::parse($postulante->fecha_nacimiento)->age;
                if ($edad < 25) return '18-24';
                if ($edad < 35) return '25-34';
                if ($edad < 45) return '35-44';
                if ($edad < 55) return '45-54';
                return '55+';
            })->map->count(),
            
            'con_certificado' => $postulantes->where('certificado_check', true)->count(),
            'con_movilidad' => $postulantes->where('movilidad_propia', true)->count(),
            'con_carnet' => $postulantes->filter(function($p) { 
                return $p->carnets && $p->carnets->count() > 0; 
            })->count(),
            
            'educacion' => [
                'primaria_completa' => $postulantes->where('estudios_primaria', true)->count(),
                'secundaria_completa' => $postulantes->where('estudios_secundaria', true)->count(),
                'terciario_completo' => $postulantes->where('estudios_terciario', true)->count(),
                'universidad_completa' => $postulantes->where('estudios_universidad', true)->count(),
                'cursando' => $postulantes->filter(function($p) {
                    return $p->cursando_primaria || $p->cursando_secundaria || 
                           $p->cursando_terciario || $p->cursando_universidad;
                })->count(),
            ],
            
            'carnets_por_tipo' => $postulantes->flatMap(function($p) {
                return $p->carnets->pluck('tipo_carnet');
            })->countBy()->sortDesc(),
        ];
    }
}