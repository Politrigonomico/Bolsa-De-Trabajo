@extends('layouts.app')

@section('title', 'Configuración')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded shadow mt-6 text-center">
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-semibold mb-6">Configuración</h1>

    <div class="space-y-4">
        <!-- Botón para ingresar profesión -->
        <a href="{{ route('configuracion.create') }}"
           class="block px-6 py-3 bg-blue-700 text-white font-medium rounded hover:bg-blue-600 transition">
            Ingresar Profesión
        </a>

        <!-- Botón Volver al Inicio más pequeño -->
        <a href="{{ route('index') }}"
           class="block bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300 transition">
            ← Volver al Inicio
        </a>
    </div>
</div>
@endsection
