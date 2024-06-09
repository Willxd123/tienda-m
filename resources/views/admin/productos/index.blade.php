<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
    ],
]">

    <!--boton y el llamado a buttons.css-->
    <!-- Botón "Nuevo" -->
    <div>
        <x-slot name="action">
            <a class="btn btn-blue" href="{{ route('admin.productos.create') }}">
                Nuevo
            </a>
        </x-slot>
    </div>


    @if ($productos->count())
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
                            Familia
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Puntos
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $producto->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $producto->nombre }}
                            </td>
                            
                            <td class="px-6 py-4">
                                {{ $producto->subcategoria->categoria->familia->nombre }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $producto->subcategoria->categoria->nombre }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $producto->stock }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $producto->puntos }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $producto->precio }}
                            </td>

                            <td class="px-6 py-4">
                                <a href="{{ route('admin.productos.edit', $producto) }}">
                                    Editar
                                </a>
                            </td>
                            @if ($producto->imagenes->isEmpty())
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.imagenes.create', $producto) }}">
                                        Agregar Imágenes
                                    </a>
                                </td>
                            @else
                                <td class="px-6 py-4">
                                    <i class="fa-solid fa-check"></i>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


        <!-- paginacion-->
        <div>
            {{ $productos->links() }}
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
                <span class="font-medium">Info alert!</span> Aun no se reguistraron productos
            </div>
    @endif
</x-admin-layout>
