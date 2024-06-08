<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Mis Premios',
        'route' => route('admin.premios_promotors.index'),
    ],
    [
        'name' => 'Detalle del Premio',
    ],
]">

<div class="container mx-auto py-6">
    <h1 class="text-lg font-bold mb-6">
        Detalle del Premio
    </h1>

    <!-- Información del premio del promotor -->
    <div class="mt-4">
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            ID: 
        </th></b>
            {{ $premio_promotor->id }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Promotor: 
        </th></b>
            {{ $premio_promotor->promotor->user->name }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Premio: 
        </th></b>
            {{ $premio_promotor->premio->producto->nombre }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Cantidad:
        </th></b>
            {{ $premio_promotor->cantidad }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Fecha: 
        </th></b>
            {{ $premio_promotor->fecha }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Monto Total: 
        </th></b>
            {{ $premio_promotor->cantidad * $premio_promotor->premio->precio_puntos}}
        </p>
    </div>
</div>
</x-admin-layout>