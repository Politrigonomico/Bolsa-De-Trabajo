@extends('layouts.app')

@section('title', 'Informes Avanzados de Postulantes')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-lg">

    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-orange-600 mb-2">📊 Informes Avanzados de Postulantes</h1>
        <p class="text-gray-600">Genere informes detallados con múltiples filtros y estadísticas</p>
    </div>

    {{-- Filtros Avanzados --}}
    <form method="GET" action="{{ route('informes.filtrar') }}" class="mb-8 bg-gray-50 p-6 rounded-lg">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">🔍 Filtros de Búsqueda</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            {{-- Filtros de fecha --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="fecha_desde">Fecha Desde:</label>
                <input type="date" name="fecha_desde" id="fecha_desde" 
                       value="{{ request('fecha_desde') }}" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500" />
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="fecha_hasta">Fecha Hasta:</label>
                <input type="date" name="fecha_hasta" id="fecha_hasta" 
                       value="{{ request('fecha_hasta') }}" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500" />
            </div>

            {{-- Filtros demográficos --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="sexo">Sexo:</label>
                <select name="sexo" id="sexo" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500">
                    <option value="">Todos</option>
                    <option value="Femenino" @selected(request('sexo') == 'Femenino')>Femenino</option>
                    <option value="Masculino" @selected(request('sexo') == 'Masculino')>Masculino</option>
                    <option value="Otro" @selected(request('sexo') == 'Otro')>Otro</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="localidad">Localidad:</label>
                <input type="text" name="localidad" id="localidad" 
                       value="{{ request('localidad') }}" 
                       placeholder="Filtrar por localidad"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500" />
            </div>

            {{-- Filtros de edad --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="edad_desde">Edad Desde:</label>
                <input type="number" min="0" max="100" name="edad_desde" id="edad_desde" 
                       value="{{ request('edad_desde') }}" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500" />
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="edad_hasta">Edad Hasta:</label>
                <input type="number" min="0" max="100" name="edad_hasta" id="edad_hasta" 
                       value="{{ request('edad_hasta') }}" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500" />
            </div>

            {{-- Filtros profesionales --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="rubro_id">Rubro/Profesión:</label>
                <select name="rubro_id" id="rubro_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500">
                    <option value="">Todos</option>
                    @foreach ($rubros as $rubro)
                        <option value="{{ $rubro->id }}" @selected(request('rubro_id') == $rubro->id)>{{ $rubro->rubro }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="nivel_educativo">Nivel Educativo:</label>
                <select name="nivel_educativo" id="nivel_educativo" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500">
                    <option value="">Todos</option>
                    <option value="primaria" @selected(request('nivel_educativo') == 'primaria')>Primaria Completa</option>
                    <option value="secundaria" @selected(request('nivel_educativo') == 'secundaria')>Secundaria Completa</option>
                    <option value="terciario" @selected(request('nivel_educativo') == 'terciario')>Terciario Completo</option>
                    <option value="universidad" @selected(request('nivel_educativo') == 'universidad')>Universidad Completa</option>
                    <option value="cursando" @selected(request('nivel_educativo') == 'cursando')>Estudiando Actualmente</option>
                </select>
            </div>

            {{-- Filtros de competencias --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="certificado">Certificado Manipulación:</label>
                <select name="certificado" id="certificado" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500">
                    <option value="">Todos</option>
                    <option value="1" @selected(request('certificado') == '1')>Con Certificado</option>
                    <option value="0" @selected(request('certificado') == '0')>Sin Certificado</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="carnet">Carnet de Conducir:</label>
                <select name="carnet" id="carnet" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500">
                    <option value="">Todos</option>
                    <option value="1" @selected(request('carnet') == '1')>Con Carnet</option>
                    <option value="0" @selected(request('carnet') == '0')>Sin Carnet</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700" for="movilidad">Movilidad Propia:</label>
                <select name="movilidad" id="movilidad" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500">
                    <option value="">Todos</option>
                    <option value="1" @selected(request('movilidad') == '1')>Con Movilidad</option>
                    <option value="0" @selected(request('movilidad') == '0')>Sin Movilidad</option>
                </select>
            </div>
        </div>

        {{-- Botones de acción --}}
        <div class="flex flex-wrap gap-3 justify-center">
            <button type="submit" class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 font-semibold transition-all duration-200 transform hover:scale-105">
                🔍 Generar Informe
            </button>
            <a href="{{ route('informes.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 font-semibold transition-all duration-200">
                🔄 Limpiar Filtros
            </a>
            @if(isset($postulantes))
                <a href="{{ route('informes.pdf', request()->all()) }}" 
                   class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-semibold transition-all duration-200">
                    📄 Descargar PDF
                </a>
                <button type="button" onclick="exportarExcel()" 
                        class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 font-semibold transition-all duration-200">
                    📊 Exportar Excel
                </button>
            @endif
        </div>
    </form>

    {{-- Resultados del Informe --}}
    @if(isset($estadisticas) && $estadisticas['total'] > 0)
        <div class="mb-8">
            {{-- Resumen Ejecutivo --}}
            <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white p-6 rounded-lg mb-6">
                <h2 class="text-2xl font-bold mb-4">📈 Resumen Ejecutivo</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                        <div class="text-3xl font-bold">{{ number_format($estadisticas['total']) }}</div>
                        <div class="text-sm opacity-90">Total Postulantes</div>
                    </div>
                    <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                        <div class="text-3xl font-bold">{{ $estadisticas['total_mujeres'] }}</div>
                        <div class="text-sm opacity-90">Mujeres ({{ $estadisticas['total'] > 0 ? round(($estadisticas['total_mujeres']/$estadisticas['total'])*100, 1) : 0 }}%)</div>
                    </div>
                    <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                        <div class="text-3xl font-bold">{{ $estadisticas['total_hombres'] }}</div>
                        <div class="text-sm opacity-90">Hombres ({{ $estadisticas['total'] > 0 ? round(($estadisticas['total_hombres']/$estadisticas['total'])*100, 1) : 0 }}%)</div>
                    </div>
                    <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                        <div class="text-3xl font-bold">{{ $estadisticas['con_certificado'] }}</div>
                        <div class="text-sm opacity-90">Con Certificado Manipulación</div>
                    </div>
                </div>
            </div>

            {{-- Gráficos y Estadísticas Detalladas --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                {{-- Top Profesiones --}}
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">🏆 Top Profesiones</h3>
                    @if($estadisticas['por_rubro']->count() > 0)
                        <div class="space-y-3">
                            @foreach($estadisticas['por_rubro']->take(10) as $rubro => $cantidad)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-700">{{ $rubro ?: 'Sin especificar' }}</span>
                                    <div class="flex items-center space-x-2">
                                        <div class="bg-orange-200 rounded-full h-2 w-24 relative">
                                            <div class="bg-orange-500 h-2 rounded-full" 
                                                 style="width: {{ ($cantidad / $estadisticas['por_rubro']->first()) * 100 }}%"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-orange-600">{{ $cantidad }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No hay datos disponibles</p>
                    @endif
                </div>

                {{-- Distribución por Edad --}}
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">📊 Distribución por Edad</h3>
                    @if($estadisticas['por_edad']->count() > 0)
                        <div class="space-y-3">
                            @foreach($estadisticas['por_edad'] as $rango => $cantidad)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-700">{{ $rango }} años</span>
                                    <div class="flex items-center space-x-2">
                                        <div class="bg-blue-200 rounded-full h-2 w-24 relative">
                                            <div class="bg-blue-500 h-2 rounded-full" 
                                                 style="width: {{ ($cantidad / $estadisticas['por_edad']->max()) * 100 }}%"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-blue-600">{{ $cantidad }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No hay datos disponibles</p>
                    @endif
                </div>

                {{-- Competencias y Certificaciones --}}
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">🎯 Competencias</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Certificado Manipulación</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $estadisticas['con_certificado'] }} ({{ $estadisticas['total'] > 0 ? round(($estadisticas['con_certificado']/$estadisticas['total'])*100, 1) : 0 }}%)
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Movilidad Propia</span>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $estadisticas['con_movilidad'] }} ({{ $estadisticas['total'] > 0 ? round(($estadisticas['con_movilidad']/$estadisticas['total'])*100, 1) : 0 }}%)
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Carnet de Conducir</span>
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $estadisticas['con_carnet'] }} ({{ $estadisticas['total'] > 0 ? round(($estadisticas['con_carnet']/$estadisticas['total'])*100, 1) : 0 }}%)
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Nivel Educativo --}}
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">🎓 Nivel Educativo</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Universidad Completa</span>
                            <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $estadisticas['educacion']['universidad_completa'] }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Terciario Completo</span>
                            <span class="bg-teal-100 text-teal-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $estadisticas['educacion']['terciario_completo'] }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Secundaria Completa</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $estadisticas['educacion']['secundaria_completa'] }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Estudiando Actualmente</span>
                            <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $estadisticas['educacion']['cursando'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabla de Resultados Detallados --}}
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">📋 Detalles de Postulantes ({{ $estadisticas['total'] }} resultados)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-orange-600 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Nombre</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">DNI</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Edad</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Sexo</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Profesión</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Localidad</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Competencias</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postulantes->take(50) as $postulante)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900">{{ $postulante->nombre }} {{ $postulante->apellido }}</div>
                                        <div class="text-sm text-gray-500">{{ $postulante->email }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ number_format($postulante->dni, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->age }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $postulante->sexo }}</td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-900">{{ $postulante->rubro->rubro ?? 'Sin Rubro' }}</div>
                                        @if($postulante->rubros && $postulante->rubros->count() > 1)
                                            <div class="text-xs text-gray-500">
                                                +{{ $postulante->rubros->count() - 1 }} más
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $postulante->localidad }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-1">
                                            @if($postulante->certificado_check)
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Certificado</span>
                                            @endif
                                            @if($postulante->movilidad_propia)
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Movilidad</span>
                                            @endif
                                            @if($postulante->carnets && $postulante->carnets->count() > 0)
                                                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">
                                                    {{ $postulante->carnets->pluck('tipo_carnet')->join(', ') }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $postulante->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($postulantes->count() > 50)
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-center text-sm text-gray-600">
                        Se muestran los primeros 50 resultados de {{ $postulantes->count() }} total. 
                        <a href="{{ route('informes.pdf', request()->all()) }}" class="text-orange-600 hover:underline">Descargar PDF completo</a>
                    </div>
                @endif
            </div>
        </div>
    @elseif(isset($postulantes))
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No se encontraron resultados</h3>
            <p class="text-gray-500">Intente ajustar los filtros de búsqueda</p>
        </div>
    @endif

</div>

<script>
function exportarExcel() {
    // Crear una tabla HTML con los datos para exportar
    let table = document.querySelector('table');
    if (!table) return;
    
    let html = table.outerHTML;
    
    // Crear blob y descargar
    let blob = new Blob([html], {
        type: 'application/vnd.ms-excel'
    });
    
    let url = window.URL.createObjectURL(blob);
    let a = document.createElement('a');
    a.href = url;
    a.download = 'informe_postulantes_' + new Date().toISOString().slice(0,10) + '.xls';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

// Auto-guardar filtros en localStorage
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input, select');
    
    // Cargar filtros guardados
    inputs.forEach(input => {
        const saved = localStorage.getItem('filtro_' + input.name);
        if (saved && !input.value) {
            input.value = saved;
        }
    });
    
    // Guardar filtros al cambiar
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value) {
                localStorage.setItem('filtro_' + this.name, this.value);
            } else {
                localStorage.removeItem('filtro_' + this.name);
            }
        });
    });
});
</script>

@endsection