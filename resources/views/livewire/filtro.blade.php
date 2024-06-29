<div class="bg-white py-12">
    <div class=" px-4 flex">
        <x-container class=" px-4 flex">
            <div class="md:flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($productos as $producto)
                        <article class="bg-white shadow rounded overflow-hidden">
                            <img src="{{ $producto->imagen }}" class="w-full h-48 object-cover object-center">
                            <div class="p-4">
                                <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px] ">
                                    {{ $producto->nombre }}
                                </h1>
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
                                <p class="text-gray-600 mb-2">
                                    Bs/ {{ $precioConDescuento }}
                                </p>
                                <a href="{{ route('cliente.productos.show', $producto) }}"
                                    class="btn btn-blue block w-full text-center">
                                    Ver mas
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $productos->links() }}
                </div>
            </div>
        </x-container>
    </div>

</div>
