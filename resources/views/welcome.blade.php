<x-app-layout>
    <div class="px-4 py-3">
        <x-container>
            @auth
                <div class="w- mx-auto">
                    <!-- Swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($premios as $premio)
                                <div class="swiper-slide flex justify-center items-center">
                                    <article class="bg-white shadow rounded overflow-hidden mx-auto" style="width: 50%;">
                                        <div class="relative">
                                            <img src="{{ $premio->producto->imagen }}" style="width: 80%;"
                                                class="h-auto mx-auto rounded-t">
                                        </div>
                                        <div class="p-2 relative">
                                            <div>
                                                <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[20px]">
                                                    {{ $premio->producto->nombre }}
                                                </h1>
                                                <p class="text-base sm:text-lg text-gray-600 mb-2">
                                                    Puntos: {{ $premio->precio_puntos }}
                                                </p>
                                            </div>
                                            <a href="{{ route('cliente.premios.show', $premio) }}" class="btn btn-gray block w-full text-center sm:w-auto">
                                                Ver más
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endauth

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
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 3, // Cambia este valor según cuántas imágenes deseas mostrar a la vez (3 o 4)
                spaceBetween: 80,
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
    </script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

</x-app-layout>
