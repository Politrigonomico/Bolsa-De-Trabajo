{{-- resources/views/busqueda.blade.php --}}
@extends('layouts.app')

@section('title', 'Búsqueda de Postulantes – Municipalidad')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold text-center mb-8">Búsqueda de Postulantes</h1>

  {{-- Formulario de filtros --}}
  <form method="GET" action="{{ route('busqueda') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div>
      <label for="profesion" class="block text-sm font-medium text-gray-700">Profesión</label>
      <input
        type="text"
        name="profesion"
        id="profesion"
        value="{{ request('profesion') }}"
        placeholder="Ej: Electricista"
        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
    </div>
    <div>
      <label for="edad_min" class="block text-sm font-medium text-gray-700">Edad mínima</label>
      <input
        type="number"
        name="edad_min"
        id="edad_min"
        min="0"
        value="{{ request('edad_min') }}"
        placeholder="0"
        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
    </div>
    <div>
      <label for="edad_max" class="block text-sm font-medium text-gray-700">Edad máxima</label>
      <input
        type="number"
        name="edad_max"
        id="edad_max"
        min="0"
        value="{{ request('edad_max') }}"
        placeholder="100"
        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
    </div>
    <div>
      <label for="carnet" class="block text-sm font-medium text-gray-700">Carnet de conducir</label>
      <select
        name="carnet"
        id="carnet"
        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        <option value="">-- Todos --</option>
        <option value="1" {{ request('carnet') === '1' ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ request('carnet') === '0' ? 'selected' : '' }}>No</option>
      </select>
    </div>

    <div class="md:col-span-4 text-right">
      <button
        type="submit"
        class="inline-flex items-center bg-blue-600 text-white font-semibold px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        Filtrar
      </button>
    </div>
  </form>

  @if(isset($postulantes) && $postulantes->count())
    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Nombre</th>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Profesión</th>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Edad</th>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Carnet</th>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Movilidad</th>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Email</th>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Teléfono</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($postulantes as $postulante)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                {{ $postulante->nombre }} {{ $postulante->apellido }}
              </td>
              <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                {{ optional($postulante->rubro)->rubro ?? '-' }}
              </td>
              <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                {{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->age }}
              </td>
              <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                {{ $postulante->carnet_conducir ? 'Sí' : 'No' }}
              </td>
              <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                {{ $postulante->movilidad_propia ? 'Sí' : 'No' }}
              </td>
              <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                {{ $postulante->email }}
              </td>
              <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">
                {{ $postulante->telefono }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    <p class="text-center text-gray-600 mt-6">No se encontraron postulantes que coincidan con los filtros.</p>
  @endif

  <div class="mt-6 text-center">
    <a
      href="{{ route('index') }}"
      class="inline-block text-blue-600 hover:underline text-sm"
    >
      &larr; Volver al inicio
    </a>
  </div>
</div>
@endsection
