<x-app-layout>
    <div class="px-4 py-3 ">
        <x-container>
            <h1 class="text-3x1 font-bold text-gray-700 mb-4">
                Ultimo productos
                
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($productos as $producto)
                    <article class="bg-white shadow rounded overflow-hidden">
                         <img src="{{ $producto->imagenes[2]->ruta }}" class="aspect-[1/1] w-full object-cover object-center"> 
                         <div class="p-4">
                            <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px] ">
                                {{$producto->nombre}}
                            </h1>
                            <p class="text-gray-600 mb-2">
                               Bs/ {{$producto->precio}}
                            </p>

                            <a href="{{route('cliente.productos.show', $producto)}}" class="btn btn-blue block w-full text-center">
                                Ver mas
                            </a>
                         </div>
                    </article>
                @endforeach
            </div>
        </x-container>
        <div class="mt-16">
            @include('layouts.particiones.app.footer')
        </div>
    </div>
</x-app-layout>
