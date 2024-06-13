<div>
    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="aspect-w-1 aspect-h-1 object-cover object-center bg-white">
                        <figure class="w-full ">
                            <!-- Slider main container -->
                            <div class="swiper ">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    @foreach ($producto->imagenes as $imagen)
                                    <div class="swiper-slide">
                                        <img src="{{ $imagen->ruta }}" class="mx-auto object-center size-[520px]" style="max-height: 100%; max-width: 100%;" />
                                    </div>
                                    @endforeach
                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </figure>
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
                        Bs/ {{ $producto->precio }}
                    </p>
                    <div class="flex items-center space-x-6 mb-6" x-data="{
                        qty: @entangle('qty'),
                         }">
                        <button class="btn btn-gray" x-on:click="qty = qty - 1" x-bind:disabled="qty == 1">
                            -
                        </button>
                        <span x-text="qty" class="inline-block w-2 text-center"> </span>
                        <button class="btn btn-gray" x-on:click="qty = qty + 1">
                            +
                        </button>
                    </div>
                    <button class="btn btn-blue w-full mb-6" wire:click="carrito">
                        Agregar al carrito
                    </button>

                    <div class="text-sm py-2">
                        {{ $producto->descripcion }}
                    </div>
                </div>
            </div>
        </div>
    </x-container>

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
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        </script>
    @endpush
</div>
