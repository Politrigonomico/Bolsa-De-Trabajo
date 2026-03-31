<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rubro;
use App\Models\Carnet;
use App\Models\Localidad;
use App\Models\Postulante;
use App\Models\Empresa;

class ConfiguracionController extends Controller
{
    // =========================================================================
    // PANEL PRINCIPAL
    // =========================================================================

    public function index()
    {
        return view('configuracion');
    }

    // =========================================================================
    // RUBROS / PROFESIONES
    // =========================================================================

    public function rubrosIndex()
    {
        $rubros = Rubro::withCount('postulantes')->orderBy('rubro')->get();
        return view('configuracion.rubros', compact('rubros'));
    }

    public function rubrosStore(Request $request)
    {
        $request->validate([
            'rubro' => 'required|string|max:255|unique:rubros,rubro',
        ], [
            'rubro.required' => 'El campo profesión es obligatorio.',
            'rubro.unique'   => 'Esa profesión ya existe.',
            'rubro.max'      => 'Máximo 255 caracteres.',
        ]);

        Rubro::create(['rubro' => $request->rubro]);

        return redirect()
            ->route('configuracion.rubros.index')
            ->with('success', 'Profesión creada correctamente.');
    }

    public function rubrosUpdate(Request $request, Rubro $rubro)
    {
        $request->validate([
            'rubro' => 'required|string|max:255|unique:rubros,rubro,' . $rubro->id,
        ], [
            'rubro.required' => 'El campo profesión es obligatorio.',
            'rubro.unique'   => 'Esa profesión ya existe.',
        ]);

        $rubro->update(['rubro' => $request->rubro]);

        return redirect()
            ->route('configuracion.rubros.index')
            ->with('success', 'Profesión actualizada.');
    }

    public function rubrosDestroy(Rubro $rubro)
    {
        // Si tiene postulantes asociados, no se puede eliminar
        if ($rubro->postulantes()->count() > 0) {
            return redirect()
                ->route('configuracion.rubros.index')
                ->with('error', "No se puede eliminar \"{$rubro->rubro}\" porque tiene postulantes asociados.");
        }

        $rubro->delete();

        return redirect()
            ->route('configuracion.rubros.index')
            ->with('success', 'Profesión eliminada.');
    }

    // =========================================================================
    // CARNETS
    // =========================================================================

    public function carnetsIndex()
    {
        $carnets = Carnet::withCount('postulantes')->orderBy('tipo_carnet')->get();
        return view('configuracion.carnets', compact('carnets'));
    }

