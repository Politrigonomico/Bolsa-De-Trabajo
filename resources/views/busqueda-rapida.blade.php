@extends('layouts.app') {{-- Ajusta al layout que estés usando --}}

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Resultados de búsqueda para: "{{ $query }}"</h1>

    {{-- Resultados de Postulantes --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Postulantes</h2>
        @if($postulantes->count() > 0)
            <ul class="bg-white shadow rounded-lg divide-y divide-gray-200">
                @foreach($postulantes as $postulante)
                    <li class="p-4 hover:bg-gray-50">
                        <span class="font-semibold">{{ $postulante->nombre }} {{ $postulante->apellido }}</span>
                        - DNI: {{ $postulante->dni }}
                        - Email: {{ $postulante->email }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No se encontraron postulantes.</p>
        @endif
    </div>

    {{-- Resultados de Empresas --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Empresas</h2>
        @if($empresas->count() > 0)
            <ul class="bg-white shadow rounded-lg divide-y divide-gray-200">
                @foreach($empresas as $empresa)
                    <li class="p-4 hover:bg-gray-50">
                        <span class="font-semibold">{{ $empresa->razon_social }}</span>
                        - CUIT: {{ $empresa->cuit }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No se encontraron empresas.</p>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('index') }}" class="text-blue-600 hover:underline">Volver al inicio</a>
    </div>
</div>
@endsection
