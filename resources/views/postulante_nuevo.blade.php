@extends('layouts.app')

@section('title', 'Nuevo Postulante – Municipalidad')

@section('content')

<div class="flex-1 max-w-6xl mx-auto px-4 py-8 rounded-lg shadow bg-white">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Formulario Nuevo Postulante</h1>
    
    <form id="postulanteForm" action="{{ route('postulante.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Foto del postulante --}}
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">📷 Foto del Postulante</h3>
            <div class="flex items-center space-x-6">
                <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-full flex items-center justify-center bg-white overflow-hidden" id="preview-container">
                    <img id="photo-preview" class="w-full h-full object-cover hidden" />
                    <span id="photo-placeholder" class="text-gray-400 text-4xl">👤</span>
                </div>
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Subir foto (opcional)</label>
                    <input type="file" name="foto" id="foto" accept="image/*" 
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">JPG, PNG o GIF. Máximo 2MB.</p>
                </div>
            </div>
        </div>

        {{-- Información Personal --}}
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">👤 Información Personal</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label for="nombre" class="block font-medium mb-1 text-gray-700">Nombre *</label>
                    <input id="nombre" type="text" name="nombre" placeholder="Nombre" 
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required value="{{ old('nombre') }}">
                    @error('nombre')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="apellido" class="block font-medium mb-1 text-gray-700">Apellido *</label>
                    <input id="apellido" type="text" name="apellido" placeholder="Apellido" 
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required value="{{ old('apellido') }}">
                    @error('apellido')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="dni" class="block font-medium mb-1 text-gray-700">DNI *</label>
                    <input id="dni" type="number" name="dni" placeholder="DNI" 
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required value="{{ old('dni') }}">
                    @error('dni')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="telefono" class="block font-medium mb-1 text-gray-700">Teléfono *</label>
                    <input id="telefono" type="text" name="telefono" placeholder="Teléfono" 
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required value="{{ old('telefono') }}">
                    @error('telefono')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block font-medium mb-1 text-gray-700">Email *</label>
                    <input id="email" type="email" name="email" placeholder="Email" 
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="fecha_nacimiento" class="block font-medium mb-1 text-gray-700">Fecha de nacimiento *</label>
                    <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" 
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required value="{{ old('fecha_nacimiento') }}">
                    @error('fecha_nacimiento')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="sexo" class="block font-medium mb-1 text-gray-700">Sexo *</label>
                    <select id="sexo" name="sexo" class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="" disabled {{ old('sexo') ? '' : 'selected' }}>Seleccione sexo</option>
                        <option value="Masculino" {{ old('sexo')=='Masculino'?'selected':'' }}>Masculino</option>
                        <option value="Femenino" {{ old('sexo')=='Femenino'?'selected':'' }}>Femenino</option>
                        <option value="Otro" {{ old('sexo')=='Otro'?'selected':'' }}>Otro</option>
                    </select>
                    @error('sexo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="estado_civil" class="block font-medium mb-1 text-gray-700">Estado Civil *</label>
                    <select id="estado_civil" name="estado_civil" class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
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
            </div>
        </div>

        {{-- Ubicación --}}
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">📍 Ubicación</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="domicilio" class="block font-medium mb-1 text-gray-700">Domicilio *</label>
                    <input id="domicilio" type="text" name="domicilio" placeholder="Domicilio" 
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required value="{{ old('domicilio') }}">
                    @error('domicilio')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="localidad" class="block font-medium mb-1 text-gray-700">Localidad *</label>
                    <input list="localidades-list" name="localidad" id="localidad" placeholder="Seleccione o escriba la localidad"
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           value="{{ old('localidad') }}" required>
                    <datalist id="localidades-list">
                        @foreach($localidades ?? [] as $loc)
                            <option value="{{ $loc->nombre }}">{{ $loc->nombre }} - {{ $loc->codigo_postal }}</option>
                        @endforeach
                    </datalist>
                    @error('localidad')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Profesiones (múltiples) --}}
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">💼 Profesiones y Rubros</h3>
            <div class="space-y-4">
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Profesión Principal *</label>
                    <input type="text" id="rubro" name="rubro" list="rubros" 
                           class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Empiece a tipear y seleccione..." value="{{ old('rubro') }}" autocomplete="off" required>
                    <datalist id="rubros">
                        @foreach($rubros ?? [] as $item)
                            <option data-id="{{ $item->id }}" value="{{ $item->rubro }}"></option>
                        @endforeach
                    </datalist>
                    <input type="hidden" name="rubro_id" id="rubro_id_hidden" value="{{ old('rubro_id') }}">
                    @error('rubro_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-2 text-gray-700">Profesiones Adicionales (opcional)</label>
                    <div id="rubros-adicionales" class="space-y-2">
                        <!-- Se llenarán dinámicamente con JavaScript -->
                    </div>
                    <button type="button" id="agregar-rubro" class="mt-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm">
                        + Agregar otra profesión
                    </button>
                </div>
            </div>
        </div>

        {{-- Educación Mejorada --}}
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">🎓 Educación</h3>
            <p class="text-sm text-gray-600 mb-4">
                <strong>Nota:</strong> No es necesario marcar niveles anteriores. Si completó universidad, se asume que completó los niveles previos.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-4 rounded-lg border-2 border-gray-200">
                    <h4 class="font-bold text-gray-700 mb-3 text-center">Primaria</h4>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer hover:bg-blue-50 p-2 rounded">
                            <input type="radio" name="nivel_primaria" value="completada" 
                                   {{ old('estudios_primaria') ? 'checked' : '' }}
                                   class="mr-3 text-blue-600 w-4 h-4">
                            <span class="text-sm">Completada</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-orange-50 p-2 rounded">
                            <input type="radio" name="nivel_primaria" value="cursando" 
                                   {{ old('cursando_primaria') ? 'checked' : '' }}
                                   class="mr-3 text-orange-600 w-4 h-4">
                            <span class="text-sm">En curso</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                            <input type="radio" name="nivel_primaria" value="ninguna" checked
                                   class="mr-3 text-gray-600 w-4 h-4">
                            <span class="text-sm">No aplica</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg border-2 border-gray-200">
                    <h4 class="font-bold text-gray-700 mb-3 text-center">Secundaria</h4>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer hover:bg-blue-50 p-2 rounded">
                            <input type="radio" name="nivel_secundaria" value="completada" 
                                   {{ old('estudios_secundaria') ? 'checked' : '' }}
                                   class="mr-3 text-blue-600 w-4 h-4">
                            <span class="text-sm">Completada</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-orange-50 p-2 rounded">
                            <input type="radio" name="nivel_secundaria" value="cursando" 
                                   {{ old('cursando_secundaria') ? 'checked' : '' }}
                                   class="mr-3 text-orange-600 w-4 h-4">
                            <span class="text-sm">En curso</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                            <input type="radio" name="nivel_secundaria" value="ninguna" checked
                                   class="mr-3 text-gray-600 w-4 h-4">
                            <span class="text-sm">No aplica</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg border-2 border-gray-200">
                    <h4 class="font-bold text-gray-700 mb-3 text-center">Terciario</h4>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer hover:bg-blue-50 p-2 rounded">
                            <input type="radio" name="nivel_terciario" value="completada" 
                                   {{ old('estudios_terciario') ? 'checked' : '' }}
                                   class="mr-3 text-blue-600 w-4 h-4">
                            <span class="text-sm">Completado</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-orange-50 p-2 rounded">
                            <input type="radio" name="nivel_terciario" value="cursando" 
                                   {{ old('cursando_terciario') ? 'checked' : '' }}
                                   class="mr-3 text-orange-600 w-4 h-4">
                            <span class="text-sm">En curso</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                            <input type="radio" name="nivel_terciario" value="ninguna" checked
                                   class="mr-3 text-gray-600 w-4 h-4">
                            <span class="text-sm">No aplica</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg border-2 border-gray-200">
                    <h4 class="font-bold text-gray-700 mb-3 text-center">Universidad</h4>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer hover:bg-blue-50 p-2 rounded">
                            <input type="radio" name="nivel_universidad" value="completada" 
                                   {{ old('estudios_universidad') ? 'checked' : '' }}
                                   class="mr-3 text-blue-600 w-4 h-4">
                            <span class="text-sm">Completada</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-orange-50 p-2 rounded">
                            <input type="radio" name="nivel_universidad" value="cursando" 
                                   {{ old('cursando_universidad') ? 'checked' : '' }}
                                   class="mr-3 text-orange-600 w-4 h-4">
                            <span class="text-sm">En curso</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                            <input type="radio" name="nivel_universidad" value="ninguna" checked
                                   class="mr-3 text-gray-600 w-4 h-4">
                            <span class="text-sm">No aplica</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label for="estudios_cursados" class="block font-medium mb-2 text-gray-700">Detalles de estudios</label>
                <textarea id="estudios_cursados" name="estudios_cursados" rows="4"
                          class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                          placeholder="Detalle sus estudios, títulos, certificaciones, etc.">{{ old('estudios_cursados') }}</textarea>
                @error('estudios_cursados')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Carnets y Licencias Mejorado --}}
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">🚗 Carnets y Licencias</h3>
            <div class="space-y-4">
                <div class="flex items-center bg-white p-4 rounded-lg border">
                    <input id="carnet_check" type="checkbox" name="carnet_check" value="1" 
                           {{ old('carnet_check') ? 'checked' : '' }} class="mr-3 text-blue-600 w-5 h-5">
                    <label for="carnet_check" class="font-medium text-gray-700">Posee carnet de conducir</label>
                </div>

                <div id="carnets-container" style="display:none;" class="space-y-3">
                    <label class="block font-medium text-gray-700">Seleccione los tipos de carnet que posee:</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($carnets ?? [] as $carnet)
                            <label class="flex items-start bg-white p-3 rounded-lg border-2 border-gray-200 hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-all">
                                <input type="checkbox" name="carnets[]" value="{{ $carnet->id }}" 
                                       class="mr-3 mt-1 text-blue-600 w-5 h-5 flex-shrink-0">
                                <div class="flex-1">
                                    <div class="font-bold text-blue-700 text-base">
                                        {{ $carnet->tipo_carnet ?? $carnet->carnetTipo }}
                                    </div>
                                    <div class="text-gray-600 text-sm mt-1">
                                        {{ $carnet->descripcion }}
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Experiencia y Competencias --}}
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">💪 Experiencia y Competencias</h3>
            <div class="space-y-6">
                <div>
                    <label for="experiencia_laboral" class="block font-medium mb-2 text-gray-700">Experiencia Laboral</label>
                    <textarea id="experiencia_laboral" name="experiencia_laboral" rows="4" 
                              class="border border-gray-300 p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                              placeholder="Describa su experiencia laboral previa, empleos, responsabilidades, etc.">{{ old('experiencia_laboral') }}</textarea>
                    @error('experiencia_laboral')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center bg-white p-4 rounded-lg border-2 border-gray-200 hover:border-green-400 transition">
                        <input id="certificado_check" type="checkbox" name="certificado_check" value="1" 
                               {{ old('certificado_check') ? 'checked' : '' }} class="mr-3 text-green-600 w-5 h-5">
                        <label for="certificado_check" class="font-medium text-gray-700">
                            🍽️ Certificado de Manipulación de Alimentos
                        </label>
                    </div>

                    <div class="flex items-center bg-white p-4 rounded-lg border-2 border-gray-200 hover:border-blue-400 transition">
                        <input id="movilidad_propia" type="checkbox" name="movilidad_propia" value="1" 
                               {{ old('movilidad_propia') ? 'checked' : '' }} class="mr-3 text-blue-600 w-5 h-5">
                        <label for="movilidad_propia" class="font-medium text-gray-700">
                            🏍️ Movilidad Propia
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Botón de envío --}}
        <div class="bg-white p-6 rounded-lg border-2 border-blue-200">
            <div class="text-center">
                <button type="submit" 
                        class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-semibold text-lg transition-all duration-200 transform hover:scale-105">
                    💾 Guardar Postulante
                </button>
                <p class="text-sm text-gray-600 mt-2">Se generará automáticamente un CV en PDF</p>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview de foto
    const fotoInput = document.getElementById('foto');
    const photoPreview = document.getElementById('photo-preview');
    const photoPlaceholder = document.getElementById('photo-placeholder');
    
    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.classList.remove('hidden');
                photoPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Mostrar/ocultar carnets
    const carnetCheck = document.getElementById('carnet_check');
    const carnetsContainer = document.getElementById('carnets-container');
    
    function toggleCarnets() {
        if (carnetCheck.checked) {
            carnetsContainer.style.display = 'block';
        } else {
            carnetsContainer.style.display = 'none';
            // Desmarcar todos los carnets
            carnetsContainer.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        }
    }
    
    carnetCheck.addEventListener('change', toggleCarnets);
    toggleCarnets();

    // Manejo de rubro principal
    const rubroInput = document.getElementById('rubro');
    const datalistOptions = document.querySelectorAll('#rubros option');
    const rubroIdHidden = document.getElementById('rubro_id_hidden');

    function updateRubroId() {
        const texto = rubroInput.value.trim();
        let encontrado = false;

        datalistOptions.forEach(opt => {
            if (opt.value.toLowerCase() === texto.toLowerCase()) {
                rubroIdHidden.value = opt.getAttribute('data-id');
                encontrado = true;
            }
        });

        if (!encontrado) {
            rubroIdHidden.value = '';
        }
    }

    rubroInput.addEventListener('input', updateRubroId);
    rubroInput.addEventListener('blur', updateRubroId);
    updateRubroId();

    // Agregar rubros adicionales
    const agregarRubroBtn = document.getElementById('agregar-rubro');
    const rubrosAdicionalesContainer = document.getElementById('rubros-adicionales');
    let contadorRubros = 0;

    agregarRubroBtn.addEventListener('click', function() {
        contadorRubros++;
        const div = document.createElement('div');
        div.className = 'flex items-center space-x-2';
        div.innerHTML = `
            <input type="text" name="rubros_adicionales[]" list="rubros" 
                   placeholder="Profesión adicional ${contadorRubros}" 
                   class="border border-gray-300 p-2 rounded-lg flex-1 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button type="button" onclick="this.parentElement.remove()" 
                    class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 text-sm">
                ✕
            </button>
        `;
        rubrosAdicionalesContainer.appendChild(div);
    });

    // Manejo de educación con radio buttons
    // Los campos hidden se crearán al enviar el formulario
    const form = document.getElementById('postulanteForm');
    form.addEventListener('submit', function(e) {
        // Procesar nivel de primaria
        const nivelPrimaria = document.querySelector('input[name="nivel_primaria"]:checked');
        if (nivelPrimaria) {
            if (nivelPrimaria.value === 'completada') {
                addHiddenField('estudios_primaria', '1');
            } else if (nivelPrimaria.value === 'cursando') {
                addHiddenField('cursando_primaria', '1');
            }
        }

        // Procesar nivel de secundaria
        const nivelSecundaria = document.querySelector('input[name="nivel_secundaria"]:checked');
        if (nivelSecundaria) {
            if (nivelSecundaria.value === 'completada') {
                addHiddenField('estudios_secundaria', '1');
                addHiddenField('estudios_primaria', '1'); // Si completó secundaria, completó primaria
            } else if (nivelSecundaria.value === 'cursando') {
                addHiddenField('cursando_secundaria', '1');
                addHiddenField('estudios_primaria', '1'); // Si cursa secundaria, completó primaria
            }
        }

        // Procesar nivel terciario
        const nivelTerciario = document.querySelector('input[name="nivel_terciario"]:checked');
        if (nivelTerciario) {
            if (nivelTerciario.value === 'completada') {
                addHiddenField('estudios_terciario', '1');
                addHiddenField('estudios_secundaria', '1'); // Completó secundaria
                addHiddenField('estudios_primaria', '1'); // Completó primaria
            } else if (nivelTerciario.value === 'cursando') {
                addHiddenField('cursando_terciario', '1');
                addHiddenField('estudios_secundaria', '1');
                addHiddenField('estudios_primaria', '1');
            }
        }

        // Procesar nivel universidad
        const nivelUniversidad = document.querySelector('input[name="nivel_universidad"]:checked');
        if (nivelUniversidad) {
            if (nivelUniversidad.value === 'completada') {
                addHiddenField('estudios_universidad', '1');
                addHiddenField('estudios_secundaria', '1');
                addHiddenField('estudios_primaria', '1');
            } else if (nivelUniversidad.value === 'cursando') {
                addHiddenField('cursando_universidad', '1');
                addHiddenField('estudios_secundaria', '1');
                addHiddenField('estudios_primaria', '1');
            }
        }

        // Mostrar loading
        const loading = document.createElement('div');
        loading.innerHTML = `
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                        <span>Guardando postulante y generando CV...</span>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(loading);
    });

    function addHiddenField(name, value) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        form.appendChild(input);
    }
});
</script>

@endsection