<!-- resources/views/postulante_nuevo.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Postulante – Municipalidad</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
    .container { max-width: 600px; margin: 3rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    h1 { text-align: center; color: #333; margin-bottom: 1.5rem; }
    form label { display: block; margin-top: 1rem; font-weight: bold; }
    form input[type="text"],
    form input[type="date"],
    form input[type="email"],
    form input[type="tel"],
    form select,
    form textarea,
    form input[list] {
      width: 100%; padding: .5rem; font-size: 1rem; box-sizing: border-box; margin-top: .5rem;
    }
    form input[type="checkbox"] { margin-right: .5rem; vertical-align: middle; }
    .actions {
      margin-top: 2rem; text-align: center;
    }
    .btn, button {
      display: inline-block; margin: .5rem; padding: .7rem 1.5rem; font-size: 1rem;
      color: #fff; background-color: #007BFF; border: none; border-radius: 4px;
      text-decoration: none; cursor: pointer; transition: background 0.3s;
    }
    .btn:hover, button:hover { background-color: #0056b3; }
    .btn-secondary { background-color: #6c757d; }
    .btn-secondary:hover { background-color: #5a6268; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Nuevo Postulante</h1>
    <form action="{{ route('postulante.store') }}" method="POST">
      @csrf
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ej: Juan" required>

      <label for="apellido">Apellido</label>
      <input type="text" id="apellido" name="apellido" placeholder="Ej: Pérez" required>

      <label for="dni">DNI</label>
      <input type="text" id="dni" name="dni" placeholder="Solo números, 7-8 dígitos" pattern="\d{7,8}" title="7 u 8 dígitos numéricos" required>

      <label for="fecha_nac">Fecha de nacimiento</label>
      <input type="date" id="fecha_nac" name="fecha_nac" required>

      <label for="sexo">Sexo</label>
      <select id="sexo" name="sexo" required>
        <option value="">--Seleccione--</option>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
      </select>

      <label for="estado_civil">Estado civil</label>
      <select id="estado_civil" name="estado_civil" required>
        <option value="">--Seleccione--</option>
        <option value="Casado">Casado</option>
        <option value="Soltero">Soltero</option>
        <option value="En pareja">En pareja</option>
        <option value="Viudo">Viudo</option>
      </select>

      <label for="localidad">Localidad</label>
      <input type="text" id="localidad" name="localidad" placeholder="Ej: Arroyo Seco" required>

      <label for="domicilio">Domicilio</label>
      <input type="text" id="domicilio" name="domicilio" placeholder="Calle, nro, piso" required>

      <label for="profesion">Profesión</label>
      <input list="profesiones" id="profesion" name="profesion" placeholder="Empieza a escribir y selecciona" required>
      <datalist id="profesiones">
        @foreach($profesiones as $prof)
          <option value="{{ $prof }}">
        @endforeach
      </datalist>

      <label for="estudios">Estudios cursados</label>
      <textarea id="estudios" name="estudios" rows="3" placeholder="Ej: Secundario completo" required></textarea>

      <label for="experiencias">Experiencias laborales</label>
      <textarea id="experiencias" name="experiencias" rows="4" placeholder="Describir brevemente" required></textarea>

      <label>
        <input type="checkbox" name="carnet"> Carnet de conducir
      </label>

      <label>
        <input type="checkbox" name="movilidad"> Movilidad propia
      </label>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="ejemplo@dominio.com" required>

      <label for="telefono">Teléfono</label>
      <input type="tel" id="telefono" name="telefono" placeholder="Ej: 3412345678" pattern="[0-9]{8,15}" title="Solo números, 8-15 dígitos" required>

      <div class="actions">
        <button type="submit">Guardar CV</button>
        <a href="{{ route('index') }}" class="btn btn-secondary">&larr; Volver al inicio</a>
      </div>
    </form>
  </div>
</body>
</html>
