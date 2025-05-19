<!-- resources/views/ingresos.blade.php -->
@extends('layouts.app')

@section('title', 'Ingresos')

@section('content')
  <div class="max-w-md mx-auto mt-20 bg-white rounded-2xl shadow p-6 text-center">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Ingresos</h1>
    <div class="flex flex-col gap-4">
      <a href="{{ route('postulante_nuevo') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg text-lg hover:bg-blue-600 transition">CREAR POSTULANTE</a>
      <a href="{{ route('empresa_nuevo') }}" class="px-6 py-3 bg-green-500 text-white rounded-lg text-lg hover:bg-green-600 transition">CREAR EMPRESA</a>
    </div>
    <a href="{{ route('index') }}" class="mt-8 inline-flex items-center text-gray-600 hover:text-gray-800 text-sm">
      <span class="mr-2 text-xl">&larr;</span>Volver
    </a>
  </div>
@endsection
