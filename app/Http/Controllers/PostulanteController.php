<?php

namespace App\Http\Controllers;

use App\Models\Postulante;
use App\Models\Rubros;
use Illuminate\Http\Request;

class PostulanteController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para mostrar la lista de postulantes
        $postulantes = Postulante::all();
        return view('busqueda', compact('postulantes'));
    }

    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de un nuevo postulante
        $rubros = Rubros::all();
        return view('postulante_nuevo', compact('rubros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|integer|unique:postulantes,dni',
            'telefono' => 'required|integer',
            'email' => 'required|email|unique:postulantes,email',
            'domicilio' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:255',
            'profesion' => 'nullable|string|max:255',
            'experiencia_laboral' => 'nullable|string|max:255',
            'estudios_cursados' => 'nullable|string|max:255',
            'carnet_conducir' => 'boolean',
            'movilidad_propia' => 'boolean',
            'sexo' => 'string|max:10',
            'fecha_nacimiento' => 'required|date',
            'rubro' => 'required|string|exists:rubros,rubro'
        ]);
        // Convertir el texto de rubro en su ID
        $rubro = Rubros::where('rubro', $request['rubro'])->first();
        $request['rubro_id'] = $rubro->id;
        unset($request['rubro']);

        Postulante::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'domicilio' => $request->domicilio,
            'localidad' => $request->localidad,
            'estado_civil' => $request->estado_civil,
            'profesion' => $request->profesion,
            'experiencia_laboral' => $request->experiencia_laboral,
            'estudios_cursados' => $request->estudios_cursados,
            'carnet_conducir' => $request->carnet_conducir,
            'movilidad_propia' => $request->movilidad_propia,
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'rubro_id' => $rubro->id,
        ]);
        return redirect()->route('postulante_nuevo')->with('success', 'Postulante creado exitosamente.');
    }



    public function show($id)
    {
        // Aquí puedes implementar la lógica para mostrar un postulante específico
    }

    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un postulante específico
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        // Aquí puedes implementar la lógica para eliminar un postulante específico de la base de datos
    }
}