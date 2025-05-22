@extends('layouts.app')
@section('title', 'Empresas – Municipalidad')

@section('content')
  <body class="bg-gray-100 text-center font-sans">
    <div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-semibold text-gray-800 mb-8">Empresa</h1>

      <div class="flex flex-col gap-4">
        <a href="{{ route('index') }}" class="inline-block px-6 py-3 text-white bg-blue-600 rounded-md text-lg hover:bg-blue-800 transition">NUEVO</a>
        <a href="{{ route('index') }}" class="inline-block px-6 py-3 text-white bg-green-600 rounded-md text-lg hover:bg-green-800 transition">ACTUALIZAR</a>
      </div>

      <a href="{{ route('ingresos') }}" class="inline-block mt-8 text-sm text-gray-600 hover:underline">
        <span class="mr-1">&larr;</span>Volver
      </a>
    </div>
  </body>
@endsection
