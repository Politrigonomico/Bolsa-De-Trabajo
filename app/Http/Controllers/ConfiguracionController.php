<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rubro;

class ConfiguracionController extends Controller
{
    // 1) Muestra sólo el botón "Ingresar Profesión"
    public function index()
    {
        return view('configuracion');
    }

    // 2) Muestra el formulario para ingresar una nueva profesión
    public function create()
    {
        return view('configuracion_ingresar');
    }

    // 3) Valida y guarda la profesión en la tabla rubros
    public function store(Request $request)
    {
        //mensajes personalizados
        $messages = [
            'rubro.required' => 'El campo profesion es obligatorio.',
            'rubro.string' => 'El campo profesion debe ser una cadena de texto.',
            'rubro.max' => 'El campo profesion no puede tener más de 255 caracteres.',
            'rubro.unique' => 'La profesion ya existe en la base de datos.',
        ];
        
        $data = $request->validate([
            'rubro' => 'required|string|max:255|unique:rubros,rubro',
        ], $messages);

        Rubro::create($data);

        return redirect()
            ->route('configuracion')
            ->with('success', 'Profesión ingresada correctamente.');
    }
}