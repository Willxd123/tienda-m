<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Principal',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Rangos',
        'route' => route('admin.rangos.index'),
    ],
    [
        'name' => 'Miembros del Nivel: ' . $rango->nivel,
    ],
]">

@if ($promotores->count())

<div class="card">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Nit</th>
                    <th scope="col" class="px-6 py-3">Dirección</th>
                    <th scope="col" class="px-6 py-3">Teléfono</th>
                    <th scope="col" class="px-6 py-3">Correo</th>
                    <th scope="col" class="px-6 py-3">Puntos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotores as $promotor)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $promotor->id }}
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">{{ $promotor->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">{{ $promotor->nit }}</td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">{{ $promotor->direccion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">{{ $promotor->telefono }}</td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">{{ $promotor->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">{{ $promotor->puntos }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $promotores->links() }}
</div>
@else
{{-- ALERTA - WARNING --}}
<div id="alert-1" class="flex items-center p-4 mb-4 mt-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">Info</span>
    <div class="ms-3 text-sm font-medium">
        Aun no se reguistraron promotores....
    </div>
</div>
@endif

</x-admin-layout>
