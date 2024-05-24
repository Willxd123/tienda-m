<x-app-layout>
    <div class="px-4 py-3 ">
        <x-container>
            <h1 class="text-3x1 font-bold text-gray-700 mb-4">
                {{-- Ultimo productos --}}
                Últimos productos
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($productos as $producto)
                    <article class="bg-white shadow rounded overflow-hidden">
                        <img src="{{ $producto->imagen}}" class="aspect-[1/1] w-full object-cover object-center"> 
                        <div class="p-4">
                            <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px]">
                                {{ $producto->nombre }}
                            </h1>
                            <p class="text-gray-600 mb-2">
                                Bs/ {{ $producto->precio }}
                            </p>
                            @if ($producto->stock > 0)
                                <a href="{{ route('cliente.productos.show', $producto) }}" class="btn btn-blue block w-full text-center">
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
</x-app-layout>