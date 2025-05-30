@extends('layouts.app')

@section( 'title', 'Portal de CV-Municipalidad')

@section('content')

<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-6 text-center">
    <h1 class="text-2xl font-semibold mb-4">Portal de CV - Municipalidad</h1>
    <p class="text-gray-700 mb-6">
        Este portal te permite gestionar los ingresos y búsquedas de postulantes y empresas de la Municipalidad.
    </p>
    <strong>Instrucciones:</strong>
    <br>
    Para comenzar, utiliza los botones a continuación para acceder a las diferentes secciones del portal.
    <br>
    <strong>Importante:</strong> Asegúrate de tener los permisos necesarios para acceder a cada sección.
    <br>
    Si tienes alguna duda o necesitas ayuda, contacta al administrador del sistema.
    <br>
    <strong>Nota:</strong> Este portal es exclusivo para uso interno de la Municipalidad.
    <br>
</div>

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
            <a href="{{ route('configuracion') }}"
                class="text-sm text-gray-500 hover:text-gray-800 transition duration-200">
                ⚙️ CONFIGURACIONES
            </a>
        </div>
    </div>
</div>
@endsection