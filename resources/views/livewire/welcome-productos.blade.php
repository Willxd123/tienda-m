<div {{-- x-data="{ abrir: false }" --}}>
    <div class="flex-1 hidden md:block">
        <x-input wire:model.live="search" @click="abrir = true" class="w-full" placeholder="Buscar producto" />
    </div>
    <div x-show="abrir && $wire.search" @click.away="abrir = false" style="display: none" class="relative">
        <div class="absolute bg-white shadow-lg rounded-lg w-full mt-1 z-10">
            @if ($productos->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6 mt-6">
                    @foreach ($productos as $producto)
                        <div class="flex p-4 hover:bg-gray-100">
                            <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}"
                                class="aspect-[1/1] size-32 object-center">
                            <div class="ml-4">
                                <p class="font-semibold text-gray-700">{{ $producto->nombre }}</p>
                                @php
                                    $precioOriginal = $producto->precio;
                                    $precioConDescuento = $precioOriginal;
                                    $user = Auth::user();

                                    if ($user && $user->promotor) {
                                        $promotor = $user->promotor;
                                        $rango = $promotor->rango;
                                        $descuento = $rango->descuento;
                                        $precioConDescuento = $precioOriginal - $precioOriginal * ($descuento / 100);
                                    }
                                @endphp

                                <p class="text-gray-600 text-sm">{{ $precioConDescuento }} Bs</p>

                                @if ($producto->stock > 0)
                                    <a href="{{ route('cliente.productos.show', $producto) }}"
                                        class="btn btn-blue block w-full text-center">
                                        Ver más
                                    </a>
                                @else
                                    <span class="text-white-500 block btn btn-red w-full text-center">Agotado</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif ($search)
                <div class="p-4">
                    <p class="text-gray-600">No se encontraron productos</p>
                </div>
            @endif
        </div>
    </div>
</div>
