@extends('layouts.app') {{-- o el layout que estés usando --}}

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Información del Sistema</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <ul class="space-y-2">
            <li><strong>PHP Version:</strong> {{ $php_version }}</li>
            <li><strong>Laravel Version:</strong> {{ $laravel_version }}</li>
            <li><strong>Base de datos:</strong> {{ $database }}</li>
            <li><strong>Queue por defecto:</strong> {{ $queue }}</li>
            <li><strong>Cache por defecto:</strong> {{ $cache }}</li>
            <li><strong>Mail por defecto:</strong> {{ $mail }}</li>
            <li><strong>Filesystem por defecto:</strong> {{ $storage }}</li>
            <li><strong>Modo Debug:</strong> {{ $debug ? 'Sí' : 'No' }}</li>
            <li><strong>Entorno:</strong> {{ $env }}</li>
        </ul>
    </div>

    <div class="mt-6">
        <a href="{{ route('index') }}" class="text-blue-600 hover:underline">Volver al inicio</a>
    </div>
</div>
@endsection
