<!-- resources/views/busqueda.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Búsqueda de postulantes – Municipalidad</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
    .container { max-width: 900px; margin: 3rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    h1 { text-align: center; color: #333; margin-bottom: 2rem; }
    form { display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
    form label { display: flex; flex-direction: column; font-weight: bold; flex: 1 1 200px; }
    form input[type="text"], form input[type="number"], form select { padding: .5rem; font-size: 1rem; }
    form button { align-self: flex-end; padding: .7rem 1.5rem; font-size: 1rem; background: #007BFF; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
    form button:hover { background: #0056b3; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: .5rem; text-align: left; }
    th { background: #f0f0f0; }
    .back { margin-top: 1.5rem; display: inline-block; color: #555; text-decoration: none; }
    .back:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Búsqueda de postulantes</h1>
    <form method="GET" action="{{ route('busqueda') }}">
      <label>
        Profesión
        <input type="text" name="profesion" value="{{ request('profesion') }}" placeholder="Ej: Electricista" />
      </label>
      <label>
        Edad mínima
        <input type="number" name="edad_min" min="0" value="{{ request('edad_min') }}" placeholder="0" />
      </label>
      <label>
        Edad máxima
        <input type="number" name="edad_max" min="0" value="{{ request('edad_max') }}" placeholder="100" />
      </label>
      <label>
        Carnet de conducir
        <select name="carnet">
          <option value="">--Todos--</option>
          <option value="1" {{ request('carnet')==='1' ? 'selected' : '' }}>Sí</option>
          <option value="0" {{ request('carnet')==='0' ? 'selected' : '' }}>No</option>
        </select>
      </label>
      <button type="submit">Filtrar</button>
    </form>

    @if(isset($postulantes) && $postulantes->count())
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Profesión</th>
            <th>Edad</th>
            <th>Carnet</th>
            <th>Movilidad</th>
            <th>Email</th>
            <th>Teléfono</th>
          </tr>
        </thead>
        <tbody>
          @foreach($postulantes as $postulante)
            <tr>
              <td>{{ $postulante->nombre }} {{ $postulante->apellido }}</td>
              
              <td>{{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->age }}</td>
              <td>{{ $postulante->carnet_conducir ? 'Sí' : 'No' }}</td>
              <td>{{ $postulante->movilidad_propia ? 'Sí' : 'No' }}</td>
              <td>{{ $postulante->email }}</td>
              <td>{{ $postulante->telefono }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p>No se encontraron postulantes que coincidan con los filtros.</p>
    @endif

    <a href="{{ route('index') }}" class="back">&larr; Volver al inicio</a>
  </div>
</body>
</html>