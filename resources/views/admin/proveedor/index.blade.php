<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Proveedor',
    ],
]">
        <!--boton y el llamado a buttons.css-->
    <x-slot name="action">
        <a class="btn btn-blue" href="{{route('admin.proveedors.create')}}">
            Nuevo
        </a>
    </x-slot>


    @if ($proveedores->count())



        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Direccion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Correo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Encargado
                        </th>
                        
                        <th scope="col" class="px-6 py-3">

                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $proveedor->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $proveedor->nombre }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $proveedor->direccion }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $proveedor->correo }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $proveedor->encargado }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.proveedors.edit', $proveedor) }}">
                                    Editar
                                </a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


        <!-- paginacion-->
        <div>
            {{ $proveedores->links() }}
        </div>
    @else
        <!--estilo de alertas-->
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Info alert!</span> Aun no se registraron proveedores
            </div>
    @endif
</x-admin-layout>
