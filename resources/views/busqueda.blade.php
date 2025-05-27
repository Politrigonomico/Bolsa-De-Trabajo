
  @extends('layouts.app')
  @section('title', 'Busqueda – Municipalidad')
<body class="bg-gray-100 p-8 font-sans">
  <h1 class="text-2xl font-bold text-gray-800 mb-6">Listado de Postulantes</h1>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300 shadow-sm">
      <thead>
        <tr class="bg-blue-600 text-white">
          <th class="px-4 py-2 text-left">Nombre</th>
          <th class="px-4 py-2 text-left">Apellido</th>
          <th class="px-4 py-2 text-left">DNI</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left">Teléfono</th>
          <th class="px-4 py-2 text-left">Localidad</th>
          <th class="px-4 py-2 text-left">Profesión</th>
        </tr>
      </thead>
      <tbody>
        @foreach($postulantes as $postulante)
          <tr class="border-t border-gray-200 hover:bg-gray-100">
            <td class="px-4 py-2">{{ $postulante->nombre }}</td>
            <td class="px-4 py-2">{{ $postulante->apellido }}</td>
            <td class="px-4 py-2">{{ $postulante->dni }}</td>
            <td class="px-4 py-2">{{ $postulante->email }}</td>
            <td class="px-4 py-2">{{ $postulante->telefono }}</td>
            <td class="px-4 py-2">{{ $postulante->localidad }}</td>
            <td class="px-4 py-2">{{ $postulante->profesion ?? 'N/A' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>