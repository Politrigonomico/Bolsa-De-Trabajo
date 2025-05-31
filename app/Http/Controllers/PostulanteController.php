<?php

// app/Http/Controllers/PostulanteController.php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Postulante;
use Illuminate\Http\Request;
use App\Models\Rubro; 

class PostulanteController extends Controller
{
    public function index(Request $request)
    {
        // 1. Traigo todos los rubros (por si los vas a necesitar en la vista)
        $rubros = Rubro::all();

        // 2. Empiezo con un Query Builder sobre Postulante (con la relación 'rubro')
        $query = Postulante::with('rubro');

        // 3. Filtro por Nombre (si vino el parámetro 'nombre' no vacío)
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%'.$request->nombre.'%');
        }

        // 4. Filtro por Apellido
        if ($request->filled('apellido')) {
            $query->where('apellido', 'like', '%'.$request->apellido.'%');
        }

        // 5. Filtro por Profesión (Rubro) usando relación
        if ($request->filled('rubro')) {
            $query->whereHas('rubro', function($q) use ($request) {
                $q->where('rubro', 'like', '%'.$request->rubro.'%');
            });
        }

        // 6. FILTRO POR RANGO DE EDAD (edad_min Y edad_max)
        $edadMin = $request->input('edad_min');
        $edadMax = $request->input('edad_max');

        // Convertir a enteros solo si vienen llenos
        $tieneMin = is_numeric($edadMin) && $edadMin !== '';
        $tieneMax = is_numeric($edadMax) && $edadMax !== '';

        if ($tieneMin && $tieneMax) {
            // Ambos extremos definidos: buscamos quienes tengan edad entre edad_min y edad_max (inclusive).
            // a) Fecha de corte máxima: hace edad_min años exactos (endOfDay)
            $fechaMax = Carbon::now()->subYears((int)$edadMin)->endOfDay();
            // b) Fecha de corte mínima: hace (edad_max + 1) años, pero sumarle un día para excluir el cumpleaños exacto de edad_max+1
            //    Así evitamos incluir a quienes ya cumplen edad_max+1.
            $fechaMin = Carbon::now()
                          ->subYears((int)$edadMax + 1)
                          ->addDay()
                          ->startOfDay();

            $query->whereBetween('fecha_nacimiento', [$fechaMin, $fechaMax]);
        }
        elseif ($tieneMin) {
            // Solo se definió edad_min: traemos quienes tengan edad >= edad_min
            $fechaMax = Carbon::now()->subYears((int)$edadMin)->endOfDay();
            // fecha_nacimiento <= fechaMax
            $query->where('fecha_nacimiento', '<=', $fechaMax);
        }
        elseif ($tieneMax) {
            // Solo se definió edad_max: traemos quienes tengan edad <= edad_max
            // Fecha mínima para edad_max: hace (edad_max + 1) años, +1 día (para excluir edad_max+1 exacto)
            $fechaMin = Carbon::now()
                          ->subYears((int)$edadMax + 1)
                          ->addDay()
                          ->startOfDay();
            // fecha_nacimiento >= fechaMin
            $query->where('fecha_nacimiento', '>=', $fechaMin);
        }

        // 7. Filtro por Tipo de Carnet
        if ($request->filled('tipo_carnet')) {
            $query->where('tipo_carnet', 'like', '%'.$request->tipo_carnet.'%');
        }

        // 8. Filtro por Certificado de Manipulación de Alimentos
        //    Usamos filled() porque '0' o '1' no se consideran vacíos
        if ($request->filled('certificado_check')) {
            $query->where('certificado_check', $request->certificado_check);
        }

        // 9. Ordeno los resultados y obtengo la colección
        $postulantes = $query->latest()->get();

        // 10. Retorno la vista con postulantes (filtrados o no) y rubros
        return view('busqueda', compact('postulantes', 'rubros'));
    }


    public function create()
    {
        $rubros = Rubro::all();
        return view('postulante_nuevo', compact('rubros'));
        

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
            'estado_civil' => 'nullable|string|max:50',
            'rubro_id' => 'required|exists:rubros,id',
            'experiencia_laboral' => 'nullable|string|max:250',
            'estudios_cursados' => 'nullable|string|max:250',
            'certificado_check' => 'nullable|boolean',
            'carnet_check' => 'nullable|boolean',
            'tipo_carnet' => 'nullable|string|max:100',
            'movilidad_propia' => 'nullable|boolean',
            'sexo' => 'nullable|string|max:10',
        ]);

        
        $validated['certificado_check'] = $request->has('certificado_check') ;
        $validated['carnet_check'] = $request->has('carnet_check') ;
        $validated['movilidad_propia'] = $request->has('movilidad_propia') ;

        Postulante::create($validated);

        return redirect()->route('postulante_nuevo')->with('success', 'Postulante cargado correctamente.');
    }

    public function busqueda(Request $request)
    {
        $query = Postulante::query();

        if ($request->filled('profesion')) {
            $query->whereHas('rubro', function ($q) use ($request) {
                $q->where('rubro', 'like', '%' . $request->profesion . '%');
            });
        }
        
        if ($request->filled('edad_min')) {
            $fecha_max = Carbon::now()->subYears($request->edad_min);
            $query->where('fecha_nacimiento', '<=', $fecha_max);
        }

        if ($request->filled('edad_max')) {
            $fecha_min = Carbon::now()->subYears($request->edad_max + 1)->addDay();
            $query->where('fecha_nacimiento', '>=', $fecha_min);
        }

        
        if ($request->filled('carnet')) {
            $query->where('carnet_check', $request->carnet);
        }

        $postulantes = $query->latest()->get();

        return view('busqueda', compact('postulantes'));
    }

    public function edit(Postulante $postulante)
    {
        $rubros = Rubro::all();
        return view('busqueda', compact('postulante', 'rubros'));
    }
    public function update(Request $request, Postulante $postulante, $id)
    {
        $postulante = Postulante::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'dni' => 'required|integer|unique:postulantes,dni,' . $postulante->id,
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:250|unique:postulantes,email,' . $postulante->id,
            'domicilio' => 'required|string|max:250',
            'localidad' => 'required|string|max:250',
            'fecha_nacimiento' => 'required|date',
            'estado_civil' => 'nullable|string|max:50',
            'rubro_id' => 'required|exists:rubros,id',
            'experiencia_laboral' => 'nullable|string|max:250',
            'estudios_cursados' => 'nullable|string|max:250',
            'certificado_check' => 'nullable|boolean',
            'carnet_check' => 'nullable|boolean',
            'tipo_carnet' => 'nullable|string|max:100',
            'movilidad_propia' => 'nullable|boolean',
            'sexo' => 'nullable|string|max:10',
        ]);

        $validated['certificado_check'] = $request->has('certificado_check');
        $validated['carnet_check'] = $request->has('carnet_check');
        $validated['movilidad_propia'] = $request->has('movilidad_propia');

        $postulante->update($validated);

        return redirect()->route('busqueda')->with('success', 'Postulante actualizado correctamente.');
    }

}