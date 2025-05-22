@extends('layouts.app')
@section('title', 'Portal de CV – Municipalidad')

@section('content')
    <div class="container">
        <h1>Portal de CV – Municipalidad</h1>
        <div class="buttons">
            <!-- Reemplaza las rutas por las de tus controladores -->
            <a href="{{ route('ingresos') }}" class="btn-main btn-ingresos">INGRESOS</a>
            <a href="{{ route('busqueda') }}" class="btn-main btn-busquedas">BÚSQUEDAS</a>
        </div>
        <div class="settings">
            <a href="{{ route('index') }}">
                <span class="icon">⚙️</span> CONFIGURACIONES
            </a>
        </div>
    </div>
@endsection