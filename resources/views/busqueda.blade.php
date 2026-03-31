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
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" value="{{ request('nombre') }}" placeholder="Ej. Juan"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Apellido</label>
                <input type="text" name="apellido" value="{{ request('apellido') }}" placeholder="Ej. Pérez"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Profesión</label>
                <input type="text" name="rubro" value="{{ request('rubro') }}" placeholder="Ej. Electricista"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Edad Mínima</label>
                <input type="number" name="edad_min" value="{{ request('edad_min') }}" placeholder="Ej. 25" min="0"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Edad Máxima</label>
                <input type="number" name="edad_max" value="{{ request('edad_max') }}" placeholder="Ej. 40" min="0"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tipo de Carnet</label>
                <input type="text" name="tipo_carnet" value="{{ request('tipo_carnet') }}" placeholder="Ej. B1"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Certificado Manipulación</label>
                <select name="certificado_check"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="1" {{ request('certificado_check') === '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ request('certificado_check') === '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        <div class="mt-4 text-right space-x-2">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                Filtrar
            </button>
            <a href="{{ route('busqueda') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded hover:bg-gray-400">
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
                    <th class="px-3 py-2 border text-left" style="min-width: 160px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postulantes as $postulante)
                    {{-- Fila resumen --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border">{{ $postulante->nombre }}</td>
                        <td class="px-3 py-2 border">{{ $postulante->apellido }}</td>
                        <td class="px-3 py-2 border">{{ number_format($postulante->dni, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 border">
                            {{ $postulante->fecha_nacimiento ? Carbon::parse($postulante->fecha_nacimiento)->age : 'N/A' }}
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
                            {{ $postulante->certificado_check ? '✓' : '-' }}
                        </td>
                        <td class="px-3 py-2 border">
                            <div class="flex flex-col space-y-1">
                                <button onclick="toggleForm({{ $postulante->id }})"
                                    class="text-left text-blue-600 hover:text-blue-800 text-xs font-medium">
                                    ✏️ Editar
                                </button>
                                @if($postulante->cv_pdf)
                                    <a href="{{ route('postulantes.cv.mostrar', $postulante->id) }}"
                                       target="_blank"
                                       class="text-left text-green-600 hover:text-green-800 text-xs font-medium">
                                        📄 Ver CV
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">Sin CV</span>
                                @endif
                                <form action="{{ route('postulantes.destroy', $postulante->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar a {{ addslashes($postulante->nombre) }} {{ addslashes($postulante->apellido) }}? Esta acción no se puede deshacer.')">
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

                    {{-- Fila de edición inline --}}
                    <tr id="form-row-{{ $postulante->id }}" class="hidden bg-blue-50">
                        <td colspan="10" class="px-4 py-4 border">
                            <form action="{{ route('postulantes.update', $postulante->id) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- 1. Datos personales --}}
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2 mt-1">
                                    👤 Datos personales
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-5">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nombre *</label>
                                        <input type="text" name="nombre" value="{{ $postulante->nombre }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Apellido *</label>
                                        <input type="text" name="apellido" value="{{ $postulante->apellido }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">DNI *</label>
                                        <input type="number" name="dni" value="{{ $postulante->dni }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Fecha de Nacimiento *</label>
                                        <input type="date" name="fecha_nacimiento"
                                            value="{{ $postulante->fecha_nacimiento ? Carbon::parse($postulante->fecha_nacimiento)->format('Y-m-d') : '' }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Email</label>
                                        <input type="email" name="email" value="{{ $postulante->email }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Teléfono</label>
                                        <input type="text" name="telefono" value="{{ $postulante->telefono }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Domicilio</label>
                                        <input type="text" name="domicilio" value="{{ $postulante->domicilio }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Localidad</label>
                                        <input type="text" name="localidad" value="{{ $postulante->localidad }}"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Profesión Principal *</label>
                                        <select name="rubro_id"
                                            class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                                            @foreach($rubros as $r)
                                                <option value="{{ $r->id }}"
                                                    {{ $postulante->rubro_id == $r->id ? 'selected' : '' }}>
                                                    {{ $r->rubro }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- 2. Profesiones adicionales --}}
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">
                                    💼 Profesiones adicionales
                                </p>
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-1 max-h-28 overflow-y-auto border border-gray-200 rounded p-2 bg-white mb-5">
                                    @foreach($rubros as $r)
                                        @if($r->id !== $postulante->rubro_id)
                                            <label class="flex items-center text-xs cursor-pointer hover:bg-gray-50 p-1 rounded">
                                                <input type="checkbox"
                                                       name="rubros_adicionales[]"
                                                       value="{{ $r->id }}"
                                                       class="mr-1"
                                                       {{ $postulante->rubros->contains('id', $r->id) && $r->id !== $postulante->rubro_id ? 'checked' : '' }}>
                                                {{ $r->rubro }}
                                            </label>
                                        @endif
                                    @endforeach
                                </div>

                                {{-- 3. Carnets --}}
                                @if(isset($carnets) && $carnets->count() > 0)
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">
                                    🚗 Carnets de conducir
                                </p>
                                <div class="grid grid-cols-3 md:grid-cols-5 lg:grid-cols-8 gap-1 border border-gray-200 rounded p-2 bg-white mb-5">
                                    @foreach($carnets as $carnet)
                                        <label class="flex items-center text-xs cursor-pointer hover:bg-gray-50 p-1 rounded"
                                               title="{{ $carnet->descripcion }}">
                                            <input type="checkbox"
                                                   name="carnets[]"
                                                   value="{{ $carnet->id }}"
                                                   class="mr-1"
                                                   {{ $postulante->carnets->contains('id', $carnet->id) ? 'checked' : '' }}>
                                            <span class="font-semibold text-blue-700">{{ $carnet->tipo_carnet }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @endif

                                {{-- 4. Estudios --}}
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">
                                    🎓 Estudios
                                </p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                                    @foreach(['primaria' => 'Primaria', 'secundaria' => 'Secundaria', 'terciario' => 'Terciario', 'universidad' => 'Universidad'] as $key => $label)
                                        <div class="bg-white border border-gray-200 rounded p-2 text-xs">
                                            <p class="font-semibold text-gray-700 mb-1">{{ $label }}</p>
                                            <label class="flex items-center mb-1 cursor-pointer">
                                                <input type="checkbox"
                                                       name="estudios_{{ $key }}"
                                                       value="1"
                                                       class="mr-1"
                                                       {{ $postulante->{'estudios_' . $key} ? 'checked' : '' }}>
                                                Completado
                                            </label>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="checkbox"
                                                       name="cursando_{{ $key }}"
                                                       value="1"
                                                       class="mr-1"
                                                       {{ $postulante->{'cursando_' . $key} ? 'checked' : '' }}>
                                                En curso
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-5">
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">
                                        Detalle de estudios
                                    </label>
                                    <textarea name="estudios_cursados" rows="2"
                                        class="w-full border-gray-300 rounded-md shadow-sm text-sm"
                                        placeholder="Títulos, instituciones, certificaciones...">{{ $postulante->estudios_cursados }}</textarea>
                                </div>

                                {{-- 5. Experiencia laboral --}}
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">
                                    💪 Experiencia laboral
                                </p>
                                <div class="mb-5">
                                    <textarea name="experiencia_laboral" rows="3"
                                        class="w-full border-gray-300 rounded-md shadow-sm text-sm"
                                        placeholder="Empleos anteriores, responsabilidades, años de experiencia...">{{ $postulante->experiencia_laboral }}</textarea>
                                </div>

                                {{-- 6. Competencias y foto --}}
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">
                                    ⭐ Competencias y foto
                                </p>
                                <div class="flex flex-wrap gap-6 mb-4">
                                    <label class="flex items-center text-sm cursor-pointer">
                                        <input type="checkbox" name="certificado_check" value="1"
                                               class="mr-2"
                                               {{ $postulante->certificado_check ? 'checked' : '' }}>
                                        🍽️ Certificado de Manipulación
                                    </label>
                                    <label class="flex items-center text-sm cursor-pointer">
                                        <input type="checkbox" name="movilidad_propia" value="1"
                                               class="mr-2"
                                               {{ $postulante->movilidad_propia ? 'checked' : '' }}>
                                        🏍️ Movilidad Propia
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <label class="text-sm font-medium text-gray-700">📷 Foto:</label>
                                        <input type="file" name="foto" accept="image/*"
                                               class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700"
                                               {{ $postulante->foto }}>
                                        <span class="text-xs text-gray-400">(vacío = mantener actual)</span>
                                    </div>
                                </div>

                                {{-- Botones --}}
                                <div class="text-right space-x-2 border-t border-blue-200 pt-3 mt-2">
                                    <button type="button" onclick="toggleForm({{ $postulante->id }})"
                                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 text-sm">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 text-sm font-medium">
                                        💾 Guardar cambios
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