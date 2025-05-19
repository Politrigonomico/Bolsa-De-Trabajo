<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('title', 'Portal de CV')

@section('content')
  <div class="max-w-md mx-auto mt-20 bg-white rounded-2xl shadow p-6 text-center">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">Portal de CV – Municipalidad</h1>
    <div class="flex justify-center gap-4 flex-wrap">
      <a href="{{ route('ingresos') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg text-lg hover:bg-blue-600 transition">INGRESOS</a>
      <a href="{{ route('busqueda') }}" class="px-6 py-3 bg-green-500 text-white rounded-lg text-lg hover:bg-green-600 transition">BÚSQUEDAS</a>
    </div>
    <div class="mt-12">
      <a href="{{ route('index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 text-sm">
        <span class="mr-2 text-xl">⚙️</span>CONFIGURACIONES
      </a>
    </div>
  </div>
@endsection