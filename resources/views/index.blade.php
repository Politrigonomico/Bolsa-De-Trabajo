@extends('layouts.app')

@section('title', 'Portal de CV - Municipalidad')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Portal de CV - Municipalidad</h1>
    <p class="text-gray-700 text-center mb-8">
        Este portal te permite gestionar los ingresos y búsquedas de postulantes y empresas de la Municipalidad.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h2 class="text-2xl font-bold text-orange-600">📥 {{ $totalPostulantes }}</h2>
            <p class="text-gray-700 mt-2">Postulantes registrados</p>
            <a href="{{ route('busqueda') }}" class="text-blue-600 hover:underline mt-2 block">Ver postulantes</a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h2 class="text-2xl font-bold text-orange-600">🏢 {{ $totalEmpresas }}</h2>
            <p class="text-gray-700 mt-2">Empresas registradas</p>
            <a href="{{ route('buscar_empresa') }}" class="text-blue-600 hover:underline mt-2 block">Ver empresas</a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 text-center cursor-pointer hover:bg-orange-100 transition">
            <a href="{{ route('informes.index') }}" class="block text-orange-600 font-bold text-2xl">📊 Informes</a>
            <p class="text-gray-700 mt-2">Generar y consultar informes</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:bg-orange-50 transition">
            <a href="{{ route('postulantes.create') }}" class="text-green-600 font-bold text-xl">➕ Nuevo postulante</a>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:bg-orange-50 transition">
            <a href="{{ route('empresas.create') }}" class="text-green-600 font-bold text-xl">➕ Nueva empresa</a>
        </div>
    </div>

    <div class="mt-10 text-center">
        <a href="{{ route('configuracion') }}" 
           class="text-sm text-orange-800 hover:text-orange-600 font-semibold transition">
            ⚙️ CONFIGURACIONES
        </a>
    </div>
</div>
@endsection
