<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Postulante;
use App\Models\Rubro;
use App\Models\Carnet;
use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostulanteController extends Controller
{
    public function index(Request $request)
    {
        $rubros  = Rubro::orderBy('rubro')->get();
        $carnets = Carnet::orderBy('tipo_carnet')->get();

        $query = Postulante::with(['rubro', 'rubros', 'carnets']);

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }
        if ($request->filled('apellido')) {
            $query->where('apellido', 'like', '%' . $request->apellido . '%');
        }
        if ($request->filled('rubro')) {
            $query->whereHas('rubro', function ($q) use ($request) {
                $q->where('rubro', 'like', '%' . $request->rubro . '%');
            });
        }

        $edadMin = $request->input('edad_min');
        $edadMax = $request->input('edad_max');
        $tieneMin = is_numeric($edadMin) && $edadMin !== '';
        $tieneMax = is_numeric($edadMax) && $edadMax !== '';

        if ($tieneMin && $tieneMax) {
            $fechaMax = Carbon::now()->subYears((int)$edadMin)->endOfDay();
            $fechaMin = Carbon::now()->subYears((int)$edadMax + 1)->addDay()->startOfDay();
            $query->whereBetween('fecha_nacimiento', [$fechaMin, $fechaMax]);
        } elseif ($tieneMin) {
            $fechaMax = Carbon::now()->subYears((int)$edadMin)->endOfDay();
            $query->where('fecha_nacimiento', '<=', $fechaMax);
        } elseif ($tieneMax) {
            $fechaMin = Carbon::now()->subYears((int)$edadMax + 1)->addDay()->startOfDay();
            $query->where('fecha_nacimiento', '>=', $fechaMin);
        }

        if ($request->filled('tipo_carnet')) {
            $query->whereHas('carnets', function ($q) use ($request) {
                $q->where('tipo_carnet', 'like', '%' . $request->tipo_carnet . '%');
            });
        }
        if ($request->filled('certificado_check')) {
            $query->where('certificado_check', $request->certificado_check);
        }

        $postulantes = $query->latest()->get();

        return view('busqueda', compact('postulantes', 'rubros', 'carnets'));
    }

    public function create()
    {
        $rubros = Rubro::all();
        $carnets = Carnet::all();
        $localidades = Localidad::all();
        
        return view('postulante_nuevo', compact('rubros', 'carnets', 'localidades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'dni' => 'required|integer|unique:postulantes',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:250|unique:postulantes',
            'domicilio' => 'required|string|max:250',
            'localidad' => 'required|string|max:250',
            'fecha_nacimiento' => 'required|date',
            'estado_civil' => 'required|string|max:50',
            'rubro_id' => 'required|exists:rubros,id',
            'experiencia_laboral' => 'nullable|string|max:500',
            'estudios_cursados' => 'nullable|string|max:500',
            
            // Estudios por nivel
            'estudios_primaria' => 'nullable|boolean',
            'estudios_secundaria' => 'nullable|boolean', 
            'estudios_terciario' => 'nullable|boolean',
            'estudios_universidad' => 'nullable|boolean',
            'cursando_primaria' => 'nullable|boolean',
            'cursando_secundaria' => 'nullable|boolean',
            'cursando_terciario' => 'nullable|boolean',
            'cursando_universidad' => 'nullable|boolean',
            
            'certificado_check' => 'nullable|boolean',
            'carnet_check' => 'nullable|boolean',
            'movilidad_propia' => 'nullable|boolean',
            'sexo' => 'required|string|max:10',
            
            // Foto
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Arrays para múltiples profesiones y carnets
            'rubros_adicionales' => 'nullable|array',
            'rubros_adicionales.*' => 'string|max:250',
            'carnets' => 'nullable|array',
            'carnets.*' => 'exists:carnets,id',
        ]);

        // Manejar checkboxes (convertir a boolean)
        $validated['certificado_check'] = $request->has('certificado_check') || $request->input('certificado_check') == '1';
        $validated['carnet_check'] = $request->has('carnet_check') || $request->input('carnet_check') == '1';
        $validated['movilidad_propia'] = $request->has('movilidad_propia') || $request->input('movilidad_propia') == '1';
        $validated['estudios_primaria'] = $request->has('estudios_primaria') || $request->input('estudios_primaria') == '1';
        $validated['estudios_secundaria'] = $request->has('estudios_secundaria') || $request->input('estudios_secundaria') == '1';
        $validated['estudios_terciario'] = $request->has('estudios_terciario') || $request->input('estudios_terciario') == '1';
        $validated['estudios_universidad'] = $request->has('estudios_universidad') || $request->input('estudios_universidad') == '1';
        $validated['cursando_primaria'] = $request->has('cursando_primaria') || $request->input('cursando_primaria') == '1';
        $validated['cursando_secundaria'] = $request->has('cursando_secundaria') || $request->input('cursando_secundaria') == '1';
        $validated['cursando_terciario'] = $request->has('cursando_terciario') || $request->input('cursando_terciario') == '1';
        $validated['cursando_universidad'] = $request->has('cursando_universidad') || $request->input('cursando_universidad') == '1';

        // Manejar foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nombreFoto = 'foto_' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('fotos', $nombreFoto, 'public');
            $validated['foto'] = $nombreFoto;
        }

        // Crear postulante
        $postulante = Postulante::create($validated);

        // Agregar carnets si se seleccionaron
        if ($request->has('carnets') && is_array($request->carnets)) {
            $postulante->carnets()->sync($request->carnets);
        }

        // Agregar rubros adicionales
        $rubrosIds = [$postulante->rubro_id]; // El principal ya está
        
        if ($request->has('rubros_adicionales') && is_array($request->rubros_adicionales)) {
            foreach ($request->rubros_adicionales as $nombreRubro) {
                if (!empty(trim($nombreRubro))) {
                    $rubro = Rubro::where('rubro', trim($nombreRubro))->first();
                    if ($rubro && !in_array($rubro->id, $rubrosIds)) {
                        $rubrosIds[] = $rubro->id;
                    }
                }
            }
        }
        
        // Sincronizar todos los rubros (principal + adicionales)
        $postulante->rubros()->sync($rubrosIds);

        // Generar CV en PDF
        try {
            $this->generarCVPDF($postulante);
        } catch (\Exception $e) {
            Log::error('Error al generar CV: ' . $e->getMessage());
        }

        return redirect()
            ->route('postulante_nuevo')
            ->with('success', 'Postulante cargado correctamente. CV generado automáticamente.');
    }

    public function edit(Postulante $postulante)
    {
        $rubros = Rubro::all();
        $carnets = Carnet::all();
        $localidades = Localidad::all();
        
        return view('busqueda', compact('postulante', 'rubros', 'carnets', 'localidades'));
    }

    public function update(Request $request, $id)
    {
        $postulante = Postulante::findOrFail($id);

        $validated = $request->validate([
            'nombre'               => 'required|string|max:250',
            'apellido'             => 'required|string|max:250',
            'dni'                  => 'required|integer|unique:postulantes,dni,' . $postulante->id,
            'fecha_nacimiento'     => 'required|date',
            'telefono'             => 'nullable|string|max:20',
            'email'                => 'nullable|email|max:250|unique:postulantes,email,' . $postulante->id,
            'domicilio'            => 'nullable|string|max:250',
            'localidad'            => 'nullable|string|max:250',
            'rubro_id'             => 'required|exists:rubros,id',
            'experiencia_laboral'  => 'nullable|string|max:1000',
            'estudios_cursados'    => 'nullable|string|max:500',
            'certificado_check'    => 'nullable|in:0,1',
            'movilidad_propia'     => 'nullable|in:0,1',
            'foto'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'carnets'              => 'nullable|array',
            'carnets.*'            => 'exists:carnets,id',
            'rubros_adicionales'   => 'nullable|array',
            'rubros_adicionales.*' => 'exists:rubros,id',
        ]);

        // Campos básicos
        $postulante->nombre              = $validated['nombre'];
        $postulante->apellido            = $validated['apellido'];
        $postulante->dni                 = $validated['dni'];
        $postulante->fecha_nacimiento    = $validated['fecha_nacimiento'];
        $postulante->telefono            = $validated['telefono']           ?? $postulante->telefono;
        $postulante->email               = $validated['email']              ?? $postulante->email;
        $postulante->domicilio           = $validated['domicilio']          ?? $postulante->domicilio;
        $postulante->localidad           = $validated['localidad']          ?? $postulante->localidad;
        $postulante->rubro_id            = $validated['rubro_id'];
        $postulante->experiencia_laboral = $validated['experiencia_laboral'] ?? null;
        $postulante->estudios_cursados   = $validated['estudios_cursados']   ?? null;
        $postulante->certificado_check   = $request->has('certificado_check') ? 1 : 0;
        $postulante->movilidad_propia    = $request->has('movilidad_propia')  ? 1 : 0;

        // Estudios por nivel (checkboxes — ausente = false)
        $postulante->estudios_primaria    = $request->has('estudios_primaria')    ? 1 : 0;
        $postulante->estudios_secundaria  = $request->has('estudios_secundaria')  ? 1 : 0;
        $postulante->estudios_terciario   = $request->has('estudios_terciario')   ? 1 : 0;
        $postulante->estudios_universidad = $request->has('estudios_universidad') ? 1 : 0;
        $postulante->cursando_primaria    = $request->has('cursando_primaria')    ? 1 : 0;
        $postulante->cursando_secundaria  = $request->has('cursando_secundaria')  ? 1 : 0;
        $postulante->cursando_terciario   = $request->has('cursando_terciario')   ? 1 : 0;
        $postulante->cursando_universidad = $request->has('cursando_universidad') ? 1 : 0;

        // Foto nueva (opcional)
        if ($request->hasFile('foto')) {
            if ($postulante->foto) {
                Storage::disk('public')->delete('fotos/' . $postulante->foto);
            }
            $foto = $request->file('foto');
            $nombreFoto = 'foto_' . $postulante->id . '_' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('fotos', $nombreFoto, 'public');
            $postulante->foto = $nombreFoto;
        }

        $postulante->save();

        // Sincronizar carnets
        $postulante->carnets()->sync($request->input('carnets', []));

        // Sincronizar rubros (principal + adicionales sin duplicar)
        $rubrosIds = [(int) $postulante->rubro_id];
        foreach ($request->input('rubros_adicionales', []) as $rubroId) {
            $rubroId = (int) $rubroId;
            if ($rubroId && !in_array($rubroId, $rubrosIds)) {
                $rubrosIds[] = $rubroId;
            }
        }
        $postulante->rubros()->sync($rubrosIds);

        // Regenerar CV
        try {
            $this->generarCVPDF($postulante);
        } catch (\Exception $e) {
            Log::error('Error al regenerar CV en update: ' . $e->getMessage());
        }

        return redirect()
            ->route('busqueda')
            ->with('success', 'Postulante actualizado correctamente.');
    }

    public function destroy($id)
    {
        $postulante = Postulante::findOrFail($id);

        // Eliminar archivos asociados
        if ($postulante->cv_pdf) {
            Storage::disk('public')->delete("cvs/{$postulante->cv_pdf}");
        }
        if ($postulante->foto) {
            Storage::disk('public')->delete("fotos/{$postulante->foto}");
        }

        // Eliminar relaciones
        $postulante->carnets()->detach();
        $postulante->rubros()->detach();

        $postulante->delete();

        return redirect()
            ->route('busqueda')
            ->with('success', 'Postulante eliminado correctamente.');
    }

    private function generarCVPDF($postulante)
    {
        // Cargar las relaciones necesarias para el CV
        $postulante->load(['rubro', 'rubros', 'carnets']);
        
        // Configurar DomPDF
        $pdf = Pdf::loadView('pdf.cv', ['postulante' => $postulante]);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'cv_' . $postulante->id . '_' . date('Y-m-d') . '.pdf';
        
        // Eliminar CV anterior si existe
        if ($postulante->cv_pdf) {
            Storage::disk('public')->delete("cvs/{$postulante->cv_pdf}");
        }
        
        // Guardar el PDF
        Storage::disk('public')->put("cvs/{$filename}", $pdf->output());
        
        // Actualizar el registro con el nombre del archivo
        $postulante->cv_pdf = $filename;
        $postulante->save();
        
        return $filename;
    }

    // Método para mostrar el CV en el navegador
    public function mostrarCV($id)
    {
        $postulante = Postulante::with(['rubro', 'rubros', 'carnets'])->findOrFail($id);
        
        if (!$postulante->cv_pdf || !Storage::disk('public')->exists("cvs/{$postulante->cv_pdf}")) {
            $this->generarCVPDF($postulante);
        }
        
        return response()->file(storage_path("app/public/cvs/{$postulante->cv_pdf}"));
    }

    // Método para descargar el CV
    public function descargarCV($id)
    {
        $postulante = Postulante::findOrFail($id);
        
        if (!$postulante->cv_pdf || !Storage::disk('public')->exists("cvs/{$postulante->cv_pdf}")) {
            $this->generarCVPDF($postulante);
        }
        
        return response()->download(
            storage_path("app/public/cvs/{$postulante->cv_pdf}"),
            "CV_{$postulante->nombre}_{$postulante->apellido}.pdf"
        );
    }
}