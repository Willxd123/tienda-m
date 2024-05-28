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
                                    <div class="swiper-slide"><img src="{{ $premio->producto->imagenes[1]->ruta }}"></div>
                                    <div class="swiper-slide"><img src="{{ $premio->producto->imagenes[2]->ruta }}"></div>
                                    <div class="swiper-slide"><img src="{{ $premio->producto->imagenes[3]->ruta }}"></div>
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
                        {{ $premio->producto->nombre }}
                    </h1>
                    
                    <p class="font-semibold text-2xl text-gray-600 mb-4">
                        {{ $premio->precio_puntos }}
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
                    <div class="text-sm py-2">
                        {{ $premio->producto->descripcion }}
                    </div>
                    <button class="btn btn-blue w-full mb-6" wire:click="cange">
                        Canjear Producto
                    </button>
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
    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            // Escuchar el evento para confirmar el canje
            window.addEventListener('confirm-cange', function () {
                Swal.fire({
                    title: '¿Estás seguro de canjear el premio?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, canjear',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Acción de canje confirmada
                        Livewire.emit('canjeConfirmed');
                    }
                });
            });

            // Escuchar el evento para mostrar el mensaje de error
            window.addEventListener('swal', function (event) {
                Swal.fire({
                    icon: event.detail.icon,
                    title: event.detail.title,
                    text: event.detail.text
                });
            });
        });
        </script>
    @endpush
</div>

