@extends('layouts.app')

@section('title', 'Portal de CV-Municipalidad')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div id="sidebar"
         class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2
                absolute inset-y-0 left-0 transform -translate-x-full
                md:relative md:translate-x-0
                transition duration-200 ease-in-out z-50">
        {{-- Título o logo del menú --}}
        <a href="#" class="text-white flex items-center space-x-2 px-4">
            <span class="text-2xl font-extrabold">Menú</span>
        </a>

        <nav>
            <a href="{{ route('ingresos') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                📥 INGRESOS
            </a>
            <a href="{{ route('busqueda') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                🔍 BÚSQUEDAS
            </a>
            <a href="{{ route('buscar_empresa') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                🏢 EMPRESAS
            </a>
            <a href="{{ route('configuracion') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                ⚙️ CONFIGURACIONES
            </a>
        </nav>
    </div>

    <!-- Contenido principal -->
    <div class="flex-1 min-h-screen bg-gray-100">
        <!-- Header: solo visible en pantallas pequeñas -->
        <header class="flex items-center justify-between bg-white shadow-md p-4 md:hidden">
            <button id="menu-btn" class="text-gray-500 focus:outline-none">
                <!-- Icono hamburguesa -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-xl font-semibold">Portal de CV-Municipalidad</h1>
        </header>

        <!-- Contenido de la página -->
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
</div>

{{-- Script para alternar (mostrar/ocultar) el sidebar en pantallas pequeñas --}}
<script>
    document.getElementById('menu-btn').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });
</script>
@endsection
