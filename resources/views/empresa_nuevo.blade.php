@extends('layouts.app')

@section('title', 'Crear Nueva Empresa')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Crear Nueva Empresa</h1>

    <form id="empresaForm" action="{{ route('empresa.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Razón Social -->
            <div>
                <label for="razon_social" class="block text-gray-700 font-medium mb-1">Razón Social</label>
                <input 
                    type="text" 
                    name="razon_social" 
                    id="razon_social" 
                    value="{{ old('razon_social') }}" 
                    required
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                />
                @error('razon_social')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- CUIT -->
            <div>
                <label for="cuit" class="block text-gray-700 font-medium mb-1">CUIT</label>
                <input 
                    type="text" 
                    name="cuit" 
                    id="cuit" 
                    value="{{ old('cuit') }}" 
                    required
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                />
                @error('cuit')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rubro (simple input de texto) -->
            <div>
                <label for="rubro_empresa" class="block text-gray-700 font-medium mb-1">Rubro</label>
                <input 
                    type="text" 
                    name="rubro_empresa" 
                    id="rubro_empresa" 
                    value="{{ old('rubro_empresa') }}" 
                    required
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                />
                @error('rubro_empresa')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contacto -->
            <div>
                <label for="contacto" class="block text-gray-700 font-medium mb-1">Contacto</label>
                <input 
                    type="text" 
                    name="contacto" 
                    id="contacto" 
                    value="{{ old('contacto') }}" 
                    required
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                />
                @error('contacto')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teléfono -->
            <div>
                <label for="telefono" class="block text-gray-700 font-medium mb-1">Teléfono</label>
                <input 
                    type="tel" 
                    name="telefono" 
                    id="telefono" 
                    value="{{ old('telefono') }}" 
                    required
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                />
                @error('telefono')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}" 
                    required
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                />
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Observación -->
        <div class="mt-6">
            <label for="observacion" class="block text-gray-700 font-medium mb-1">Observación</label>
            <textarea 
                name="observacion" 
                id="observacion" 
                rows="4"
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >{{ old('observacion') }}</textarea>
            @error('observacion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('empresa_nuevo') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
        </div>
    </form>
</div>
@endsection
