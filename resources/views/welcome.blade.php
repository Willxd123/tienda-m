<x-app-layout>
    <figure class="w-full mb-4">
        <div class="swiper ">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($portadas as $portada)
                    <div class="swiper-slide"><img src="{{ $portada->imagen }}"
                            class="w-full aspect-[3/1] object-cover object-center"></div>
                @endforeach
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </figure>

    <div class="flex items-center justify-center h-screenobject-cover object-center ">
        <a href="{{ route('welcome.show', $catalogo) }}" target="_blank" class="btn btn-gray">
            ver catalogo
        </a>
    </div>
    
    @auth
        <hr class="my-6 border-2 border-dashed border-gray-400 sm:mx-auto lg:my-8" />
        <div class="w-full mx-auto ">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($premios as $premio)
                        <div class="swiper-slide flex w-full h-full hover:shadow-2xl hover:shadow-gray-600">
                            <article
                                class="bg-white shadow-xl rounded overflow-hidden mx-auto flex flex-col justify-between h-72">
                                <div class="py-3 flex-shrink-0">
                                    <img src="{{ $premio->producto->imagen }}"
                                        class="w-4/5 mx-auto rounded-t max-h-36 object-contain">
                                </div>
                                <div class="p-2 flex flex-col justify-between flex-grow">
                                    <div>
                                        <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[20px]">
                                            {{ $premio->producto->nombre }}
                                        </h1>
                                        <p class="text-base sm:text-lg text-gray-600 mb-2">
                                            Puntos: {{ $premio->precio_puntos }}
                                        </p>
                                    </div>
                                    @if ($premio->stock > 0)
                                        <a href="{{ route('cliente.premios.show', $premio) }}"
                                            class="btn btn-blue block w-full text-center sm:w-auto">
                                            Ver más
                                        </a>
                                    @else
                                        <span class="text-white-500 block btn btn-red w-full text-center">Agotado</span>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="my-6 border-2 border-dashed border-gray-400 sm:mx-auto lg:my-8" />

    @endauth
    <div class="px-4">
        <x-container>

            <!-- Productos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6 ">
                @foreach ($productos as $producto)
                    <div class="hover:shadow-2xl hover:shadow-gray-600">
                        <article class="bg-white shadow-xl rounded-lg overflow-hidden ">
                            <img src="{{ $producto->imagen }}" class="aspect-[1/1] w-full object-cover object-center">
                            <div class="p-4">
                                <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[40px]">
                                    {{ $producto->nombre }}
                                </h1>
                                <div class="flex justify-between items-center mb-2">
                                    <p class="text-gray-600 text-lg font-semibold">
                                        Bs/ {{ $producto->precio }}
                                    </p>
                                    @auth
                                        <p class="text-gray-600">
                                            {{ $producto->puntos }} Puntos
                                        </p>
                                    @endauth
                                </div>
                                @if ($producto->stock > 0)
                                    <a href="{{ route('cliente.productos.show', $producto) }}"
                                        class="btn btn-blue block w-full text-center">
                                        Ver más
                                    </a>
                                @else
                                    <span class="text-white-500 block btn btn-red w-full text-center">Agotado</span>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

        </x-container>
    </div>

    <style>
        .swiper-slide h1 {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Número de líneas que queremos mostrar */
            -webkit-box-orient: vertical;
        }
    </style>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 2, // Mostrará 5 premios a la vez
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3000,
                },
                pagination: {
                    el: '.swiper-paginations',
                    clickable: true,
                },
                breakpoints: {
                    // cuando la pantalla sea <= 640px
                    640: {
                        slidesPerView: 2, // Mostrará 2 premios en dispositivos móviles
                        spaceBetween: 10
                    },
                    // cuando la pantalla sea <= 768px
                    768: {
                        slidesPerView: 3, // Mostrará 3 premios en pantallas medianas
                        spaceBetween: 15
                    },
                    // cuando la pantalla sea >= 1024px
                    1024: {
                        slidesPerView: 5, // Mostrará 5 premios en pantallas grandes
                        spaceBetween: 20
                    }
                }
            });
        });
    </script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    {{-- ---------------------------------------------------------------------------------------------------------- --}}

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endpush
    @push('js2')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                loop: true,
                autoplay: {
                    delay: 7000,
                },

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        </script>
    @endpush
</x-app-layout>