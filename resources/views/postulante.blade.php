<!-- resources/views/postulante.blade.php -->
@extends('layouts.app')
@section('title', 'Postulante – Municipalidad')

@section('content')
<div class="max-w-md mx-auto my-20 p-6 bg-white rounded-lg shadow-md text-center">
    <h1 class="mb-8 text-2xl font-semibold text-gray-800">Postulante</h1>

    <div class="flex flex-col gap-4">
        <a href="{{ route('postulante_nuevo') }}"
           class="inline-block px-6 py-3 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-200">
           NUEVO
        </a>
        <a href="{{ route('index') }}"
           class="inline-block px-6 py-3 text-white bg-green-600 rounded-md hover:bg-green-700 transition duration-200">
           ACTUALIZAR
        </a>
    </div>
    <a href="{{ route('ingresos') }}"
       class="inline-block mt-6 text-sm text-gray-600 hover:underline">
        <span class="mr-1">&larr;</span>Volver
    </a>
</div>
@endsection