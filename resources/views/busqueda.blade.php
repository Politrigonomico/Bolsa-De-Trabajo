@extends('layouts.app')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded shadow">

    {{-- ══════════════════════════════════════════
         PANEL DE FILTROS
    ══════════════════════════════════════════ --}}
    <form action="{{ route('busqueda') }}" method="GET"
          class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">

        {{-- Campo oculto para "mostrar todos" --}}
        @if(request('mostrar_todos'))
            <input type="hidden" name="mostrar_todos" value="1">
        @endif

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Filtrar Postulantes</h3>
            @if(request()->hasAny(['nombre','apellido','rubro_id','edad_min','edad_max','sexo','localidad','carnets','certificado_check','movilidad_propia']))
                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-medium">
                    Filtros activos
                </span>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ request('nombre') }}"
                       placeholder="Ej. Juan"
                       class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Apellido --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                <input type="text" name="apellido" value="{{ request('apellido') }}"
                       placeholder="Ej. Pérez"
                       class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Profesión — desplegable --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Profesión</label>
                <select name="rubro_id"
                        class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todas las profesiones</option>
                    @foreach($rubros as $r)
                        <option value="{{ $r->id }}" {{ request('rubro_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->rubro }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Sexo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
                <select name="sexo"
                        class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="Masculino" {{ request('sexo') === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino"  {{ request('sexo') === 'Femenino'  ? 'selected' : '' }}>Femenino</option>
                    <option value="Otro"      {{ request('sexo') === 'Otro'      ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            {{-- Localidad --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Localidad</label>
                <input type="text" name="localidad" value="{{ request('localidad') }}"
                       placeholder="Ej. Arroyo Seco"
                       class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Edad mínima --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Edad mínima</label>
                <input type="number" name="edad_min" value="{{ request('edad_min') }}"
                       placeholder="Ej. 25" min="0" max="99"
                       class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Edad máxima --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Edad máxima</label>
                <input type="number" name="edad_max" value="{{ request('edad_max') }}"
                       placeholder="Ej. 40" min="0" max="99"
                       class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Certificado --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Certificado Manipulación</label>
                <select name="certificado_check"
                        class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="1" {{ request('certificado_check') === '1' ? 'selected' : '' }}>Con certificado</option>
                    <option value="0" {{ request('certificado_check') === '0' ? 'selected' : '' }}>Sin certificado</option>
                </select>
            </div>

            {{-- Movilidad --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Movilidad propia</label>
                <select name="movilidad_propia"
                        class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="1" {{ request('movilidad_propia') === '1' ? 'selected' : '' }}>Con movilidad</option>
                    <option value="0" {{ request('movilidad_propia') === '0' ? 'selected' : '' }}>Sin movilidad</option>
                </select>
            </div>

        </div>

        {{-- Carnets — dropdown con checkboxes --}}
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Carnets de conducir</label>
            <div class="relative" x-data="{ open: false }">
                <button type="button"
                        @click="open = !open"
                        class="w-full md:w-auto min-w-64 flex items-center justify-between border border-gray-300 rounded-md shadow-sm px-3 py-2 bg-white text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span>
                        @php
                            $carnetsFiltro = request()->input('carnets', []);
                            $carnetsFiltro = is_array($carnetsFiltro) ? $carnetsFiltro : [];
                        @endphp
                        @if(count($carnetsFiltro) > 0)
                            {{ count($carnetsFiltro) }} carnet(s) seleccionado(s)
                        @else
                            Seleccionar carnets...
                        @endif
                    </span>
                    <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open"
                     @click.away="open = false"
                     x-cloak
                     class="absolute z-20 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg p-3"
                     style="min-width: 280px;">
                    <p class="text-xs text-gray-500 mb-2">Marcá los carnets que querés buscar:</p>
                    <div class="grid grid-cols-2 gap-1 max-h-48 overflow-y-auto">
                        @foreach($carnets as $carnet)
                            <label class="flex items-center gap-2 text-sm cursor-pointer hover:bg-gray-50 p-1.5 rounded">
                                <input type="checkbox"
                                       name="carnets[]"
                                       value="{{ $carnet->id }}"
                                       class="rounded border-gray-300 text-blue-600"
                                       {{ in_array($carnet->id, $carnetsFiltro) ? 'checked' : '' }}>
                                <span>
                                    <span class="font-semibold text-blue-700">{{ $carnet->tipo_carnet }}</span>
                                    @if($carnet->descripcion)
                                        <span class="text-gray-400 text-xs block leading-tight">{{ Str::limit($carnet->descripcion, 30) }}</span>
                                    @endif
                                </span>
                            </label>
                        @endforeach
                    </div>
                    <div class="mt-2 pt-2 border-t border-gray-100 flex justify-between">
                        <button type="button"
                                onclick="document.querySelectorAll('input[name=\'carnets[]\']').forEach(c => c.checked = false)"
                                class="text-xs text-gray-500 hover:text-gray-700">
                            Limpiar
                        </button>
                        <button type="button" @click="open = false"
                                class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                            Listo ✓
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Acciones --}}
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                @if(request()->hasAny(['nombre','apellido','rubro_id','edad_min','edad_max','sexo','localidad','carnets','certificado_check','movilidad_propia']) || request('mostrar_todos'))
                    <a href="{{ route('busqueda') }}"
                       class="text-xs text-red-500 hover:text-red-700 font-medium">
                        ✕ Limpiar filtros
                    </a>
                @endif
            </div>
            <div class="flex items-center gap-2">
                {{-- Mostrar todos --}}
                <a href="{{ route('busqueda', ['mostrar_todos' => 1]) }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 border border-gray-300 transition">
                    👥 Mostrar todos
                </a>
                {{-- Filtrar --}}
                <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Filtrar
                </button>
            </div>
        </div>
    </form>

    {{-- ══════════════════════════════════════════
         RESULTADOS
    ══════════════════════════════════════════ --}}

    @php
        $hayFiltros    = request()->hasAny(['nombre','apellido','rubro_id','edad_min','edad_max','sexo','localidad','carnets','certificado_check','movilidad_propia']);
        $mostrarTodos  = request('mostrar_todos');
        $mostrarTabla  = $hayFiltros || $mostrarTodos;
    @endphp

    @if($mostrarTabla)

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">
                {{ $mostrarTodos && !$hayFiltros ? 'Todos los postulantes' : 'Resultados' }}
                <span class="text-base font-normal text-gray-500">
                    ({{ $postulantes->count() }} postulante{{ $postulantes->count() !== 1 ? 's' : '' }})
                </span>
            </h2>
        </div>

        @if($postulantes->isEmpty())
            <div class="text-center py-12 bg-gray-50 rounded-lg border border-gray-200">
                <div class="text-4xl mb-3">🔍</div>
                <p class="text-gray-600 font-medium">No se encontraron postulantes con esos filtros.</p>
                <p class="text-gray-400 text-sm mt-1">Intentá con otros criterios de búsqueda.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 border text-left">Nombre</th>
                            <th class="px-3 py-2 border text-left">Apellido</th>
                            <th class="px-3 py-2 border text-left">DNI</th>
                            <th class="px-3 py-2 border text-left">Edad</th>
                            <th class="px-3 py-2 border text-left">Sexo</th>
                            <th class="px-3 py-2 border text-left">Correo</th>
                            <th class="px-3 py-2 border text-left">Profesión</th>
                            <th class="px-3 py-2 border text-left">Localidad</th>
                            <th class="px-3 py-2 border text-left">Carnets</th>
                            <th class="px-3 py-2 border text-left">Certif.</th>
                            <th class="px-3 py-2 border text-left">Movilidad</th>
                            <th class="px-3 py-2 border text-left" style="min-width:160px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postulantes as $postulante)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2 border">{{ $postulante->nombre }}</td>
                                <td class="px-3 py-2 border">{{ $postulante->apellido }}</td>
                                <td class="px-3 py-2 border">{{ number_format($postulante->dni, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 border text-center">
                                    {{ $postulante->fecha_nacimiento ? Carbon::parse($postulante->fecha_nacimiento)->age : 'N/A' }}
                                </td>
                                <td class="px-3 py-2 border">{{ $postulante->sexo ?? '-' }}</td>
                                <td class="px-3 py-2 border text-xs">{{ $postulante->email }}</td>
                                <td class="px-3 py-2 border">
                                    {{ optional($postulante->rubro)->rubro ?? 'Sin rubro' }}
                                    @if($postulante->rubros && $postulante->rubros->count() > 1)
                                        <span class="text-xs text-gray-400">(+{{ $postulante->rubros->count() - 1 }})</span>
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
                                <td class="px-3 py-2 border text-center">
                                    {{ $postulante->movilidad_propia ? '✓' : '-' }}
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

                            {{-- Fila edición inline --}}
                            <tr id="form-row-{{ $postulante->id }}" class="hidden bg-blue-50">
                                <td colspan="12" class="px-4 py-4 border">
                                    <form action="{{ route('postulantes.update', $postulante->id) }}"
                                          method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        {{-- 1. Datos personales --}}
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2 mt-1">👤 Datos personales</p>
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
                                                        <option value="{{ $r->id }}" {{ $postulante->rubro_id == $r->id ? 'selected' : '' }}>
                                                            {{ $r->rubro }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- 2. Profesiones adicionales --}}
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">💼 Profesiones adicionales</p>
                                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-1 max-h-28 overflow-y-auto border border-gray-200 rounded p-2 bg-white mb-5">
                                            @foreach($rubros as $r)
                                                @if($r->id !== $postulante->rubro_id)
                                                    <label class="flex items-center text-xs cursor-pointer hover:bg-gray-50 p-1 rounded">
                                                        <input type="checkbox" name="rubros_adicionales[]" value="{{ $r->id }}"
                                                               class="mr-1"
                                                               {{ $postulante->rubros->contains('id', $r->id) && $r->id !== $postulante->rubro_id ? 'checked' : '' }}>
                                                        {{ $r->rubro }}
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>

                                        {{-- 3. Carnets --}}
                                        @if(isset($carnets) && $carnets->count() > 0)
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">🚗 Carnets de conducir</p>
                                        <div class="grid grid-cols-3 md:grid-cols-5 lg:grid-cols-8 gap-1 border border-gray-200 rounded p-2 bg-white mb-5">
                                            @foreach($carnets as $carnet)
                                                <label class="flex items-center text-xs cursor-pointer hover:bg-gray-50 p-1 rounded"
                                                       title="{{ $carnet->descripcion }}">
                                                    <input type="checkbox" name="carnets[]" value="{{ $carnet->id }}"
                                                           class="mr-1"
                                                           {{ $postulante->carnets->contains('id', $carnet->id) ? 'checked' : '' }}>
                                                    <span class="font-semibold text-blue-700">{{ $carnet->tipo_carnet }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @endif

                                        {{-- 4. Estudios --}}
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">🎓 Estudios</p>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                                            @foreach(['primaria'=>'Primaria','secundaria'=>'Secundaria','terciario'=>'Terciario','universidad'=>'Universidad'] as $key => $label)
                                                <div class="bg-white border border-gray-200 rounded p-2 text-xs">
                                                    <p class="font-semibold text-gray-700 mb-1">{{ $label }}</p>
                                                    <label class="flex items-center mb-1 cursor-pointer">
                                                        <input type="checkbox" name="estudios_{{ $key }}" value="1" class="mr-1"
                                                               {{ $postulante->{'estudios_'.$key} ? 'checked' : '' }}>
                                                        Completado
                                                    </label>
                                                    <label class="flex items-center cursor-pointer">
                                                        <input type="checkbox" name="cursando_{{ $key }}" value="1" class="mr-1"
                                                               {{ $postulante->{'cursando_'.$key} ? 'checked' : '' }}>
                                                        En curso
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mb-5">
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Detalle de estudios</label>
                                            <textarea name="estudios_cursados" rows="2"
                                                class="w-full border-gray-300 rounded-md shadow-sm text-sm"
                                                placeholder="Títulos, instituciones, certificaciones...">{{ $postulante->estudios_cursados }}</textarea>
                                        </div>

                                        {{-- 5. Experiencia --}}
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">💪 Experiencia laboral</p>
                                        <div class="mb-5">
                                            <textarea name="experiencia_laboral" rows="3"
                                                class="w-full border-gray-300 rounded-md shadow-sm text-sm"
                                                placeholder="Empleos anteriores, responsabilidades...">{{ $postulante->experiencia_laboral }}</textarea>
                                        </div>

                                        {{-- 6. Competencias y foto --}}
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">⭐ Competencias y foto</p>
                                        <div class="flex flex-wrap gap-6 mb-4">
                                            <label class="flex items-center text-sm cursor-pointer">
                                                <input type="checkbox" name="certificado_check" value="1" class="mr-2"
                                                       {{ $postulante->certificado_check ? 'checked' : '' }}>
                                                🍽️ Certificado de Manipulación
                                            </label>
                                            <label class="flex items-center text-sm cursor-pointer">
                                                <input type="checkbox" name="movilidad_propia" value="1" class="mr-2"
                                                       {{ $postulante->movilidad_propia ? 'checked' : '' }}>
                                                🏍️ Movilidad Propia
                                            </label>
                                            <div class="flex items-center gap-2">
                                                <label class="text-sm font-medium text-gray-700">📷 Foto:</label>
                                                <input type="file" name="foto" accept="image/*"
                                                       class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700">
                                                <span class="text-xs text-gray-400">(vacío = mantener actual)</span>
                                            </div>
                                        </div>

                                        <div class="text-right space-x-2 border-t border-blue-200 pt-3">
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
        @endif

    @else
        {{-- Estado inicial sin filtros --}}
        <div class="text-center py-16 text-gray-400">
            <div class="text-5xl mb-4">🔍</div>
            <p class="text-lg font-medium text-gray-500">Usá los filtros para buscar postulantes</p>
            <p class="text-sm mt-1">O hacé clic en <strong class="text-gray-600">👥 Mostrar todos</strong> para ver el listado completo</p>
        </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>[x-cloak] { display: none !important; }</style>

<script>
function toggleForm(id) {
    document.getElementById('form-row-' + id).classList.toggle('hidden');
}
</script>
@endsection