@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Postulantes Registrados</h2>

    <table class="min-w-full border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">DNI</th>
                <th class="px-4 py-2 border">Edad</th>
                <th class="px-4 py-2 border">Correo</th>
                <th class="px-4 py-2 border">Profesión</th>
                <th class="px-4 py-2 border">Localidad</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($postulantes as $postulante)
                <tr>
                    <td class="px-4 py-2 border">{{ $postulante->nombre }}</td>
                    <td class="px-4 py-2 border">{{ $postulante->dni }}</td>
                    <td class="px-4 py-2 border">{{ $postulante->fecha_nacimiento }}</td>
                    <td class="px-4 py-2 border">{{ $postulante->email }}</td>
                    <td class="px-4 py-2 border">
                      {{ optional($postulante->rubro)->rubro ?? 'Sin rubro' }}
                    </td>
                    <td class="px-4 py-2 border">{{ $postulante->localidad }}</td>
                    <td class="px-4 py-2 border">
                        <button onclick="toggleForm({{ $postulante->id }})" class="text-blue-600 hover:underline">✏️Editar</button>

                        <form action="{{ route('postulantes.destroy', $postulante->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('¿Estás seguro de que querés eliminar este postulante?')">🗑️Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Fila oculta para el formulario -->
                <tr id="form-row-{{ $postulante->id }}" class="hidden bg-gray-50">
                    <td colspan="7" class="px-4 py-4 border">
                        <form action="{{ route('postulantes.update', $postulante->id) }}" method="POST" class="space-y-2">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-semibold">Nombre</label>
                                    <input type="text" name="nombre" value="{{ $postulante->nombre }}" class="w-full border p-1 rounded">
                                </div>
                                <div>
                                    <label class="block font-semibold">DNI</label>
                                    <input type="text" name="dni" value="{{ $postulante->dni }}" class="w-full border p-1 rounded">
                                </div>
                                <div>
                                    <label class="block font-semibold">Edad</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ $postulante->fecha_nacimiento }}" class="w-full border p-1 rounded">
                                </div>
                                <div>
                                    <label class="block font-semibold">Correo</label>
                                    <input type="email" name="email" value="{{ $postulante->email }}" class="w-full border p-1 rounded">
                                </div>
                                <div>
                                    <label class="block font-semibold">Profesión</label>
                                    <input type="text" name="rubro" value="{{ optional($postulante->rubro)->rubro ?? 'Sin rubro' }}" class="w-full border p-1 rounded">
                                </div>
                                <div>
                                    <label class="block font-semibold">Localidad</label>
                                    <input type="text" name="localidad" value="{{ $postulante->localidad }}" class="w-full border p-1 rounded">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Guardar</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function toggleForm(id) {
        const row = document.getElementById('form-row-' + id);
        row.classList.toggle('hidden');
    }
</script>

@endsection
