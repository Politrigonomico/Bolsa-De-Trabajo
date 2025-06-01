@extends('layouts.app')

@section('title', 'Buscar Empresas')

@section('content')
<div class="max-w-4xl mx-auto mt-6 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Empresas Creadas</h1>

    @if($empresas->isEmpty())
        <p class="text-gray-600">No hay empresas cargadas aún.</p>
    @else
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">ID</th>
                    <th class="border px-4 py-2 text-left">Razón Social</th>
                    <th class="border px-4 py-2 text-left">CUIT</th>
                    <th class="border px-4 py-2 text-left">Rubro</th>
                    <th class="border px-4 py-2 text-left">Contacto</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-left">Teléfono</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empresas as $empresa)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $empresa->id }}</td>
                        <td class="border px-4 py-2">{{ $empresa->razon_social }}</td>
                        <td class="border px-4 py-2">{{ $empresa->cuit }}</td>
                        <td class="border px-4 py-2">{{ $empresa->rubro_empresa }}</td>
                        <td class="border px-4 py-2">{{ $empresa->contacto }}</td>
                        <td class="border px-4 py-2">{{ $empresa->email }}</td>
                        <td class="border px-4 py-2">{{ $empresa->telefono }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
