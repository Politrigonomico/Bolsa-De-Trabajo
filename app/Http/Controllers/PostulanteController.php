<?php

// app/Http/Controllers/PostulanteController.php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Postulante;
use Illuminate\Http\Request;
use App\Models\Rubro; 

class PostulanteController extends Controller
{
    public function index()
    {
        $rubros = Rubro::all();
        $postulantes = Postulante::latest()->get();
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