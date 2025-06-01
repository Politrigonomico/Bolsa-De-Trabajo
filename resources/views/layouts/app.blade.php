<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bolsa de Trabajo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar Mejorado --}}
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('index') }}" class="flex items-center">
                        {{-- Coloca tu logo en public/images/logo.jpg --}}
                        <img class="h-8 w-8 mr-2" src="{{ asset('images/logo.jpg') }}" alt="Logo">
                        <span class="font-bold text-xl">Bolsa de Trabajo</span>
                    </a>
                </div>
                <!-- Botón menú móvil -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="inline-flex items-center justify-center p-2 rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                        <span class="sr-only">Abrir menú</span>
                        <!-- Icono de hamburguesa -->
                        <svg class="h-6 w-6" xmlns="www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <!-- Menú escritorio -->
                <div class="hidden md:flex space-x-4">
                    <a href="{{ route('index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-500 {{ request()->routeIs('index') ? 'bg-blue-800' : '' }}">Inicio</a>
                    <a href="{{ route('busqueda') }}" class="px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-500 {{ request()->routeIs('busqueda') ? 'bg-blue-800' : '' }}">Postulantes</a>
                    <a href="{{ route('postulante_nuevo') }}" class="px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-500 {{ request()->routeIs('postulante_nuevo') ? 'bg-blue-800' : '' }}">Nuevo Postulante</a>
                    <a href="{{ route('buscar_empresa') }}" class="px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-500 {{ request()->routeIs('empresa_nuevo') ? 'bg-blue-800' : '' }}">Empresas</a>
                    <a href="{{ route('ingresos') }}" class="px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-500 {{ request()->routeIs('ingresos') ? 'bg-blue-800' : '' }}">Ingresos</a>
                </div>
            </div>
        </div>
        <!-- Menú móvil -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500">Inicio</a>
                <a href="{{ route('busqueda') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500">Postulantes</a>
                <a href="{{ route('postulante_nuevo') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500">Nuevo Postulante</a>
                <a href="{{ route('empresa_nuevo') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500">Empresas</a>
                <a href="{{ route('ingresos') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500">Ingresos</a>
            </div>
        </div>
    </nav>

    {{-- Contenedor principal --}}
    <div class="flex-1 max-w-7xl mx-auto px-4 py-8">
        {{-- Aquí incluimos el partial que muestra los mensajes flash --}}
        @include('partials.flash-messages')

        {{-- Contenido específico de cada vista --}}
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="bg-indigo-700 text-white py-4 text-center text-sm">
        &copy; {{ date('Y') }} Bolsa de Trabajo — Municipalidad
    </footer>

    <script>
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>
</body>
</html>
