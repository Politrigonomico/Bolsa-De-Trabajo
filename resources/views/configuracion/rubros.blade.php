@extends('layouts.app')

@section('title', 'Profesiones / Rubros')

@section('content')
<div class="max-w-4xl mx-auto mt-6 p-6 bg-white rounded shadow">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">💼 Profesiones / Rubros</h1>
        <a href="{{ route('configuracion.index') }}" class="text-sm text-gray-500 hover:underline">← Volver</a>
    </div>

    {{-- Formulario agregar --}}
    <form action="{{ route('configuracion.rubros.store') }}" method="POST"
          class="mb-6 bg-gray-50 p-4 rounded-lg border">
        @csrf
        <label class="block font-medium text-gray-700 mb-1">Nueva profesión</label>
        <div class="flex gap-3">
            <input type="text" name="rubro" value="{{ old('rubro') }}"
                   placeholder="Ej: Carpintero, Electricista..."
                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">
                Agregar
            </button>
        </div>
        @error('rubro')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </form>

    {{-- Tabla de rubros --}}
    <table class="w-full border-collapse text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Profesión</th>
                <th class="border px-4 py-2 text-center w-32">Postulantes</th>
                <th class="border px-4 py-2 text-center w-40">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rubros as $rubro)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2" id="rubro-text-{{ $rubro->id }}">
                        {{ $rubro->rubro }}
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <span class="{{ $rubro->postulantes_count > 0 ? 'text-blue-700 font-semibold' : 'text-gray-400' }}">
                            {{ $rubro->postulantes_count }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex gap-2 justify-center">
                            <button onclick="toggleEditRubro({{ $rubro->id }})"
                                    class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                                ✏️ Editar
                            </button>
                            @if($rubro->postulantes_count === 0)
                                <form action="{{ route('configuracion.rubros.destroy', $rubro) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar la profesión {{ addslashes($rubro->rubro) }}?')">
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
                <tr id="edit-rubro-{{ $rubro->id }}" class="hidden bg-blue-50">
                    <td colspan="3" class="border px-4 py-3">
                        <form action="{{ route('configuracion.rubros.update', $rubro) }}" method="POST"
                              class="flex gap-3 items-center">
                            @csrf
                            @method('PUT')
                            <input type="text" name="rubro" value="{{ $rubro->rubro }}"
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                   required>
                            <button type="submit"
                                    class="bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 text-sm">
                                Guardar
                            </button>
                            <button type="button" onclick="toggleEditRubro({{ $rubro->id }})"
                                    class="bg-gray-300 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-400 text-sm">
                                Cancelar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border px-4 py-6 text-center text-gray-500">
                        No hay profesiones cargadas.
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
function toggleEditRubro(id) {
    document.getElementById('edit-rubro-' + id).classList.toggle('hidden');
}
</script>
@endsection