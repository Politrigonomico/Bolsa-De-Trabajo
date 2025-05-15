<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Municipalidad</title>
    <style>
        /* Reset y tipografía base */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; text-align: center; background: #f9f9f9; }
        .container { max-width: 600px; margin: 5rem auto; padding: 1rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h1 { margin-bottom: 2rem; font-size: 2rem; color: #333; }
        /* Botones principales */
        .buttons { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
        .btn-main { display: inline-block; padding: 1rem 2rem; font-size: 1.1rem; color: #fff; text-decoration: none; border-radius: 5px; transition: background 0.3s; }
        .btn-ingresos { background: #007BFF; }
        .btn-ingresos:hover { background: #0056b3; }
        .btn-busquedas { background: #28a745; }
        .btn-busquedas:hover { background: #1e7e34; }
        /* Enlace de configuración */
        .settings { margin-top: 3rem; }
        .settings a { color: #555; text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; }
        .settings a:hover { text-decoration: underline; }
        .settings .icon { margin-right: 0.5rem; font-size: 1.1rem; }
    </style>
</head>
<body>
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
</body>
</html>