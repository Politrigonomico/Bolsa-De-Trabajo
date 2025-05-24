<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bolsa de Trabajo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-blue-700 text-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('index') }}" class="text-xl font-semibold">Bolsa de Trabajo</a>
            <ul class="flex gap-4 text-sm">
                <li><a href="{{ route('index') }}" class="hover:underline">Inicio</a></li>
                <li><a href="{{ route('busqueda') }}" class="hover:underline">Postulantes</a></li>
                <li><a href="{{ route('postulante_nuevo') }}" class="hover:underline">Nuevo Postulante</a></li>
                <li><a href="{{ route('empresa_nuevo') }}" class="hover:underline">Empresas</a></li>
                <li><a href="{{ route('ingresos') }}" class="hover:underline">Ingresos</a></li>
            </ul>
        </div>
    </nav>

    {{-- Contenido dinámico --}}
    <main class="flex-1 max-w-7xl mx-auto px-4 py-8 ">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-800 text-white py-4 text-center text-sm">
        &copy; {{ date('Y') }} Bolsa de Trabajo — Municipalidad
    </footer>

</body>
</html>