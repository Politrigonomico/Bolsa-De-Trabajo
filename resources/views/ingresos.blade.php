<!-- resources/views/cv/create.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 500px; margin: 5rem auto; padding: 1.5rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; }
        h1 { margin-bottom: 2rem; font-size: 1.8rem; color: #333; }
        .buttons { display: flex; flex-direction: column; gap: 1rem; }
        .btn { display: inline-block; padding: 1rem 2rem; font-size: 1rem; color: #fff; background-color: #007BFF; text-decoration: none; border-radius: 5px; transition: background 0.3s; }
        .btn:hover { background-color: #0056b3; }
        .btn-company { background-color: #28a745; }
        .btn-company:hover { background-color: #1e7e34; }
        .back { margin-top: 2rem; display: inline-block; color: #555; text-decoration: none; font-size: 0.9rem; }
        .back:hover { text-decoration: underline; }
        .back .arrow { margin-right: 0.5rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ingresos</h1>
        <div class="buttons">
            <a href="{{ route('postulante') }}" class="btn">POSTULANTE</a>
            <a href="{{ route('empresa.create') }}" class="btn btn-company">EMPRESA</a>
        </div>
        <a href="{{ route('home') }}" class="back">&larr; Volver</a>
    </div>
</body>
</html>
