@extends('layouts.app')
@section('title', 'Portal de CV – Municipalidad')

<body>
    <div class="container">
        <h1>Ingresos</h1>
        <div class="buttons">
            <a href="{{ route('postulante') }}" class="btn">POSTULANTE</a>
            <a href="{{ route('empresa') }}" class="btn btn-company">EMPRESA</a>
        </div>
        <a href="{{ route('index') }}" class="back">&larr; Volver</a>
    </div>
</body>
</html>
