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
    <div class="px-4 py-3">
        <x-container>
            @auth
                <div class="mx-auto" style="max-width: 350px;">
                    <!-- Swiper -->

                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($premios as $premio)
                                <div class="swiper-slide flex justify-center items-center" style="width: 100%;">
                                    <a href="{{ route('cliente.premios.show', $premio->producto) }}">
                                        <img src="{{ $premio->producto->imagen }}" alt="{{ $premio->producto->nombre }}"
                                            style="max-width: 100%;" class="h-auto">
                                    </a>
                                </div>
                            @endforeach

                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            @endauth


            <!-- Slider main container -->



            <!-- Productos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                @foreach ($productos as $producto)
                    <article class="bg-white shadow rounded overflow-hidden">
                        <img src="{{ $producto->imagen }}" class="aspect-[1/1] w-full object-cover object-center">
                        <div class="p-4">
                            <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px]">
                                {{ $producto->nombre }}
                            </h1>
                            <p class="text-gray-600 mb-2">
                                Bs/ {{ $producto->precio }}
                            </p>
                            @can('promotor')
                                <p class="text-gray-600 mb-2">
                                    {{ $producto->puntos }} pt
                                </p>
                            @endcan
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
                @endforeach
            </div>
        </x-container>
    </div>

    <!-- Swiper JS -->
    {{--  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 'auto', // Muestra el número de diapositivas que caben en el contenedor
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3000,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    </script> --}}

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
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
