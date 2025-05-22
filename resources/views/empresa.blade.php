@extends('layouts.app')

@section('title', 'Empresas – Municipalidad')

@section('content')

<div class="min-h-screen items-center justify-center bg-gray-100">
    <div class="max-w-md w-full p-8 bg-white rounded-lg shadow-md text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-8"> Menú de Empresa</h1>

        <div class="flex flex-col gap-4">
            <a href="{{ route('index') }}" class="px-6 py-3 text-white bg-blue-600 rounded-md text-lg hover:bg-blue-800 transition">
                ➕ NUEVO
            </a>
            <a href="{{ route('index') }}" class="px-6 py-3 text-white bg-green-600 rounded-md text-lg hover:bg-green-800 transition">
                🔄 ACTUALIZAR
            </a>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('ingresos') }}" class="text-sm text-gray-600 hover:underline">
                <span class="mr-1">&larr;</span>Volver
            </a>
        </div>
    </div>
</div>

@endsection

