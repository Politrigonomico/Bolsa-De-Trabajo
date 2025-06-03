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
            'razon_social' => 'required|string|max:255',
            'cuit' => 'required|string|max:50|unique:empresas,cuit',
            'rubro_empresa' => 'required|string|max:255',
            'observacion' => 'nullable|string|max:500',
            // RRHH
            'contacto' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        // Crear empresa
        $empresa = Empresa::create([
            'razon_social' => $validated['razon_social'],
            'cuit' => $validated['cuit'],
            'rubro_empresa' => $validated['rubro_empresa'],
            'observacion' => $validated['observacion'] ?? null,
        ]);

        $empresa->rrhh()->create([
            'contacto' => $validated['contacto'],
            'telefono' => $validated['telefono'],
            'email' => $validated['email'],
        ]);


        // Redirigir al listado con mensaje de éxito
        return redirect()
            ->route('buscar_empresa')
            ->with('success', 'Empresa creada correctamente.');
    }

    // (Opcionales: show, edit, update, destroy si luego los vas a usar)

    public function edit(Empresa $empresa)
    {
        $empresa->load('rrhh'); 
        return view('buscar_empresa', compact('empresa'));
    }


    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'razon_social' => 'required|string|max:255',
            'cuit' => 'required|string|max:50|unique:empresas,cuit,' . $empresa->id,
            'rubro_empresa' => 'required|string|max:255',
            'observacion' => 'nullable|string|max:500',
            // RRHH
            'contacto' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);
        
        $empresa->update([
            'razon_social' => $request->razon_social,
            'cuit' => $request->cuit,
            'rubro_empresa' => $request->rubro_empresa,
            'observacion' => $request->observacion,
        ]);
        $empresa->rrhh()->updateOrCreate(
            ['empresa_id' => $empresa->id], // Condición para actualizar o crear
            [
                'contacto' => $request->contacto,
                'telefono' => $request->telefono,
                'email' => $request->email,
            ]
        );
        return redirect()->route('buscar_empresa')->with('success', 'Empresa actualizada con éxito.');

    }

}