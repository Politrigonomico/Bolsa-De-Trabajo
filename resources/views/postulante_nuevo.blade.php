<!-- resources/views/postulante_nuevo.blade.php -->
@extends('layouts.app')

@section('title', 'Nuevo Postulante – Municipalidad')

@section('content')

<div class="flex-1 max-w-5xl mx-auto px-4 py-8 rounded-lg shadow bg-white">
    <h1 class="text-2xl font-bold text-center mb-6">Formulario Nuevo Postulante</h1>
    
    <form id="postulanteForm" action="{{ route('postulante.store') }}" method="POST" class="grid grid-cols-2 gap-4">
        @csrf

        <div>
            <label for="nombre" class="block font-medium mb-1">Nombre</label>
            <input id="nombre" type="text" name="nombre" placeholder="Nombre" class="border p-2 rounded w-full" required value="{{ old('nombre') }}">
            @error('nombre')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="apellido" class="block font-medium mb-1">Apellido</label>
            <input id="apellido" type="text" name="apellido" placeholder="Apellido" class="border p-2 rounded w-full" required value="{{ old('apellido') }}">
            @error('apellido')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="dni" class="block font-medium mb-1">DNI</label>
            <input id="dni" type="number" name="dni" pattern="\d{7,8}" title="7 u 8 dígitos numéricos" placeholder="DNI" class="border p-2 rounded w-full" required value="{{ old('dni') }}">
            @error('dni')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="telefono" class="block font-medium mb-1">Teléfono</label>
            <input id="telefono" type="text" name="telefono" placeholder="Teléfono" class="border p-2 rounded w-full" required value="{{ old('telefono') }}">
            @error('telefono')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-medium mb-1">Email</label>
            <input id="email" type="email" name="email" placeholder="Email" class="border p-2 rounded w-full" required value="{{ old('email') }}">
            @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="domicilio" class="block font-medium mb-1">Domicilio</label>
            <input id="domicilio" type="text" name="domicilio" placeholder="Domicilio" class="border p-2 rounded w-full" required value="{{ old('domicilio') }}">
            @error('domicilio')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="localidad" class="block font-medium mb-1">Localidad</label>
            <input id="localidad" type="text" name="localidad" placeholder="Localidad" class="border p-2 rounded w-full" required value="{{ old('localidad') }}">
            @error('localidad')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="fecha_nacimiento" class="block font-medium mb-1">Fecha de nacimiento</label>
            <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" class="border p-2 rounded w-full" required value="{{ old('fecha_nacimiento') }}">
            @error('fecha_nacimiento')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="estado_civil" class="block font-medium mb-1">Estado Civil</label>
            <select id="estado_civil" name="estado_civil" class="border p-2 rounded w-full" required>
                <option value="" disabled {{ old('estado_civil') ? '' : 'selected' }}>Seleccione estado civil</option>
                <option value="Casado" {{ old('estado_civil')=='Casado'?'selected':'' }}>Casado</option>
                <option value="Soltero" {{ old('estado_civil')=='Soltero'?'selected':'' }}>Soltero</option>
                <option value="En pareja" {{ old('estado_civil')=='En pareja'?'selected':'' }}>En pareja</option>
                <option value="Viudo" {{ old('estado_civil')=='Viudo'?'selected':'' }}>Viudo</option>
            </select>
            @error('estado_civil')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-span-2">
            <label for="rubro_id" class="block font-medium mb-1">Rubro</label>
            <select
                name="rubro_id"
                id="rubro_id"
                class="w-full p-2 border rounded"
                required
            >
                <option value="">Seleccione un rubro</option>
                @foreach($rubros as $item)
                    <option value="{{ $item->id }}" {{ old('rubro_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->rubro }}
                    </option>
                @endforeach
            </select>
            @error('rubro_id')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="experiencia_laboral" class="block font-medium mb-1">Experiencia Laboral</label>
            <input id="experiencia_laboral" type="text" name="experiencia_laboral" placeholder="Experiencia Laboral" class="border p-2 rounded w-full" value="{{ old('experiencia_laboral') }}">
            @error('experiencia_laboral')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="estudios_cursados" class="block font-medium mb-1">Estudios Cursados</label>
            <input id="estudios_cursados" type="text" name="estudios_cursados" placeholder="Estudios Cursados" class="border p-2 rounded w-full" value="{{ old('estudios_cursados') }}">
            @error('estudios_cursados')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-span-2 flex flex-wrap items-center gap-4 mt-2">
            <div class="flex items-center">
                <input id="certificado_check" type="checkbox" name="certificado_check" value="1" {{ old('certificado_check') ? 'checked' : '' }} class="mr-1">
                <label for="certificado_check">Certificado</label>
            </div>

            <div class="flex items-center">
                <input id="carnet_check" type="checkbox" name="carnet_check" value="1" {{ old('carnet_check') ? 'checked' : '' }} class="mr-1">
                <label for="carnet_check">Carnet</label>
            </div>

            <input
                id="tipo_carnet"
                type="text"
                name="tipo_carnet"
                placeholder="Tipo de carnet"
                class="border p-2 rounded flex-1"
                value="{{ old('tipo_carnet') }}"
                style="display:none;"
            >

            <div class="flex items-center">
                <input id="movilidad_propia" type="checkbox" name="movilidad_propia" value="1" {{ old('movilidad_propia') ? 'checked' : '' }} class="mr-1">
                <label for="movilidad_propia">Movilidad propia</label>
            </div>
        </div>

        <div class="col-span-2">
            <label for="sexo" class="block font-medium mb-1">Sexo</label>
            <select id="sexo" name="sexo" class="border p-2 rounded w-full" required>
                <option value="" disabled {{ old('sexo') ? '' : 'selected' }}>Seleccione sexo</option>
                <option value="Masculino" {{ old('sexo')=='Masculino'?'selected':'' }}>Masculino</option>
                <option value="Femenino" {{ old('sexo')=='Femenino'?'selected':'' }}>Femenino</option>
                <option value="Otro" {{ old('sexo')=='Otro'?'selected':'' }}>Otro</option>
            </select>
            @error('sexo')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="col-span-2 mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar Postulante
        </button>
    </form>
</div>

<script>
    document.getElementById('postulanteForm').addEventListener('submit', function () {
        alert('Formulario enviado. El postulante será registrado si los datos son correctos.');
    });

    const carnetCheck = document.getElementById('carnet_check');
    const tipoCarnetInput = document.getElementById('tipo_carnet');

    function toggleTipoCarnet() {
        if (carnetCheck.checked) {
            tipoCarnetInput.style.display = 'block';
            tipoCarnetInput.required = true;
        } else {
            tipoCarnetInput.style.display = 'none';
            tipoCarnetInput.required = false;
            tipoCarnetInput.value = '';
        }
    }

    carnetCheck.addEventListener('change', toggleTipoCarnet);

    // Mostrar/ocultar al cargar la página (considerando old values)
    window.addEventListener('DOMContentLoaded', (event) => {
        toggleTipoCarnet();
    });
</script>
@endsection
