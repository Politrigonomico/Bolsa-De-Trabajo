<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Bolsa de Trabajo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex">

    {{-- Sidebar fijo --}}
    <aside class="w-64 bg-gradient-to-b from-orange-600 to-orange-500 text-white flex flex-col h-screen fixed top-0 left-0 shadow-lg z-50">
        <div class="flex items-center justify-center h-16 border-b border-orange-700">
            <a href="{{ route('index') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo_oficial.jpg') }}" alt="Logo" class="h-10 w-10 rounded-md shadow" />
                <span class="font-extrabold text-xl tracking-wide">Bolsa de Trabajo</span>
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-4 m-4">
            <h3 class="text-lg font-bold mb-2 text-orange-600">🔎 Búsqueda rápida</h3>
            <form action="{{ route('buscar') }}" method="GET">
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Buscar postulantes o empresas..." 
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-orange-400 text-gray-900"
                    value="{{ request('q') }}"
                    required
                >

                <button type="submit" class="mt-2 w-full bg-orange-600 text-white px-3 py-2 rounded hover:bg-orange-500 transition">
                    Buscar
                </button>
            </form>
        </div>

        <nav class="flex flex-col mt-2 space-y-1 px-4 flex-1 overflow-y-auto">
            <a href="{{ route('index') }}" class="block px-4 py-3 rounded-md font-semibold hover:bg-orange-700 transition {{ request()->routeIs('index') ? 'bg-orange-800' : '' }}">
                Inicio
            </a>
            <a href="{{ route('busqueda') }}" class="block px-4 py-3 rounded-md font-semibold hover:bg-orange-700 transition {{ request()->routeIs('busqueda') ? 'bg-orange-800' : '' }}">
                Postulantes
            </a>
            <a href="{{ route('postulante_nuevo') }}" class="block px-4 py-3 rounded-md font-semibold hover:bg-orange-700 transition {{ request()->routeIs('postulante_nuevo') ? 'bg-orange-800' : '' }}">
                Nuevo Postulante
            </a>
            <a href="{{ route('empresa_nuevo') }}" class="block px-4 py-3 rounded-md font-semibold hover:bg-orange-700 transition {{ request()->routeIs('empresa_nuevo') ? 'bg-orange-800' : '' }}">
                Nueva Empresa
            </a>
            <a href="{{ route('buscar_empresa') }}" class="block px-4 py-3 rounded-md font-semibold hover:bg-orange-700 transition {{ request()->routeIs('buscar_empresa') ? 'bg-orange-800' : '' }}">
                Empresas
            </a>

            <a href="{{ route('configuracion') }}" class="mt-auto block px-4 py-3 text-sm font-semibold hover:bg-orange-700 transition text-orange-100">
                ⚙️ Configuraciones
            </a>
        </nav>

        <footer class="px-4 py-3 border-t border-orange-700 text-center text-sm text-orange-100">
            &copy; {{ date('Y') }} Bolsa de Trabajo — Municipalidad
        </footer>
    </aside>

    {{-- Contenido principal --}}
    <main class="flex-1 ml-64 p-8 min-h-screen relative z-10">
        @include('partials.flash-messages')
        @yield('content')
    </main>

</body>
</html>
