@extends('layouts.app')

@section('title', 'Buscar Empresas')

@section('content')
<div class="max-w-6xl mx-auto mt-6 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Empresas Registradas ({{ $empresas->count() }})</h1>

    @if($empresas->isEmpty())
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🏢</div>
            <p class="text-gray-600 text-lg">No hay empresas cargadas aún.</p>
            <a href="{{ route('empresas.create') }}" 
               class="mt-4 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Crear primera empresa
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2 text-left">ID</th>
                        <th class="border px-4 py-2 text-left">Razón Social</th>
                        <th class="border px-4 py-2 text-left">CUIT</th>
                        <th class="border px-4 py-2 text-left">Rubro</th>
                        <th class="border px-4 py-2 text-left">Contacto</th>
                        <th class="border px-4 py-2 text-left">Email</th>
                        <th class="border px-4 py-2 text-left">Teléfono</th>
                        <th class="border px-4 py-2 text-left" style="min-width: 150px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresas as $empresa)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $empresa->id }}</td>
                            <td class="border px-4 py-2 font-medium">{{ $empresa->razon_social }}</td>
                            <td class="border px-4 py-2">{{ $empresa->cuit }}</td>
                            <td class="border px-4 py-2">{{ $empresa->rubro_empresa }}</td>
                            <td class="border px-4 py-2">{{ $empresa->rrhh->contacto ?? '-' }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $empresa->rrhh->email ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $empresa->rrhh->telefono ?? '-' }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex flex-col space-y-1">
                                    <button onclick="toggleForm({{ $empresa->id }})" 
                                            class="text-left text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        ✏️ Editar
                                    </button>
                                    
                                    <form action="{{ route('empresas.destroy', $empresa->id) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('¿Estás seguro de que querés eliminar esta empresa?\n\nSe eliminarán todos los datos de RRHH asociados.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-left text-red-600 hover:text-red-800 text-sm font-medium">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        
                        <tr id="form-row-{{ $empresa->id }}" class="hidden bg-gray-50">
                            <td colspan="8" class="px-4 py-4 border">
                                <form action="{{ route('empresa.update', $empresa->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm mb-1">Razón Social</label>
                                        <input name="razon_social" type="text" value="{{ $empresa->razon_social }}" 
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm mb-1">CUIT</label>
                                        <input name="cuit" type="text" value="{{ $empresa->cuit }}" 
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm mb-1">Rubro</label>
                                        <input name="rubro_empresa" type="text" value="{{ $empresa->rubro_empresa }}" 
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm mb-1">Contacto</label>
                                        <input name="contacto" type="text" value="{{ $empresa->rrhh->contacto ?? '' }}" 
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm mb-1">Email</label>
                                        <input name="email" type="email" value="{{ $empresa->rrhh->email ?? '' }}" 
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-gray-700 text-sm mb-1">Teléfono</label>
                                        <input name="telefono" type="text" value="{{ $empresa->rrhh->telefono ?? '' }}" 
                                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block font-semibold text-gray-700 text-sm mb-1">Observaciones</label>
                                        <textarea name="observacion" rows="3" 
                                                  class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $empresa->observacion }}</textarea>
                                    </div>

                                    <div class="md:col-span-2 text-right mt-2">
                                        <button type="button" onclick="toggleForm({{ $empresa->id }})"
                                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 mr-2">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                            Guardar Cambios
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
</div>

<script>
    function toggleForm(id) {
        const row = document.getElementById('form-row-' + id);
        row.classList.toggle('hidden');
    }
</script>
@endsection