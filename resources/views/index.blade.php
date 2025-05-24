@extends('layouts.app')

@section( 'title', 'Portal de CV-Municipalidad')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-xl rounded-2xl p-10 max-w-xl w-full text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Portal de CV-Municipalidad</h1>

        <div class="flex flex-col gap-6">
            <a href="{{ route('ingresos') }}"
                class="w-full py-4 px-6 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                📥 INGRESOS
            </a>

            <a href="{{ route('busqueda') }}"
                class="w-full py-4 px-6 bg-green-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300">
                🔍 BÚSQUEDAS
            </a>
        </div>

        <div class="mt-8">
            <a href="{{ route('index') }}"
                class="text-sm text-gray-500 hover:text-gray-800 transition duration-200">
                ⚙️ CONFIGURACIONES
            </a>
        </div>
    </div>
</div>
@endsection