<!-- resources/views/postulante.blade.php -->
@extends('layouts.app')

@section('title', 'Postulante - Municipalidad')

@section('content')
<div class="min-h-screen items-center justify-center bg-gray-100 px-4">
    <div class="bg-white p-10 rounded-2xl shadow-xl max-w-xl w-full text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-10">Menú de Postulantes</h1>

        <div class="flex flex-col gap-6 mb-8">
            <a href="{{ route('postulante_nuevo') }}"
               class="w-full py-4 px-6 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                ➕ NUEVO
            </a>
            <a href="{{ route('index') }}"
               class="w-full py-4 px-6 bg-green-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300">
                🔄 ACTUALIZAR
            </a>
        </div>

        <a href="{{ route('ingresos') }}"
           class="text-base text-gray-500 hover:text-gray-800  font-semibold transition duration-200">
            &larr; Volver
        </a>
    </div>
</div>

@endsection
