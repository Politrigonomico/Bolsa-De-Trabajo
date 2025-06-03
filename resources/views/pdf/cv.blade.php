<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Currículum de {{ $postulante->nombre }} {{ $postulante->apellido }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #000;
            padding: 20px;
        }
        h1, h2 {
            margin-bottom: 5px;
        }
        .section {
            margin-top: 15px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>{{ $postulante->nombre }} {{ $postulante->apellido }}</h1>
    <p><strong>DNI:</strong> {{ $postulante->dni }}</p>
    <p><strong>Email:</strong> {{ $postulante->email }}</p>
    <p><strong>Teléfono:</strong> {{ $postulante->telefono }}</p>
    <p><strong>Domicilio:</strong> {{ $postulante->domicilio }}</p>
    <p><strong>Localidad:</strong> {{ $postulante->localidad }}</p>
    <p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->format('d/m/Y') }}</p>
    <p><strong>Estado civil:</strong> {{ $postulante->estado_civil ?? 'No especificado' }}</p>
    <p><strong>Sexo:</strong> {{ $postulante->sexo ?? 'No especificado' }}</p>

    <div class="section">
        <h2>Rubro</h2>
        <p>{{ $postulante->rubro->rubro ?? 'Sin especificar' }}</p>
    </div>

    <div class="section">
        <h2>Experiencia Laboral</h2>
        <p>{{ $postulante->experiencia_laboral ?? 'No especificada' }}</p>
    </div>

    <div class="section">
        <h2>Educación</h2>
        <p>{{ $postulante->estudios_cursados ?? 'No especificada' }}</p>
    </div>

    <div class="section">
        <h2>Otros Datos</h2>
        <p><strong>Movilidad propia:</strong> {{ $postulante->movilidad_propia ? 'Sí' : 'No' }}</p>
        <p><strong>Certificado de Manipulacion de alimentos:</strong> {{ $postulante->certificado_check ? 'Sí' : 'No' }}</p>
        <p><strong>Carnet:</strong> {{ $postulante->carnet_check ? 'Sí' : 'No' }}</p>
        @if($postulante->carnet_check)
            <p><strong>Tipo de carnet:</strong> {{ $postulante->tipo_carnet ?? 'No especificado' }}</p>
        @endif
    </div>
</body>
</html>
