<!-- resources/views/postulante_nuevo.blade.php -->
@extends('layouts.app')

@section('title', 'Nuevo Postulante – Municipalidad')

@section('content')

    <div class="flex-1 max-w-50xl mx-auto px-4 py-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-center mb-6"> Formulario Nuevo Postulante</h1>
    
    <div class=""">
    <form id="postulanteForm" action="{{ route('postulante.store') }}" method="POST" class="space-y-100">
        @csrf
      <div>
            <label for="nombre" class="block font-medium">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <div>
            <label for="apellido" class="block font-medium">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <div>
            <label for="dni" class="block font-medium">DNI</label>
            <input type="text" id="dni" name="dni" pattern="\d{7,8}" title="7 u 8 dígitos numéricos" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <div>
            <label for="fecha_nacimiento" class="block font-medium">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <div>
            <label for="sexo" class="block font-medium">Sexo</label>
            <select id="sexo" name="sexo" class="w-full mt-1 p-2 border rounded" required>
                <option value="">--Seleccione--</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>

        <div>
            <label for="estado_civil" class="block font-medium">Estado civil</label>
            <select id="estado_civil" name="estado_civil" class="w-full mt-1 p-2 border rounded" required>
                <option value="">--Seleccione--</option>
                <option value="Casado">Casado</option>
                <option value="Soltero">Soltero</option>
                <option value="En pareja">En pareja</option>
                <option value="Viudo">Viudo</option>
            </select>
        </div>

        <div>
            <label for="localidad" class="block font-medium">Localidad</label>
            <input type="text" id="localidad" name="localidad" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <div>
            <label for="domicilio" class="block font-medium">Domicilio</label>
            <input type="text" id="domicilio" name="domicilio" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <div>
            <label for="estudios_cursados" class="block font-medium">Estudios cursados</label>
            <textarea id="estudios_cursados" name="estudios_cursados" rows="3" class="w-full mt-1 p-2 border rounded" required></textarea>
        </div>

        <div>
            <label for="experiencia_laboral" class="block font-medium">Experiencias laborales</label>
            <textarea id="experiencia_laboral" name="experiencia_laboral" rows="4" class="w-full mt-1 p-2 border rounded" required></textarea>
        </div>
        <div class="flex items-center mb-2">
            <input type="checkbox" id="certificado_check" class="mr-2">
            <label for="certificado_check" class="font-medium">Posee certificado de manipulacion de alimentos? </label>

        </div>
     <div class="flex items-center mb-2">
        <input type="checkbox" id="carnet_check" class="mr-2">
        <label for="carnet_check" class="font-medium">Carnet de conducir</label>
     </div>
       <div class="mb-4">
  <label for="tipo_carnet" class="block font-medium mb-1">Tipo de carnet de conducir</label>
  <select name="tipo_carnet" id="tipo_carnet" class="w-full border border-gray-300 rounded px-3 py-2">//agregar tipo de carnet
    <option value="">Seleccione una opción</option>
    <option value="A">A ()</option>

    <option value="B">B ()</option>
    
    <option value="C">C ()</option>

    <option value="D">D ()</option>

    <option value="E">E ()</option>

    <option value="F">F ()</option>

  </select>

</div>
        <div class="flex items-center">
            <input type="checkbox" name="movilidad_propia" id="movilidad_propia" class="mr-2">
            <label for="movilidad_propia" class="font-medium">Movilidad propia</label>
        </div>

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input type="email" id="email" name="email" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <div>
            <label for="telefono" class="block font-medium">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" pattern="[0-9]{8,15}" title="Solo números, 8-15 dígitos" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <div class="flex justify-center gap-4 mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Guardar CV</button>
            <a href="{{ route('index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition">&larr; Volver</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('postulanteForm').addEventListener('submit', function () {
        alert('Formulario enviado. El postulante será registrado si los datos son correctos.');
    });
</script>
<script>

    //me revente el coco haciendo esto pero charly me salvo la vida
    const carnetCheck = document.getElementById('carnet_check');
    const tipoCarnetSelect = document.getElementById('tipo_carnet').parentElement;

    function toggleTipoCarnet() {
        tipoCarnetSelect.style.display = carnetCheck.checked ? 'block' : 'none';
    }

    carnetCheck.addEventListener('change', toggleTipoCarnet);
    document.addEventListener('DOMContentLoaded', toggleTipoCarnet);
    
</script>
@endsection