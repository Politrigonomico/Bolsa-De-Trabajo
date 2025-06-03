@extends('layouts.app')

@section('title', 'Buscar Empresas')

@section('content')
<div class="max-w-4xl mx-auto mt-6 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Empresas Creadas</h1>

    @if($empresas->isEmpty())
        <p class="text-gray-600">No hay empresas cargadas aún.</p>
    @else
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
                    <th class="border px-4 py-2 text-left">Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empresas as $empresa)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $empresa->id }}</td>
                        <td class="border px-4 py-2">{{ $empresa->razon_social }}</td>
                        <td class="border px-4 py-2">{{ $empresa->cuit }}</td>
                        <td class="border px-4 py-2">{{ $empresa->rubro_empresa }}</td>
                        <td class="border px-4 py-2">{{ $empresa->rrhh->contacto ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $empresa->rrhh->email ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $empresa->rrhh->telefono ?? '-' }}</td>
                        <td class="border px-4 py-2">
                            <button onclick="toggleForm({{ $empresa->id }})" class="text-blue-600 hover:underline">✏️</button>
                        </td>
                    </tr>
                    <tr id="form-row-{{ $empresa->id }}" class="hidden bg-gray-50">
                        <td colspan="8" class="px-4 py-4 border">
                            <form action="{{ route('empresa.update', $empresa->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block font-semibold text-gray-700">Nombre</label>
                                    <input name="razon_social" type="text" value="{{ $empresa->razon_social }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700">Contacto</label>
                                    <input name="contacto" type="text" value="{{ $empresa->rrhh->contacto ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700">CUIT</label>
                                    <input name="cuit" type="text" value="{{ $empresa->cuit }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700">Correo</label>
                                    <input name="email" type="email" value="{{ $empresa->rrhh->email ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700">Teléfono</label>
                                    <input name="telefono" type="text" value="{{ $empresa->rrhh->telefono ?? '' }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700">Rubro</label>
                                    <input name="rubro_empresa" type="text" value="{{ $empresa->rubro_empresa }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                </div>


                                <div class="col-span-2 text-right mt-2">
                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script>
    function toggleForm(id) {
        const row = document.getElementById('form-row-' + id);
        row.classList.toggle('hidden');
    }

    function mostrarFormularioEdicion(id) {
        window.location.href = `/empresa/${id}/edit`;
    }
</script>
@endsection
