@extends('layouts.app')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded shadow">

    {{-- Formulario de Filtros --}}
    <form action="{{ route('busqueda') }}" method="GET" class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-4">Filtrar Postulantes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {{-- Filtrar por Nombre --}}
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ request('nombre') }}" placeholder="Ej. Juan"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Filtrar por Apellido --}}
            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                <input type="text" name="apellido" id="apellido" value="{{ request('apellido') }}" placeholder="Ej. Pérez"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Filtrar por Profesión --}}
            <div>
                <label for="rubro" class="block text-sm font-medium text-gray-700">Profesión</label>
                <input type="text" name="rubro" id="rubro" value="{{ request('rubro') }}" placeholder="Ej. Electricista"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Edad Mínima --}}
            <div>
                <label for="edad_min" class="block text-sm font-medium text-gray-700">Edad Mínima</label>
                <input type="number" name="edad_min" id="edad_min" value="{{ request('edad_min') }}" placeholder="Ej. 25" min="0"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Edad Máxima --}}
            <div>
                <label for="edad_max" class="block text-sm font-medium text-gray-700">Edad Máxima</label>
                <input type="number" name="edad_max" id="edad_max" value="{{ request('edad_max') }}" placeholder="Ej. 40" min="0"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Tipo de Carnet --}}
            <div>
                <label for="tipo_carnet" class="block text-sm font-medium text-gray-700">Tipo de Carnet</label>
                <input type="text" name="tipo_carnet" id="tipo_carnet" value="{{ request('tipo_carnet') }}" placeholder="Ej. B1"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Certificado --}}
            <div>
                <label for="certificado_check" class="block text-sm font-medium text-gray-700">Certificado Manipulación</label>
                <select name="certificado_check" id="certificado_check"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="1" {{ request('certificado_check') === '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ request('certificado_check') === '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <div class="mt-4 text-right">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Filtrar
            </button>
            <a href="{{ route('busqueda') }}"
                class="ml-2 inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Limpiar filtros
            </a>
        </div>
    </form>

    <h2 class="text-2xl font-bold mb-6">Postulantes Registrados ({{ $postulantes->count() }})</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 border text-left">Nombre</th>
                    <th class="px-3 py-2 border text-left">Apellido</th>
                    <th class="px-3 py-2 border text-left">DNI</th>
                    <th class="px-3 py-2 border text-left">Edad</th>
                    <th class="px-3 py-2 border text-left">Correo</th>
                    <th class="px-3 py-2 border text-left">Profesión</th>
                    <th class="px-3 py-2 border text-left">Localidad</th>
                    <th class="px-3 py-2 border text-left">Carnets</th>
                    <th class="px-3 py-2 border text-left">Certificado</th>
                    <th class="px-3 py-2 border text-left" style="min-width: 200px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postulantes as $postulante)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border">{{ $postulante->nombre }}</td>
                        <td class="px-3 py-2 border">{{ $postulante->apellido }}</td>
                        <td class="px-3 py-2 border">{{ number_format($postulante->dni, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 border">
                            @if($postulante->fecha_nacimiento)
                                {{ Carbon::parse($postulante->fecha_nacimiento)->age }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-3 py-2 border text-xs">{{ $postulante->email }}</td>
                        <td class="px-3 py-2 border">
                            {{ optional($postulante->rubro)->rubro ?? 'Sin rubro' }}
                            @if($postulante->rubros && $postulante->rubros->count() > 1)
                                <span class="text-xs text-gray-500">(+{{ $postulante->rubros->count() - 1 }})</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 border">{{ $postulante->localidad }}</td>
                        <td class="px-3 py-2 border text-xs">
                            @if($postulante->carnets && $postulante->carnets->count() > 0)
                                {{ $postulante->carnets->pluck('tipo_carnet')->join(', ') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-3 py-2 border text-center">
                            @if($postulante->certificado_check)
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 border">
                            <div class="flex flex-col space-y-1">
                                {{-- Botón Editar --}}
                                <button onclick="toggleForm({{ $postulante->id }})"
                                    class="text-left text-blue-600 hover:text-blue-800 text-xs font-medium">
                                    ✏️ Editar
                                </button>
                                
                                {{-- Botón Ver CV --}}
                                @if ($postulante->cv_pdf)
                                    <a href="{{ route('postulantes.cv.mostrar', $postulante->id) }}" 
                                       target="_blank"
                                       class="text-left text-green-600 hover:text-green-800 text-xs font-medium">
                                        📄 Ver CV
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">CV no disponible</span>
                                @endif
                                
                                {{-- Botón Eliminar --}}
                                <form action="{{ route('postulantes.destroy', $postulante->id) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('¿Estás seguro de que querés eliminar este postulante?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-left text-red-600 hover:text-red-800 text-xs font-medium">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- Fila Oculta para Edición --}}
                    <tr id="form-row-{{ $postulante->id }}" class="hidden bg-gray-50">
                        <td colspan="10" class="px-4 py-4 border">
                            <form action="{{ route('postulantes.update', $postulante->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm">Nombre</label>
                                        <input type="text" name="nombre" value="{{ $postulante->nombre }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm">Apellido</label>
                                        <input type="text" name="apellido" value="{{ $postulante->apellido }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm">DNI</label>
                                        <input type="text" name="dni" value="{{ $postulante->dni }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm">Fecha de Nacimiento</label>
                                            <input
                                            type="date"
                                            name="fecha_nacimiento"
                                            value="{{ $postulante->fecha_nacimiento }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm">Correo</label>
                                        <input type="email" name="email" value="{{ $postulante->email }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm">Profesión (Rubro)</label>
                                        <input list="rubros-list-{{ $postulante->id }}" name="rubro"
                                            value="{{ old('rubro', optional($postulante->rubro)->rubro) }}"
                                            placeholder="Elegí o escribí"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <datalist id="rubros-list-{{ $postulante->id }}">
                                            @foreach($rubros as $r)
                                                <option value="{{ $r->rubro }}"></option>
                                            @endforeach
                                        </datalist>
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm">Localidad</label>
                                        <input type="text" name="localidad" value="{{ $postulante->localidad }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm">Certificado Manipulación</label>
                                        <select name="certificado_check"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            <option value="1" {{ $postulante->certificado_check ? 'selected' : '' }}>Sí</option>
                                            <option value="0" {{ !$postulante->certificado_check ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right mt-4">
                                    <button type="button" onclick="toggleForm({{ $postulante->id }})"
                                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 mr-2">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleForm(id) {
        const row = document.getElementById('form-row-' + id);
        row.classList.toggle('hidden');
    }
</script>
@endsection