<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Models\Rubro;

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

        $query = Postulante::with('rubro');

        if ($fechaDesde) $query->whereDate('created_at', '>=', $fechaDesde);
        if ($fechaHasta) $query->whereDate('created_at', '<=', $fechaHasta);
        if ($sexo) $query->where('sexo', $sexo);
        if ($edadDesde) {
            $fechaMaxima = now()->subYears($edadDesde);
            $query->whereDate('fecha_nacimiento', '<=', $fechaMaxima);
        }
        if ($edadHasta) {
            $fechaMinima = now()->subYears($edadHasta);
            $query->whereDate('fecha_nacimiento', '>=', $fechaMinima);
        }
        if ($rubroId) $query->where('rubro_id', $rubroId);

        $postulantes = $query->get();

        $total_mujeres = $postulantes->where('sexo', 'mujer')->count();
        $total_hombres = $postulantes->where('sexo', 'hombre')->count();
        $porRubro = $postulantes->groupBy('rubro.rubro')->map->count();

        $rubros = Rubro::all();

        return view('informes', compact('postulantes', 'total_mujeres', 'total_hombres', 'porRubro', 'rubros'));
    }

    public function pdf(Request $request)
    {
        $fechaDesde = $request->input('fecha_desde');
        $fechaHasta = $request->input('fecha_hasta');
        $sexo = $request->input('sexo');
        $edadDesde = $request->input('edad_desde');
        $edadHasta = $request->input('edad_hasta');
        $rubroId = $request->input('rubro_id');

        $query = Postulante::with('rubro');

        if ($fechaDesde) $query->whereDate('created_at', '>=', $fechaDesde);
        if ($fechaHasta) $query->whereDate('created_at', '<=', $fechaHasta);
        if ($sexo) $query->where('sexo', $sexo);
        if ($edadDesde) {
            $fechaMaxima = now()->subYears($edadDesde);
            $query->whereDate('fecha_nacimiento', '<=', $fechaMaxima);
        }
        if ($edadHasta) {
            $fechaMinima = now()->subYears($edadHasta);
            $query->whereDate('fecha_nacimiento', '>=', $fechaMinima);
        }
        if ($rubroId) $query->where('rubro_id', $rubroId);

        $postulantes = $query->get();

        $total_mujeres = $postulantes->where('sexo', 'mujer')->count();
        $total_hombres = $postulantes->where('sexo', 'hombre')->count();
        $porRubro = $postulantes->groupBy('rubro.rubro')->map->count();

        $pdf = Pdf::loadView('pdf.informespdf', compact('postulantes', 'total_mujeres', 'total_hombres', 'porRubro'));

        return $pdf->download('informe_postulantes.pdf');
    }
}
