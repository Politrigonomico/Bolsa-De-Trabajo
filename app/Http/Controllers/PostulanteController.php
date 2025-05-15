<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postulante;

class PostulanteController extends Controller
{
        public function index()
    {
        $postulantes = Postulante::all();
        return view('busqueda', compact('postulantes'));
    }
    public function create()
    {
        return view('postulante_nuevo');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|digits_between:7,8|unique:postulantes,dni',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string',
            'estado_civil' => 'required|string',
            'localidad' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'estudios_cursados' => 'required|string',
            'experiencia_laboral' => 'required|string',
            'email' => 'required|email|max:255',
            'telefono' => 'required|digits_between:8,15',
        ]);

        // Para los checkbox, si no vienen, serán false
        $validated['carnet_conducir'] = $request->has('carnet_conducir') ? 1 : 0;
        $validated['movilidad_propia'] = $request->has('movilidad_propia') ? 1 : 0;

        Postulante::create($validated);

        return redirect()->route('postulante_nuevo')->with('success', 'Postulante registrado con éxito');
    }
}
