<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Principal',
        'route' => route('admin.dashboard'),
    ],

    [
        'name' => 'Lista de Usuarios',
    ],
]">

    <x-slot name="action">
        <a class= "btn btn-blue" href="{{ route('admin.users.create') }}">
            Nuevo Usuario
        </a>
    </x-slot>

    @if ($users->count())

        <div class="card">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Id</th>
                            <th scope="col" class="px-6 py-3">Nombre</th>
                            <th scope="col" class="px-6 py-3">Correo</th>
                            <th scope="col" class="px-6 py-3">Rol</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"> 
                                    {{ $user->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <ul class="list-none">
                                        @foreach ($user->roles as $role)
                                            <li>{{ $role->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>                           
                                <td class="px-6 py-4 text-center md:text-left">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-block">
                                        <b>Editar</b>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
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

    </div>

</x-admin-layout>
