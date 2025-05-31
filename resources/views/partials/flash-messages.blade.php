{{-- resources/views/partials/flash-messages.blade.php --}}

{{-- Mensaje verde de éxito --}}
@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

{{-- Mensaje rojo de error personalizado --}}
@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
        {{ session('error') }}
    </div>
@endif

{{-- Mensajes de validación (amarillo) --}}
@if ($errors->any())
    <div class="mb-4 p-4 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
