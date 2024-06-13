<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Promotor',
    ],
]">
    <x-slot name="action">
        <a class="btn btn-blue" href="{{route('admin.promotors.create')}}">
            Nuevo
        </a>
    </x-slot>

    @if ($promotores->count())
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NIT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Telefono
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Direccion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Correo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Puntos
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nivel del Rango
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotores as $promotor)
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $promotor->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $promotor->nit }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promotor->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promotor->telefono }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promotor->direccion }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promotor->user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promotor->puntos }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promotor->rango->nivel }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.promotors.edit', $promotor) }}">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $promotores->links() }}
        </div>
    @else
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Info alert!</span> Aun no se registraron promotores...
            </div>
        </div>
    @endif
</x-admin-layout>
