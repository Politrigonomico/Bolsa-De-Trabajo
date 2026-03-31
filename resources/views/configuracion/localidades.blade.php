@extends('layouts.app')

@section('title', 'Localidades')

@section('content')
<div class="max-w-4xl mx-auto mt-6 p-6 bg-white rounded shadow">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">📍 Localidades</h1>
        <a href="{{ route('configuracion.index') }}" class="text-sm text-gray-500 hover:underline">← Volver</a>
    </div>

    {{-- Formulario agregar --}}
    <form action="{{ route('configuracion.localidades.store') }}" method="POST"
          class="mb-6 bg-gray-50 p-4 rounded-lg border">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
                <label class="block font-medium text-gray-700 mb-1 text-sm">Nombre *</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                       placeholder="Ej: Arroyo Seco"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       required>
                @error('nombre')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-1 text-sm">Provincia *</label>
                <input type="text" name="provincia" value="{{ old('provincia', 'Santa Fe') }}"
                       placeholder="Ej: Santa Fe"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       required>
                @error('provincia')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-1 text-sm">Código Postal</label>
                <input type="text" name="codigo_postal" value="{{ old('codigo_postal') }}"
                       placeholder="Ej: 2128"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="mt-3 text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">
                Agregar localidad
            </button>
        </div>
    </form>

    {{-- Tabla --}}
    <table class="w-full border-collapse text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Localidad</th>
                <th class="border px-4 py-2 text-left">Provincia</th>
                <th class="border px-4 py-2 text-left w-28">C.P.</th>
                <th class="border px-4 py-2 text-center w-40">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($localidades as $localidad)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2 font-medium">{{ $localidad->nombre }}</td>
                    <td class="border px-4 py-2 text-gray-600">{{ $localidad->provincia }}</td>
                    <td class="border px-4 py-2 text-gray-600">{{ $localidad->codigo_postal ?? '-' }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex gap-2 justify-center">
                            <button onclick="toggleEditLocalidad({{ $localidad->id }})"
                                    class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                                ✏️ Editar
                            </button>
                            <form action="{{ route('configuracion.localidades.destroy', $localidad) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Eliminar la localidad {{ addslashes($localidad->nombre) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- Fila edición inline --}}
                <tr id="edit-localidad-{{ $localidad->id }}" class="hidden bg-blue-50">
                    <td colspan="4" class="border px-4 py-3">
                        <form action="{{ route('configuracion.localidades.update', $localidad) }}" method="POST"
                              class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre</label>
                                <input type="text" name="nombre" value="{{ $localidad->nombre }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                       required>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Provincia</label>
                                <input type="text" name="provincia" value="{{ $localidad->provincia }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                       required>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">C.P.</label>
                                <input type="text" name="codigo_postal" value="{{ $localidad->codigo_postal }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="flex gap-2">
                                <button type="submit"
                                        class="bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 text-sm">
                                    Guardar
                                </button>
                                <button type="button" onclick="toggleEditLocalidad({{ $localidad->id }})"
                                        class="bg-gray-300 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-400 text-sm">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border px-4 py-6 text-center text-gray-500">
                        No hay localidades cargadas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function toggleEditLocalidad(id) {
    document.getElementById('edit-localidad-' + id).classList.toggle('hidden');
}
</script>
@endsection