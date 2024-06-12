<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
    ],
]">

    <!-- Botón "Nuevo" -->
    {{-- <div>
        <x-slot name="action">
            <a class="btn btn-blue" href="{{ route('admin.catalogos.create') }}">
                Nuevo
            </a>
        </x-slot>
    </div> --}}

    @if ($catalogos->count())
        @foreach ($catalogos as $catalogo)
        <div class="mb-5 flex items-end justify-end -mt-16">
            <a href="{{ route('admin.catalogos.edit', $catalogo) }}" class="btn btn-blue ">
                Editar
            </a>
        </div>

        <div class="flex items-center justify-center w-full mb-2">
            <a href="{{ route('admin.catalogos.show', $catalogo) }}" target="_blank"
               class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <div class="text-5xl mb-4 text-gray-500 dark:text-gray-400" >
                        <i class="fa-solid fa-file-arrow-down "></i>
                    </div>
                    <p id="file-name" class="mb-2 text-lg text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para
                        ver </span> el {{ $catalogo->nombre }}</p>
                    {{-- <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                            class="font-semibold">{{ $catalogo->nombre }}</span></p> --}}
                </div>
            </a>
        </div>
        @endforeach
        <!-- Paginación -->
        {{-- <div>
            {{ $catalogos->links() }}
        </div> --}}
    @else
        <!-- Estilo de alertas -->
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Info alert!</span> Aún no se ha registrado ningún catálogo.
            </div>
        </div>
    @endif
</x-admin-layout>
