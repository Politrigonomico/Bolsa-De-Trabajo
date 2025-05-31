<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = \App\Models\Empresa::latest()->get();
        return view('empresa_nuevo', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresa_nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'razon_social'    => 'required|string|max:255',
            'cuit'            => 'required|string|max:50|unique:empresas,cuit',
            'rubro_empresa'   => 'required|string|max:255',
            'contacto'        => 'required|string|max:255',
            'telefono'        => 'required|string|max:50',
            'email'            => 'required|email|max:255|unique:empresas,email',
            'observacion'     => 'nullable|string|max:500',
        ]);

        // Crear la empresa
        \App\Models\Empresa::create($validated);

        // Redirigir a la lista con mensaje de éxito
        return redirect()
            ->route('empresa.index')
            ->with('success', 'Empresa creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}