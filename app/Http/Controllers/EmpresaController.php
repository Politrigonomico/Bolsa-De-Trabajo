<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Mostrar el listado de empresas (vista buscar_empresa).
     */
    public function index()
    {
        // Obtener todas las empresas (de la más reciente a la más antigua)
        $empresas = Empresa::latest()->get();

        // Retornar la vista de listado
        return view('buscar_empresa', compact('empresas'));
    }

    /**
     * Mostrar el formulario para crear una nueva empresa.
     */
    public function create()
    {
        return view('empresa_nuevo');
    }

    /**
     * Recibir datos del formulario y guardar la nueva empresa.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'razon_social'    => 'required|string|max:255',
            'cuit'            => 'required|string|max:50|unique:empresas,cuit',
            'rubro_empresa'   => 'required|string|max:255',
            'contacto'        => 'required|string|max:255',
            'telefono'        => 'required|string|max:50',
            'email'           => 'required|email|max:255|unique:empresas,email',
            'observacion'     => 'nullable|string|max:500',
        ]);

        // Crear la empresa en la base de datos
        Empresa::create($validated);

        // Redirigir al listado con mensaje de éxito
        return redirect()
            ->route('buscar_empresa')
            ->with('success', 'Empresa creada correctamente.');
    }

    // (Opcionales: show, edit, update, destroy si luego los vas a usar)
}
