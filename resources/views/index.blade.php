@extends('layouts.app')

@section('title', 'Portal de CV-Municipalidad')

@section('content')
        <div class="p-6">
            <!-- Sección de introducción / instrucciones -->
            <div class="max-w-2xl mx-auto bg-white rounded shadow mt-6 text-center p-6">
                <h1 class="text-2xl font-semibold mb-4">Portal de CV - Municipalidad</h1>
                <p class="text-gray-700 mb-6">
                    Este portal te permite gestionar los ingresos y búsquedas de postulantes y empresas de la Municipalidad.
                </p>
                <strong>Instrucciones:</strong><br>
                Para comenzar, utiliza el menú a la izquierda para acceder a las diferentes secciones del portal.<br>
                <strong>Importante:</strong> Asegúrate de tener los permisos necesarios para acceder a cada sección.<br>
                Si tienes alguna duda o necesitas ayuda, contacta al administrador del sistema.<br>
                <strong>Nota:</strong> Este portal es exclusivo para uso interno de la Municipalidad.<br>
            </div>

            <!-- Accesos rápidos / Botones grandes -->
            <div class="flex items-center justify-center mt-8">
                <div class="bg-white shadow-xl rounded-2xl p-10 max-w-xl w-full text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8">Accesos Rápidos</h2>
                    <div class="flex flex-col gap-6">
                        <a href="{{ route('ingresos') }}"
                           class="w-full py-4 px-6 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md
                                  hover:bg-blue-700 transition duration-300">
                            📥 INGRESOS
                        </a>

                        <a href="{{ route('busqueda') }}"
                           class="w-full py-4 px-6 bg-green-600 text-white text-lg font-semibold rounded-lg shadow-md
                                  hover:bg-green-700 transition duration-300">
                            🔍 BÚSQUEDAS
                        </a>

                        <a href="{{ route('buscar_empresa') }}"
                           class="w-full py-4 px-6 bg-purple-600 text-white text-lg font-semibold rounded-lg shadow-md
                                  hover:bg-purple-700 transition duration-300">
                            🏢 EMPRESAS
                        </a>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('configuracion') }}"
                           class="text-sm text-gray-500 hover:text-gray-800 transition duration-200">
                            ⚙️ CONFIGURACIONES
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>

{{-- Script para alternar (mostrar/ocultar) el sidebar en pantallas pequeñas --}}
<script>
    document.getElementById('menu-btn').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });
</script>
@endsection
