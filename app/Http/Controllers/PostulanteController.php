<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Models\Titulos;
use App\Models\Carnet;
use App\Models\Rubros;
use App\Models\Empresas;


class PostulanteController extends Controller
{
    public function index()
    {
        $postulantes = Postulante::all();
        return view('busqueda', compact('postulantes'));
    }

    public function create()
    {
        // Para completar los select en el formulario
        $titulos = Titulos::all();
        $carnets = Carnet::all();
        $rubros = Rubros::all();
        $empresas = Empresas::all();

        return view('postulante_nuevo', compact('titulos', 'carnets', 'rubros', 'empresas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'dni' => 'required|digits_between:7,8|unique:postulantes,dni',
            'cuil' => 'required|string|max:13',
            'telefono' => 'required|string|max:20',
            'celular' => 'required|string|max:20',
            'mail' => 'required|email|max:250',
            'domicilio' => 'required|string|max:250',
            'ciudad' => 'required|string|max:250',
            'nacimiento' => 'required|date',
            'titulo' => 'required|exists:titulos,titulo',
            'cursos' => 'nullable|string|max:250',
            'observacionEdu' => 'nullable|string|max:250',
            'rubro' => 'required|exists:rubros,rubro',
            'experiencia' => 'nullable|string|max:250',
            'empleado' => 'required|boolean',
            'tipoEmpleo' => 'required|string|max:250',
            'empresa' => 'required|exists:empresas,razonSocial',
            'carnet' => 'required|exists:carnets,carnetTipo',
            'observacionCarnet' => 'nullable|string|max:250',
            'idiomas' => 'required|boolean',
            'observacionIdioma' => 'nullable|string|max:250',
            'practica' => 'required|boolean',
            'pasante' => 'required|boolean',
            'vigencia' => 'required|date'
        ]);



        Postulante::create($validated);

        return redirect()->route('postulante_nuevo')->with('success', 'Postulante registrado con éxito');
    }
}