    public function carnetsStore(Request $request)
    {
        $request->validate([
            'tipo_carnet'  => 'required|string|max:50|unique:carnets,tipo_carnet',
            'descripcion'  => 'nullable|string|max:255',
        ], [
            'tipo_carnet.required' => 'El tipo de carnet es obligatorio.',
            'tipo_carnet.unique'   => 'Ese tipo de carnet ya existe.',
        ]);

        Carnet::create([
            'carnetTipo'  => $request->tipo_carnet,
            'tipo_carnet' => $request->tipo_carnet,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('configuracion.carnets.index')
            ->with('success', 'Carnet creado correctamente.');
    }

    public function carnetsUpdate(Request $request, Carnet $carnet)
    {
        $request->validate([
            'tipo_carnet'  => 'required|string|max:50|unique:carnets,tipo_carnet,' . $carnet->id,
            'descripcion'  => 'nullable|string|max:255',
        ], [
            'tipo_carnet.required' => 'El tipo de carnet es obligatorio.',
            'tipo_carnet.unique'   => 'Ese tipo de carnet ya existe.',
        ]);

        $carnet->update([
            'carnetTipo'  => $request->tipo_carnet,
            'tipo_carnet' => $request->tipo_carnet,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('configuracion.carnets.index')
            ->with('success', 'Carnet actualizado.');
    }

    public function carnetsDestroy(Carnet $carnet)
    {
        if ($carnet->postulantes()->count() > 0) {
            return redirect()
                ->route('configuracion.carnets.index')
                ->with('error', "No se puede eliminar el carnet \"{$carnet->tipo_carnet}\" porque tiene postulantes asociados.");
        }

        $carnet->delete();

        return redirect()
            ->route('configuracion.carnets.index')
            ->with('success', 'Carnet eliminado.');
    }

    // =========================================================================
    // LOCALIDADES
    // =========================================================================

    public function localidadesIndex()
    {
        $localidades = Localidad::orderBy('nombre')->get();
        return view('configuracion.localidades', compact('localidades'));
    }

    public function localidadesStore(Request $request)
    {
        $request->validate([
            'nombre'         => 'required|string|max:255',
            'provincia'      => 'required|string|max:255',
            'codigo_postal'  => 'nullable|string|max:20',
        ], [
            'nombre.required'    => 'El nombre de la localidad es obligatorio.',
            'provincia.required' => 'La provincia es obligatoria.',
        ]);

        // Evitar duplicados (mismo nombre + provincia)
        $existe = Localidad::where('nombre', $request->nombre)
            ->where('provincia', $request->provincia)
            ->exists();

        if ($existe) {
            return redirect()
                ->route('configuracion.localidades.index')
                ->with('error', 'Esa localidad ya existe para esa provincia.');
        }

        Localidad::create($request->only('nombre', 'provincia', 'codigo_postal'));

        return redirect()
            ->route('configuracion.localidades.index')
            ->with('success', 'Localidad creada correctamente.');
    }

    public function localidadesUpdate(Request $request, Localidad $localidad)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'provincia'     => 'required|string|max:255',
            'codigo_postal' => 'nullable|string|max:20',
        ]);

        $localidad->update($request->only('nombre', 'provincia', 'codigo_postal'));

        return redirect()
            ->route('configuracion.localidades.index')
            ->with('success', 'Localidad actualizada.');
    }

    public function localidadesDestroy(Localidad $localidad)
    {
        $localidad->delete();

        return redirect()
            ->route('configuracion.localidades.index')
            ->with('success', 'Localidad eliminada.');
    }

    // =========================================================================
    // EXPORTACIONES CSV
    // =========================================================================

    public function exportarPostulantes()
    {
        $postulantes = Postulante::with(['rubro', 'rubros', 'carnets'])->get();

        $filename = 'postulantes_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($postulantes) {
            $handle = fopen('php://output', 'w');

            // BOM para que Excel abra correctamente con UTF-8
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Encabezados
            fputcsv($handle, [
                'ID', 'Nombre', 'Apellido', 'DNI', 'Fecha Nacimiento', 'Edad',
                'Sexo', 'Estado Civil', 'Email', 'Teléfono', 'Domicilio',
                'Localidad', 'Profesión Principal', 'Profesiones Adicionales',
                'Experiencia Laboral', 'Estudios',
                'Primaria Completa', 'Secundaria Completa', 'Terciario Completo', 'Universidad Completa',
                'Cursando', 'Certificado Manipulación', 'Movilidad Propia',
                'Carnets', 'Fecha Registro',
            ]);

            foreach ($postulantes as $p) {
                $edad = $p->fecha_nacimiento
                    ? \Carbon\Carbon::parse($p->fecha_nacimiento)->age
                    : '';

                $rubrosAdicionales = $p->rubros
                    ->filter(fn($r) => $r->id !== $p->rubro_id)
                    ->pluck('rubro')
                    ->join(' | ');

                $carnets = $p->carnets->pluck('tipo_carnet')->join(' | ');

                $cursando = collect([
                    $p->cursando_primaria    ? 'Primaria'    : null,
                    $p->cursando_secundaria  ? 'Secundaria'  : null,
                    $p->cursando_terciario   ? 'Terciario'   : null,
                    $p->cursando_universidad ? 'Universidad' : null,
                ])->filter()->join(' | ');

                fputcsv($handle, [
                    $p->id,
                    $p->nombre,
                    $p->apellido,
                    $p->dni,
                    $p->fecha_nacimiento ? \Carbon\Carbon::parse($p->fecha_nacimiento)->format('d/m/Y') : '',
                    $edad,
                    $p->sexo,
                    $p->estado_civil,
                    $p->email,
                    $p->telefono,
                    $p->domicilio,
                    $p->localidad,
                    optional($p->rubro)->rubro,
                    $rubrosAdicionales,
                    $p->experiencia_laboral,
                    $p->estudios_cursados,
                    $p->estudios_primaria    ? 'Sí' : 'No',
                    $p->estudios_secundaria  ? 'Sí' : 'No',
                    $p->estudios_terciario   ? 'Sí' : 'No',
                    $p->estudios_universidad ? 'Sí' : 'No',
                    $cursando,
                    $p->certificado_check   ? 'Sí' : 'No',
                    $p->movilidad_propia    ? 'Sí' : 'No',
                    $carnets,
                    $p->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportarEmpresas()
    {
        $empresas = Empresa::with('rrhh')->get();

        $filename = 'empresas_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($empresas) {
            $handle = fopen('php://output', 'w');

            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'ID', 'Razón Social', 'CUIT', 'Rubro',
                'Contacto RRHH', 'Teléfono RRHH', 'Email RRHH',
                'Observaciones', 'Fecha Registro',
            ]);

            foreach ($empresas as $e) {
                fputcsv($handle, [
                    $e->id,
                    $e->razon_social,
                    $e->cuit,
                    $e->rubro_empresa,
                    optional($e->rrhh)->contacto,
                    optional($e->rrhh)->telefono,
                    optional($e->rrhh)->email,
                    $e->observacion,
                    $e->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}