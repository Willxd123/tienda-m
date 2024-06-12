<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Principal',
        'route' => route('admin.dashboard'),
    ],

    [
        'name' => 'Rangos',
    ],
]">

    <x-slot name="action">
        <a class="btn btn-blue" href="{{ route('admin.rangos.create') }}">
            Nuevo
        </a>
    </x-slot>

    @if ($rangos->count())

        <div class="card">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Id</th>
                            <th scope="col" class="px-6 py-3">Nivel</th>
                            <th scope="col" class="px-6 py-3">Descuento</th>
                            <th scope="col" class="px-6 py-3">Compras mínimas</th>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($rangos as $rango)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $rango->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $rango->nivel }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $rango->descuento }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $rango->compras_minimas }}
                                </td>
                                <td class="px-6 py-4 text-center md:text-left">
                                    <a href="{{ route('admin.rangos.edit', $rango) }}" class="inline-block">
                                        <b>Editar</b>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-center md:text-left">
                                    <a href="{{ route('admin.rangos.show', $rango) }}" class="inline-block">
                                        <b>Ver</b>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $rangos->links() }}
        </div>
    @else
        {{-- ALERTA - WARNING --}}
        <div id="alert-1"
            class="flex items-center p-4 mb-4 mt-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                A simple info alert with an <a href="#" class="font-semibold underline hover:no-underline">No hay
                    información cargada.</a>
            </div>
        </div>
    @endif

</x-admin-layout>
