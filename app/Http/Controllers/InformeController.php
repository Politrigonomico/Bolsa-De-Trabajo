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
        $rubros = Rubro::orderBy('rubro')->get();
        return view('informes', compact('rubros'));
    }

    public function filtrar(Request $request)
    {
        $postulantes = $this->aplicarFiltros($request);
        $estadisticas = $this->generarEstadisticas($postulantes);
        $rubros = Rubro::orderBy('rubro')->get();

        return view('informes', compact('postulantes', 'estadisticas', 'rubros'));
    }

    public function pdf(Request $request)
    {
        $postulantes  = $this->aplicarFiltros($request);
        $estadisticas = $this->generarEstadisticas($postulantes);

        $pdf = Pdf::loadView('pdf.informespdf', compact('postulantes', 'estadisticas'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('informe_postulantes_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    // =========================================================================
    // Lógica de filtros — un único lugar, usado por filtrar() y pdf()
    // =========================================================================
    private function aplicarFiltros(Request $request)
    {
        $query = Postulante::with(['rubro', 'rubros', 'carnets']);

        // Fechas de registro
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        // Sexo
        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }

        // Rango de edad
        if ($request->filled('edad_desde')) {
            $fechaMaxima = now()->subYears((int) $request->edad_desde);
            $query->whereDate('fecha_nacimiento', '<=', $fechaMaxima);
        }
        if ($request->filled('edad_hasta')) {
            $fechaMinima = now()->subYears((int) $request->edad_hasta);
            $query->whereDate('fecha_nacimiento', '>=', $fechaMinima);
        }

        // Rubro / profesión
        if ($request->filled('rubro_id')) {
            $rubroId = $request->rubro_id;
            $query->where(function ($q) use ($rubroId) {
                $q->where('rubro_id', $rubroId)
                  ->orWhereHas('rubros', function ($sq) use ($rubroId) {
                      $sq->where('rubro_id', $rubroId);
                  });
            });
        }

        // Localidad
        if ($request->filled('localidad')) {
            $query->where('localidad', 'like', '%' . $request->localidad . '%');
        }

        // Nivel educativo
        if ($request->filled('nivel_educativo')) {
            switch ($request->nivel_educativo) {
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
                    $query->where(function ($q) {
                        $q->where('cursando_primaria', true)
                          ->orWhere('cursando_secundaria', true)
                          ->orWhere('cursando_terciario', true)
                          ->orWhere('cursando_universidad', true);
                    });
                    break;
            }
        }

        // Certificado de manipulación
        if ($request->filled('certificado')) {
            $query->where('certificado_check', $request->certificado);
        }

        // Carnet de conducir
        if ($request->filled('carnet')) {
            if ($request->carnet == 1) {
                $query->whereHas('carnets');
            } else {
                $query->whereDoesntHave('carnets');
            }
        }

        // Movilidad propia
        if ($request->filled('movilidad')) {
            $query->where('movilidad_propia', $request->movilidad);
        }

        return $query->orderBy('apellido')->get();
    }

    // =========================================================================
    // Estadísticas — recibe la colección ya filtrada
    // =========================================================================
    private function generarEstadisticas($postulantes)
    {
        return [
            'total'          => $postulantes->count(),
            'total_mujeres'  => $postulantes->where('sexo', 'Femenino')->count(),
            'total_hombres'  => $postulantes->where('sexo', 'Masculino')->count(),
            'total_otros'    => $postulantes->where('sexo', 'Otro')->count(),

            'por_rubro' => $postulantes
                ->groupBy(fn($p) => optional($p->rubro)->rubro ?? 'Sin especificar')
                ->map->count()
                ->sortDesc(),

            'por_localidad' => $postulantes
                ->groupBy('localidad')
                ->map->count()
                ->sortDesc(),

            'por_edad' => $postulantes
                ->groupBy(function ($p) {
                    $edad = Carbon::parse($p->fecha_nacimiento)->age;
                    if ($edad < 25) return '18-24';
                    if ($edad < 35) return '25-34';
                    if ($edad < 45) return '35-44';
                    if ($edad < 55) return '45-54';
                    return '55+';
                })
                ->map->count(),

            'con_certificado' => $postulantes->where('certificado_check', true)->count(),
            'con_movilidad'   => $postulantes->where('movilidad_propia', true)->count(),
            'con_carnet'      => $postulantes->filter(fn($p) => $p->carnets && $p->carnets->count() > 0)->count(),

            'educacion' => [
                'primaria_completa'    => $postulantes->where('estudios_primaria', true)->count(),
                'secundaria_completa'  => $postulantes->where('estudios_secundaria', true)->count(),
                'terciario_completo'   => $postulantes->where('estudios_terciario', true)->count(),
                'universidad_completa' => $postulantes->where('estudios_universidad', true)->count(),
                'cursando'             => $postulantes->filter(fn($p) =>
                    $p->cursando_primaria || $p->cursando_secundaria ||
                    $p->cursando_terciario || $p->cursando_universidad
                )->count(),
            ],

            'carnets_por_tipo' => $postulantes
                ->flatMap(fn($p) => $p->carnets->pluck('tipo_carnet'))
                ->countBy()
                ->sortDesc(),
        ];
    }
}