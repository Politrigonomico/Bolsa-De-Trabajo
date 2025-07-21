@extends('layouts.app')

@section('title', 'Informe de Postulantes')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-6 text-center text-orange-600">Informe de Postulantes</h1>

    <form method="GET" action="{{ route('informes.filtrar') }}" class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">

        <div>
            <label class="block font-semibold mb-1" for="fecha_desde">Fecha Desde:</label>
            <input type="date" name="fecha_desde" id="fecha_desde" value="{{ request('fecha_desde') }}" class="w-full border rounded px-3 py-2" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="fecha_hasta">Fecha Hasta:</label>
            <input type="date" name="fecha_hasta" id="fecha_hasta" value="{{ request('fecha_hasta') }}" class="w-full border rounded px-3 py-2" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="sexo">Sexo:</label>
            <select name="sexo" id="sexo" class="w-full border rounded px-3 py-2">
                <option value="">Todos</option>
                <option value="F" @selected(request('sexo') == 'mujer')>Mujer</option>
                <option value="M" @selected(request('sexo') == 'hombre')>Hombre</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1" for="edad_desde">Edad Desde:</label>
            <input type="number" min="0" name="edad_desde" id="edad_desde" value="{{ request('edad_desde') }}" class="w-full border rounded px-3 py-2" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="edad_hasta">Edad Hasta:</label>
            <input type="number" min="0" name="edad_hasta" id="edad_hasta" value="{{ request('edad_hasta') }}" class="w-full border rounded px-3 py-2" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="rubro_id">Rubro:</label>
            <select name="rubro_id" id="rubro_id" class="w-full border rounded px-3 py-2">
                <option value="">Todos</option>
                @foreach ($rubros as $rubro)
                    <option value="{{ $rubro->id }}" @selected(request('rubro_id') == $rubro->id)>{{ $rubro->rubro }}</option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-3 mt-4">
            <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700">
                Realizar Informe
            </button>
        </div>

    </form>

    @if(isset($postulantes) && $postulantes->count() > 0)
        <a href="{{ route('informes.pdf', request()->all()) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-6">
            Descargar PDF
        </a>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Resumen</h2>
            <p>Total Postulantes encontrados: <strong>{{ $postulantes->count() }}</strong></p>
            <p>Mujeres: <strong>{{ $total_mujeres }}</strong></p>
            <p>Hombres: <strong>{{ $total_hombres }}</strong></p>

            <h3 class="mt-4 font-semibold">Cantidad por Rubro:</h3>
            <ul class="list-disc list-inside">
                @foreach ($porRubro as $nombre => $cantidad)
                    <li>{{ $nombre }}: {{ $cantidad }}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Detalles de Postulantes</h2>
            <table class="w-full border-collapse border border-gray-300 text-left">
                <thead class="bg-orange-600 text-white">
                    <tr>
                        <th class="border border-gray-300 px-3 py-1">Nombre</th>
                        <th class="border border-gray-300 px-3 py-1">Apellido</th>
                        <th class="border border-gray-300 px-3 py-1">DNI</th>
                        <th class="border border-gray-300 px-3 py-1">Sexo</th>
                        <th class="border border-gray-300 px-3 py-1">Edad</th>
                        <th class="border border-gray-300 px-3 py-1">Rubro</th>
                        <th class="border border-gray-300 px-3 py-1">Fecha Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postulantes as $postulante)
                        <tr class="odd:bg-gray-50 even:bg-white">
                            <td class="border border-gray-300 px-3 py-1">{{ $postulante->nombre }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ $postulante->apellido }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ $postulante->dni }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ ucfirst($postulante->sexo) }}</td>
                            <td class="border border-gray-300 px-3 py-1">
                                {{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->age }}
                            </td>
                            <td class="border border-gray-300 px-3 py-1">{{ $postulante->rubro->rubro ?? 'Sin Rubro' }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ $postulante->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
