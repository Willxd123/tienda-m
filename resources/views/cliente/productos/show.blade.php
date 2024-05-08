<x-app-layout>
    <div class=" px-4 my-4">
        <x-container class=" px-4 my-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('cliente.familias.show', $producto->subcategoria->categoria->familia) }}"
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                {{ $producto->subcategoria->categoria->familia->nombre }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('cliente.categorias.show', $producto->subcategoria->categoria) }}"
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                {{ $producto->subcategoria->categoria->nombre }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('cliente.subcategorias.show', $producto->subcategoria) }}"
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                {{ $producto->subcategoria->nombre }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                {{ $producto->nombre }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </x-container>
    </div>
    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <figure>
                        <img src="{{ $producto->imagenes[2]->ruta }}" class="aspect-[16/9] w-full object-cover object-center"
                            alt="">
                    </figure>
                    <div class="text-sm py-2">
                        {{ $producto->descripcion }}
                    </div>

                </div>
                <div class="col-span-1">
                    <h1 class="text-xl text-gray-600 mb-2">
                        {{ $producto->nombre }}
                    </h1>
                    <div class="flex items-center space-x-2 mb-4">
                        <ul class="flex  space-x-1 text-sm">
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                            <p class="text-sm text-gray-700">
                                calificacion
                            </p>
                        </ul>
                    </div>

                    <p class="font-semibold text-2xl text-gray-600 mb-4">
                       Bs/ {{$producto->precio}}
                    </p>

                    <div class="flex items-center space-x-6 mb-6">
                        <button class="btn btn-gray">
                            -
                        </button>
                        <span> 1</span>
                        <button class="btn btn-gray">
                            +
                        </button>
                    </div>
                    <button class="btn btn-blue w-full mb-6">
                        Agregar al carrito
                    </button>
                    <div class="text-gray-700 flex items-center space-x-4">
                        <i class="fa-solid fa-truck-fast text-2xl"></i>
                        <p>
                            Despacho a domicilio
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
