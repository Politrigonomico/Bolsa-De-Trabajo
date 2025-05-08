<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digitalizar CVs - Municipalidad</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen p-8">

  <!-- Encabezado -->
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-blue-800">Digitalización de CVs - Municipalidad</h1>
    <p class="text-blue-600">Panel de gestión para secretaría de empleo</p>
  </header>

  <!-- Filtros -->
  <section class="mb-6 bg-white p-4 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-2 text-blue-700">Filtrar por Título</h2>
    <div class="flex gap-4 items-center">
      <select class="border border-blue-300 rounded px-3 py-2 w-full max-w-md">
        <option value="">Todos los títulos</option>
        <option>Contador Público</option>
        <option>Lic. en Administración</option>
        <option>Técnico en Informática</option>
      </select>
      <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Buscar</button>
    </div>
  </section>

  <!-- Formulario de carga -->
  <section class="mb-8 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4 text-blue-700">Subir nuevo CV</h2>
    <form class="space-y-4">
      <div>
        <label class="block font-medium text-blue-800">Nombre completo</label>
        <input type="text" class="mt-1 w-full border border-blue-300 rounded px-3 py-2" placeholder="Ej: Juan Pérez">
      </div>
      <div>
        <label class="block font-medium text-blue-800">Título profesional</label>
        <input type="text" class="mt-1 w-full border border-blue-300 rounded px-3 py-2" placeholder="Ej: Lic. en Psicología">
      </div>
      <div>
        <label class="block font-medium text-blue-800">Archivo PDF del CV</label>
        <input type="file" accept="application/pdf" class="mt-1 w-full border border-blue-300 rounded px-3 py-2">
      </div>
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Subir CV</button>
    </form>
  </section>

  <!-- Tabla de resultados -->
  <section class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4 text-blue-700">CVs Cargados</h2>
    <table class="min-w-full table-auto border border-blue-200">
      <thead class="bg-blue-100">
        <tr>
          <th class="px-4 py-2 text-left text-blue-800">Nombre</th>
          <th class="px-4 py-2 text-left text-blue-800">Título</th>
          <th class="px-4 py-2 text-left text-blue-800">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-t">
          <td class="px-4 py-2">Lucía Gómez</td>
          <td class="px-4 py-2">Contadora Pública</td>
          <td class="px-4 py-2">
            <a href="#" class="text-blue-600 hover:underline">Ver CV</a>
          </td>
        </tr>
        <tr class="border-t">
          <td class="px-4 py-2">Carlos Ruiz</td>
          <td class="px-4 py-2">Técnico en Electricidad</td>
          <td class="px-4 py-2">
            <a href="#" class="text-blue-600 hover:underline">Ver CV</a>
          </td>
        </tr>
      </tbody>
    </table>
  </section>

</body>
</html>
