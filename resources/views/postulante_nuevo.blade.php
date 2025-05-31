<!-- resources/views/postulante_nuevo.blade.php -->
@extends('layouts.app')

@section('title', 'Nuevo Postulante – Municipalidad')

@section('content')

<div class="flex-1 max-w-5xl mx-auto px-4 py-8 rounded-lg shadow bg-white">
    <h1 class="text-2xl font-bold text-center mb-6">Formulario Nuevo Postulante</h1>
    
    <form id="postulanteForm" action="{{ route('postulante.store') }}" method="POST" class="grid grid-cols-2 gap-4">
        @csrf

        {{-- -------------------- Campos básicos -------------------- --}}
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

        {{-- ------------- SECCIÓN RUBRO: AHORA CON DATALIST ------------ --}}
        <div class="col-span-2">
            <label for="rubro" class="block font-medium mb-1">Rubro</label>

            <!-- Input que muestra el datalist -->
            <input
                type="text"
                id="rubro"
                name="rubro"
                list="rubros"
                class="border p-2 rounded w-full"
                placeholder="Empiece a tipear y seleccione..."
                value="{{ old('rubro') }}"
                autocomplete="off"
                required
            >
            
            <!-- Datalist con cada opción llevando data-id="{ $item->id } -->
            <datalist id="rubros">
                @foreach($rubros as $item)
                    <option data-id="{{ $item->id }}" value="{{ $item->rubro }}"></option>
                @endforeach
            </datalist>

            <!-- Campo oculto para enviar el rubro_id real -->
            <input
                type="hidden"
                name="rubro_id"
                id="rubro_id_hidden"
                value="{{ old('rubro_id') }}"
            >

            @error('rubro_id')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
            @error('rubro')
                {{-- En caso de validar el nombre de rubro --}}
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- ------------ EXPERIENCIA LABORAL Y ESTUDIOS CURSADOS ------------ --}}
        <div>
            <label for="experiencia_laboral" class="block font-medium mb-1">Experiencia Laboral</label>
            <textarea id="experiencia_laboral" name="experiencia_laboral" class="border p-2 rounded w-full h-32" placeholder="Describa su experiencia laboral">{{ old('experiencia_laboral') }}</textarea>
            @error('experiencia_laboral')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="estudios_cursados" class="block font-medium mb-1">Estudios Cursados</label>
            <textarea id="estudios_cursados" name="estudios_cursados" class="border p-2 rounded w-full h-32" placeholder="Detalle sus estudios cursados">{{ old('estudios_cursados') }}</textarea>
            @error('estudios_cursados')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        {{-- -------------------- CAMPOS CHECKBOX -------------------- --}}

        <div class="col-span-2 flex flex-wrap items-center gap-4 mt-2">
            <div class="flex items-center">
                <input id="certificado_check" type="checkbox" name="certificado_check" value="1" {{ old('certificado_check') ? 'checked' : '' }} class="mr-1">
                <label for="certificado_check">Certif. Manipular alimentos</label>
            </div>

            <div class="flex items-center">
                <input id="carnet_check" type="checkbox" name="carnet_check" value="1" {{ old('carnet_check') ? 'checked' : '' }} class="mr-1">
                <label for="carnet_check">Carnet</label>
            </div>

            <input id="tipo_carnet" type="text" name="tipo_carnet" placeholder="Tipo de carnet" class="border p-2 rounded flex-1" value="{{ old('tipo_carnet') }}" style="display:none;"
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
    // Al enviar el formulario, muestro una alerta (igual que antes)
    document.getElementById('postulanteForm').addEventListener('submit', function () {
        alert('Formulario enviado. El postulante será registrado si los datos son correctos.');
    });

    // Lógica de mostrar/ocultar campo "Tipo de carnet"
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
    window.addEventListener('DOMContentLoaded', toggleTipoCarnet);

    // -------------- Manejo de Rubro / Datalist --------------
    const rubroInput      = document.getElementById('rubro');
    const datalistOptions = document.querySelectorAll('#rubros option');
    const rubroIdHidden   = document.getElementById('rubro_id_hidden');

    // Función que busca dentro de las <option> del datalist
    function updateRubroId() {
        const texto = rubroInput.value.trim();
        let encontrado = false;

        datalistOptions.forEach(opt => {
            if (opt.value.toLowerCase() === texto.toLowerCase()) {
                // Si coincide exactamente (ignorando mayúsculas/minúsculas), asigno el data-id
                rubroIdHidden.value = opt.getAttribute('data-id');
                encontrado = true;
            }
        });

        if (!encontrado) {
            // Si no encontró coincidencia exacta, limpio el campo oculto
            rubroIdHidden.value = '';
        }
    }

    // Cada vez que el contenido del input cambie, actualizo el hidden
    rubroInput.addEventListener('input', updateRubroId);

    // Al cargar la página (y tener old values), la función seteará rubro_id si corresponde
    window.addEventListener('DOMContentLoaded', updateRubroId);
</script>
@endsection
