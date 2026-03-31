@extends('layouts.app')

@section('title', 'Carnets / Licencias')

@section('content')
<div class="max-w-4xl mx-auto mt-6 p-6 bg-white rounded shadow">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">🚗 Carnets / Licencias</h1>
        <a href="{{ route('configuracion.index') }}" class="text-sm text-gray-500 hover:underline">← Volver</a>
    </div>

    {{-- Formulario agregar --}}
    <form action="{{ route('configuracion.carnets.store') }}" method="POST"
          class="mb-6 bg-gray-50 p-4 rounded-lg border">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
                <label class="block font-medium text-gray-700 mb-1 text-sm">Tipo de carnet *</label>
                <input type="text" name="tipo_carnet" value="{{ old('tipo_carnet') }}"
                       placeholder="Ej: B1, C, D2..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       required>
                @error('tipo_carnet')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium text-gray-700 mb-1 text-sm">Descripción (opcional)</label>
                <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                       placeholder="Ej: Automóvil hasta 3500kg"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="mt-3 text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">
                Agregar carnet
            </button>
        </div>
    </form>

    {{-- Tabla --}}
    <table class="w-full border-collapse text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left w-28">Tipo</th>
                <th class="border px-4 py-2 text-left">Descripción</th>
                <th class="border px-4 py-2 text-center w-28">Postulantes</th>
                <th class="border px-4 py-2 text-center w-40">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($carnets as $carnet)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2 font-semibold text-blue-700">
                        {{ $carnet->tipo_carnet ?? $carnet->carnetTipo }}
                    </td>
                    <td class="border px-4 py-2 text-gray-600">
                        {{ $carnet->descripcion ?? '-' }}
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <span class="{{ $carnet->postulantes_count > 0 ? 'text-blue-700 font-semibold' : 'text-gray-400' }}">
                            {{ $carnet->postulantes_count }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex gap-2 justify-center">
                            <button onclick="toggleEditCarnet({{ $carnet->id }})"
                                    class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                                ✏️ Editar
                            </button>
                            @if($carnet->postulantes_count === 0)
                                <form action="{{ route('configuracion.carnets.destroy', $carnet) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar el carnet {{ addslashes($carnet->tipo_carnet) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs" title="Tiene postulantes asociados">🔒</span>
                            @endif
                        </div>
                    </td>
                </tr>

                {{-- Fila de edición inline --}}
                <tr id="edit-carnet-{{ $carnet->id }}" class="hidden bg-blue-50">
                    <td colspan="4" class="border px-4 py-3">
                        <form action="{{ route('configuracion.carnets.update', $carnet) }}" method="POST"
                              class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Tipo</label>
                                <input type="text" name="tipo_carnet" value="{{ $carnet->tipo_carnet ?? $carnet->carnetTipo }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                       required>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Descripción</label>
                                <input type="text" name="descripcion" value="{{ $carnet->descripcion }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="flex gap-2">
                                <button type="submit"
                                        class="bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 text-sm">
                                    Guardar
                                </button>
                                <button type="button" onclick="toggleEditCarnet({{ $carnet->id }})"
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
                        No hay carnets cargados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="text-xs text-gray-400 mt-3">
        🔒 = No se puede eliminar porque tiene postulantes asociados.
    </p>
</div>

<script>
function toggleEditCarnet(id) {
    document.getElementById('edit-carnet-' + id).classList.toggle('hidden');
}
</script>
@endsection