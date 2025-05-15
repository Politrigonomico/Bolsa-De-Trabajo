<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Postulantes</title>
  <style>
    body { font-family: sans-serif; padding: 2rem; background: #f2f2f2; }
    table { width: 100%; border-collapse: collapse; margin-top: 2rem; background: white; }
    th, td { border: 1px solid #ccc; padding: 0.5rem; text-align: left; }
    th { background: #007bff; color: white; }
  </style>
</head>
<body>
  <h1>Listado de Postulantes</h1>

  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>DNI</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Localidad</th>
        <th>Profesión</th>
      </tr>
    </thead>
    <tbody>
      @foreach($postulantes as $postulante)
        <tr>
          <td>{{ $postulante->nombre }}</td>
          <td>{{ $postulante->apellido }}</td>
          <td>{{ $postulante->dni }}</td>
          <td>{{ $postulante->email }}</td>
          <td>{{ $postulante->telefono }}</td>
          <td>{{ $postulante->localidad }}</td>
          <td>{{ $postulante->profesion ?? 'N/A' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
