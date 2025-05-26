@extends('layouts.app')

@section('title', 'Ingresar Profesión')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded shadow mt-6">
    <h1 class="text-2xl font-semibold mb-4">Ingresar Profesión</h1>

    <form action="{{ route('configuracion.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="rubro" class="block text-gray-700">Profesión</label>
            <input
                type="text"
                name="rubro"
                id="rubro"
                placeholder="Ej: Carpintero"
                class="mt-1 w-full border border-gray-300 rounded px-3 py-2"
                required
            >
            @error('rubro')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button
            type="submit"
            class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-600 transition"
        >
            Guardar Profesión
        </button>
        <a href="{{ route('configuracion') }}"
           class="ml-4 text-sm text-gray-600 hover:underline">
            ← Volver
        </a>
    </form>
</div>
@endsection
