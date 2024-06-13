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
                                    @foreach ($premio->producto->imagenes as $imagen)
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
                        Tus puntos: {{ $prom->puntos }}
                    </h1>
                    <br>
                    <h1 class="text-xl text-gray-600 mb-2">
                        {{ $premio->producto->nombre }}
                    </h1>

                    <p class="font-semibold text-2xl text-gray-600 mb-4">
                        {{ $premio->precio_puntos }} puntos
                    </p>
                    <div class="flex items-center space-x-6 mb-6" x-data="{
                        qty: @entangle('qty'),
                        maxQty: {{ $premio->stock }},
                         }">
                        <button class="btn btn-gray" x-on:click="qty = qty - 1" x-bind:disabled="qty == 1">
                            -
                        </button>
                        <span x-text="qty" class="inline-block w-2 text-center"> </span>
                        <button class="btn btn-gray" x-on:click="qty = qty + 1" x-bind:disabled="qty >= maxQty">
                            +
                        </button>
                    </div>
                    <div class="text-sm py-2">
                        {{ $premio->producto->descripcion }}
                    </div>
                    @if ($premio->stock > 0)
                        <button class="btn btn-blue w-full mb-6" wire:click="cange">
                            Canjear Producto
                        </button>
                    @else
                        <span class="text-white-500 block btn btn-red w-full text-center">Agotado</span>
                    @endif
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
