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
        //
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
        $data = $request->validate([
            'razon_social'    => 'required|string|max:255',
            'cuit'            => 'required|string|unique:empresas,cuit',
            'rubro_empresa'   => 'required|string|max:255',
            'contacto'        => 'required|string|max:255',
            'telefono'        => 'required|string|max:50',
            'email'           => 'required|email|unique:empresas,email',
            'observacion'     => 'nullable|string',
        ]);

        Empresa::create($data);

        return redirect()
            ->route('empresas_nuevo')
            ->with('success', 'Empresa guardada correctamente.');
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
