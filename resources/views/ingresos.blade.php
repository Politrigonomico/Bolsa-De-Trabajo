@extends('layouts.app')
@section('title', 'Portal de CV – Municipalidad')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-10 rounded-2xl shadow-lg max-w-md w-full text-center">
        <h1 class="text-3xl font-bold text-gray-800 justify-center mb-8">Ingresos</h1>

        <div class="flex flex-col gap-4 mb-6">
            <a href="{{ route('postulante_nuevo') }}"
               class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 shadow-md">
                   CREAR POSTULANTE
            </a>
            <a href="{{ route('empresa_nuevo') }}"
               class="w-full py-3 px-6 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 shadow-md">
                    CREAR EMPRESA
            </a>
        </div>

        <a href="{{ route('index') }}"
           class="text-sm text-gray-500 hover:text-gray-800 transition duration-200">
            &larr; Volver
        </a>
    </div>
</div>
@endsection