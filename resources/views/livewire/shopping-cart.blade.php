<div>
    <div class=" px-4 my-5">
        <div class="grid grid-cols-1  lg:grid-cols-7 gap-6">
            <div class="lg:col-span-5">
                <div class="flex justify-between mb-2">
                    <h1 class="text-lg">
                        Carrito de compras ({{ Cart::content()->count() }} productos)
                    </h1>
                    <button class="font-semibold text-gray-600 hover:text-blue-400" wire:click="destroy()">
                        Limpiar carrito
                    </button>
                </div>
                <div class="card">
                    <ul class="space-y-4">
                        @php
                            $user = Auth::user();
                            $subtotalConDescuento = 0;
                        @endphp
                        @forelse (Cart::content() as $item)
                            @php
                                $precioOriginal = $item->price;
                                $precioConDescuento = $precioOriginal;

                                if ($user && $user->promotor && !$user->admin) {
                                    $promotor = $user->promotor;
                                    $rango = $promotor->rango;
                                    $descuento = $rango->descuento;
                                    $precioConDescuento = $precioOriginal - $precioOriginal * ($descuento / 100);
                                }

                                $subtotalConDescuento += $precioConDescuento * $item->qty;
                            @endphp
                            <li class="lg:flex">
                                <img class="w-full lg:w-36 aspect-square object-cover object-center mr-2"
                                    src="{{ $item->options->image }}" alt="">
                                <div class="w-80 mb-2">
                                    <p class="text-sm">
                                        <a href="{{ route('cliente.productos.show', $item->id) }}">
                                            {{ $item->name }}
                                        </a>
                                    </p>
                                    <button
                                        class="bg-red-100 hover:bg-red-200 text-red-800 text-sm font-semibold rounded px-2 py-0.5"
                                        wire:click="remove('{{ $item->rowId }}')">
                                        <i class="fa-solid fa-xmark"></i>
                                        Quitar
                                    </button>
                                </div>
                                <p>
                                    Bs/ {{ $precioConDescuento }}
                                </p>
                                <div class="ml-auto space-x-3">
                                    <button class="btn btn-gray" wire:click="decrease('{{ $item->rowId }}')">
                                        -
                                    </button>
                                    <span class="inline-block w-2 text-center">
                                        {{ $item->qty }}
                                    </span>
                                    <button class="btn btn-gray" wire:click="increase('{{ $item->rowId }}')">
                                        +
                                    </button>
                                </div>
                            </li>
                        @empty
                            <p class="text-center">
                                No hay productos en el carrito
                            </p>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="lg:col-span-2 ">
                <div class="card">
                    <div class="flex justify-between font-semibold mb-2">
                        <p>
                            Total
                        </p>
                        <p>
                            @if ($user && $user->is_admin)
                                Bs/ {{ Cart::subtotal() }}
                            @else
                                Bs/ {{ $subtotalConDescuento }}
                            @endif
                        </p>
                    </div>
                    <form action="{{ route('session') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-blue block w-full text-center">
                            Continuar compra
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
