@extends('layouts.app')

@section('title', 'Configuración')

@section('content')
<div class="max-w-2xl mx-auto mt-6 p-6 bg-white rounded shadow">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <h1 class="text-2xl font-semibold mb-6">⚙️ Configuración</h1>

    <div class="grid grid-cols-1 gap-4">

        <a href="{{ route('configuracion.rubros.index') }}"
           class="flex items-center p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
            <span class="text-2xl mr-4">💼</span>
            <div>
                <div class="font-semibold text-blue-800">Profesiones / Rubros</div>
                <div class="text-sm text-blue-600">Agregar, editar o eliminar profesiones del sistema</div>
            </div>
        </a>

        <a href="{{ route('configuracion.carnets.index') }}"
           class="flex items-center p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition">
            <span class="text-2xl mr-4">🚗</span>
            <div>
                <div class="font-semibold text-green-800">Carnets / Licencias</div>
                <div class="text-sm text-green-600">Gestionar los tipos de carnet disponibles</div>
            </div>
        </a>

        <a href="{{ route('configuracion.localidades.index') }}"
           class="flex items-center p-4 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition">
            <span class="text-2xl mr-4">📍</span>
            <div>
                <div class="font-semibold text-purple-800">Localidades</div>
                <div class="text-sm text-purple-600">Administrar las localidades disponibles en el formulario</div>
            </div>
        </a>

        <div class="border-t pt-4 mt-2">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Exportar datos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <a href="{{ route('configuracion.exportar.postulantes') }}"
                   class="flex items-center p-4 bg-orange-50 border border-orange-200 rounded-lg hover:bg-orange-100 transition">
                    <span class="text-2xl mr-3">📥</span>
                    <div>
                        <div class="font-semibold text-orange-800">Exportar Postulantes</div>
                        <div class="text-sm text-orange-600">Descargar CSV con todos los postulantes</div>
                    </div>
                </a>

                <a href="{{ route('configuracion.exportar.empresas') }}"
                   class="flex items-center p-4 bg-orange-50 border border-orange-200 rounded-lg hover:bg-orange-100 transition">
                    <span class="text-2xl mr-3">📥</span>
                    <div>
                        <div class="font-semibold text-orange-800">Exportar Empresas</div>
                        <div class="text-sm text-orange-600">Descargar CSV con todas las empresas</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <div class="mt-6">
        <a href="{{ route('index') }}" class="text-sm text-gray-500 hover:underline">← Volver al inicio</a>
    </div>
</div>
@endsection