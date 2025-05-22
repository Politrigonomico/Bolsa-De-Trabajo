<!-- resources/views/postulante.blade.php -->

@extends('layouts.app')
@section('title', 'Postulante – Municipalidad')>


  <style>
    .buttons { display: flex; flex-direction: column; gap: 1rem; }
    .btn { display: inline-block; padding: 1rem 2rem; font-size: 1rem; color: #fff; background-color: #007BFF; text-decoration: none; border-radius: 5px; transition: background 0.3s; }
    .btn:hover { background-color: #0056b3; }
    .btn-update { background-color: #28a745; }
    .btn-update:hover { background-color: #1e7e34; }
    .back { margin-top: 2rem; display: inline-block; color: #555; text-decoration: none; font-size: 0.9rem; }
    .back:hover { text-decoration: underline; }
    .back .arrow { margin-right: 0.5rem; }
  </style>
  
</head>
<body class="font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0;">
  <div class="max-width: 500px; margin: 5rem auto; padding: 1.5rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">
    <h1 class="margin-bottom: 2rem; font-size: 1.8rem; color: #333;">Postulante</h1>
    <div class="display: flex; flex-direction: column; gap: 1rem; align-items: center; ">
      <a href="{{ route('postulante_nuevo') }}" class="display: inline-block; padding: 1rem 2rem; font-size: 1rem; color: #fff; background-color: #007BFF; text-decoration: none; border-radius: 5px  hover:#f9f9f9 ">NUEVO</a>
      <a href="{{ route('index') }}" class="btn btn-update">ACTUALIZAR</a>
    </div>
    <a href="{{ route('ingresos') }}" class="back"><span class="arrow">&larr;</span>Volver</a>
  </div>
</body>
</html>
