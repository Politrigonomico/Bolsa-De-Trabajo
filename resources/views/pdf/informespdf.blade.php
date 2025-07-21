<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Informe PDF Postulantes</title>
    <style>
        body { font-family: sans-serif; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px;}
        th, td { border: 1px solid #000; padding: 6px; }
        th { background-color: #f0ad4e; color: #fff; }
    </style>
</head>
<body>
    <h1>Informe de Postulantes</h1>

    <p>Total Mujeres: {{ $total_mujeres }}</p>
    <p>Total Hombres: {{ $total_hombres }}</p>

    <h3>Cantidad por Rubro:</h3>
    <ul>
        @foreach ($porRubro as $nombre => $cantidad)
            <li>{{ $nombre }}: {{ $cantidad }}</li>
        @endforeach
    </ul>

    <h2>Detalles</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Sexo</th>
                <th>Edad</th>
                <th>Rubro</th>
                <th>Fecha Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($postulantes as $postulante)
                <tr>
                    <td>{{ $postulante->nombre }}</td>
                    <td>{{ $postulante->apellido }}</td>
                    <td>{{ $postulante->dni }}</td>
                    <td>{{ ucfirst($postulante->sexo) }}</td>
                    <td>{{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->age }}</td>
                    <td>{{ $postulante->rubro->rubro ?? 'Sin Rubro' }}</td>
                    <td>{{ $postulante->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
