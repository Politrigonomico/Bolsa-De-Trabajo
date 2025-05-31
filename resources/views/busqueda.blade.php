@extends('layouts.app')

{{-- Necesitamos Carbon para calcular la edad --}}
@php
    use Carbon\Carbon;
@endphp

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">

    {{-- ========== Formulario de Filtros ========== --}}
    <form action="{{ route('busqueda') }}" method="GET" class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-4">Filtrar Postulantes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {{-- Filtrar por Nombre --}}
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    value="{{ request('nombre') }}"
                    placeholder="Ej. Juan"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            {{-- Filtrar por Apellido --}}
            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                <input
                    type="text"
                    name="apellido"
                    id="apellido"
                    value="{{ request('apellido') }}"
                    placeholder="Ej. Pérez"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            {{-- Filtrar por Profesión (Rubro) --}}
            <div>
                <label for="rubro" class="block text-sm font-medium text-gray-700">Profesión</label>
                <input
                    type="text"
                    name="rubro"
                    id="rubro"
                    value="{{ request('rubro') }}"
                    placeholder="Ej. Electricista"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            {{-- FILTRO POR RANGO DE EDAD: edad_min y edad_max --}}
            <div>
                <label for="edad_min" class="block text-sm font-medium text-gray-700">Edad Mínima</label>
                <input type="number" name="edad_min" id="edad_min" value="{{ request('edad_min') }}" placeholder="Ej. 25" min="0"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="edad_max" class="block text-sm font-medium text-gray-700">Edad Máxima</label>
                <input type="number" name="edad_max" id="edad_max" value="{{ request('edad_max') }}" placeholder="Ej. 40" min="0"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Filtrar por Tipo de Carnet --}}
            <div>
                <label for="tipo_carnet" class="block text-sm font-medium text-gray-700">Tipo de Carnet</label>
                <input
                    type="text"
                    name="tipo_carnet"
                    id="tipo_carnet"
                    value="{{ request('tipo_carnet') }}"
                    placeholder="Ej. B1"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            {{-- Filtrar por Certificado Manipulación de Alimentos --}}
            <div>
                <label for="certificado_check" class="block text-sm font-medium text-gray-700">Certificado Manipulación</label>
                <select
                    name="certificado_check"
                    id="certificado_check"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">Todos</option>
                    <option value="1" {{ request('certificado_check') === '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ request('certificado_check') === '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <div class="mt-4 text-right">
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Filtrar
            </button>
            <a
                href="{{ route('busqueda') }}"
                class="ml-2 inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
            >
                Limpiar filtros
            </a>
        </div>
    </form>
    {{-- ========== Fin Formulario de Filtros ========== --}}

    <h2 class="text-2xl font-bold mb-6">Postulantes Registrados</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Apellido</th>
                    <th class="px-4 py-2 border">DNI</th>
                    <th class="px-4 py-2 border">Edad</th>
                    <th class="px-4 py-2 border">Correo</th>
                    <th class="px-4 py-2 border">Profesión</th>
                    <th class="px-4 py-2 border">Localidad</th>
                    <th class="px-4 py-2 border">Tipo de Carnet</th>
                    <th class="px-4 py-2 border">Certificado Manipulación</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postulantes as $postulante)
                    <tr>
                        <td class="px-4 py-2 border">{{ $postulante->nombre }}</td>
                        <td class="px-4 py-2 border">{{ $postulante->apellido }}</td>
                        <td class="px-4 py-2 border">{{ $postulante->dni }}</td>

                        {{-- Calculamos la edad a partir de la fecha de nacimiento --}}
                        <td class="px-4 py-2 border">
                            @if($postulante->fecha_nacimiento)
                                {{ Carbon::parse($postulante->fecha_nacimiento)->age }}
                            @else
                                N/A
                            @endif
                        </td>

                        <td class="px-4 py-2 border">{{ $postulante->email }}</td>

                        {{-- Profesión / Rubro relacionado --}}
                        <td class="px-4 py-2 border">
                            {{ optional($postulante->rubro)->rubro ?? 'Sin rubro' }}
                        </td>

                        <td class="px-4 py-2 border">{{ $postulante->localidad }}</td>
                        <td class="px-4 py-2 border">{{ $postulante->tipo_carnet }}</td>

                        {{-- Mostramos Sí/No según el campo booleano --}}
                        <td class="px-4 py-2 border">
                            @if($postulante->certificado_check)
                                Sí
                            @else
                                No
                            @endif
                        </td>

                        <td class="px-4 py-2 border">
                            {{-- Botón para mostrar/ocultar el formulario de edición --}}
                            <button
                                onclick="toggleForm({{ $postulante->id }})"
                                class="text-blue-600 hover:underline"
                            >
                                ✏️ Editar
                            </button>

                            <form
                                action="{{ route('postulantes.destroy', $postulante->id) }}"
                                method="POST"
                                class="inline ml-2"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="text-red-600 hover:underline"
                                    onclick="return confirm('¿Estás seguro de que querés eliminar este postulante?')"
                                >
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- ========== Fila Oculta para el Formulario de Edición ========== --}}
                    <tr id="form-row-{{ $postulante->id }}" class="hidden bg-gray-50">
                        <td colspan="10" class="px-4 py-4 border">
                            <form
                                action="{{ route('postulantes.update', $postulante->id) }}"
                                method="POST"
                                class="space-y-4"
                            >
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    {{-- Nombre --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">Nombre</label>
                                        <input
                                            type="text"
                                            name="nombre"
                                            value="{{ $postulante->nombre }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </div>

                                    {{-- Apellido --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">Apellido</label>
                                        <input
                                            type="text"
                                            name="apellido"
                                            value="{{ $postulante->apellido }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </div>

                                    {{-- DNI --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">DNI</label>
                                        <input
                                            type="text"
                                            name="dni"
                                            value="{{ $postulante->dni }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </div>

                                    {{-- Fecha de Nacimiento (para calcular edad) --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">Fecha de Nacimiento</label>
                                        <input
                                            type="date"
                                            name="fecha_nacimiento"
                                            value="{{ $postulante->fecha_nacimiento }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </div>

                                    {{-- Correo --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">Correo</label>
                                        <input
                                            type="email"
                                            name="email"
                                            value="{{ $postulante->email }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </div>

                                    {{-- Profesión / Rubro --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">Profesión</label>
                                        <input
                                            type="text"
                                            name="rubro"
                                            value="{{ optional($postulante->rubro)->rubro ?? '' }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </div>

                                    {{-- Localidad --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">Localidad</label>
                                        <input
                                            type="text"
                                            name="localidad"
                                            value="{{ $postulante->localidad }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </div>

                                    {{-- Tipo de Carnet --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">Tipo de Carnet</label>
                                        <input
                                            type="text"
                                            name="tipo_carnet"
                                            value="{{ $postulante->tipo_carnet }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </div>

                                    {{-- Certificado Manipulación de Alimentos --}}
                                    <div>
                                        <label class="block font-semibold text-gray-700">Certificado Manipulación</label>
                                        <select
                                            name="certificado_check"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        >
                                            <option value="1" {{ $postulante->certificado_check ? 'selected' : '' }}>
                                                Sí
                                            </option>
                                            <option value="0" {{ !$postulante->certificado_check ? 'selected' : '' }}>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button
                                        type="submit"
                                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                    >
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    {{-- ========== Fin Fila Oculta ========== --}}
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Script mínimo para toggle --}}
<script>
    function toggleForm(id) {
        const row = document.getElementById('form-row-' + id);
        row.classList.toggle('hidden');
    }
</script>
@endsection
