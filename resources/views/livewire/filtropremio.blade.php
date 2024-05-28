<div class="bg-white py-12">
    <div class=" px-4 flex">
        <x-container class=" px-4 flex">
            <div class="md:flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($premios as $premio)
                        <article class="bg-white shadow rounded overflow-hidden">
                             <img src="{{ $premio->producto->image }}" class="w-full h-48 object-cover object-center"> 
                             <div class="p-4">
                                <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px] ">
                                    {{$premio->producto->nombre}}
                                </h1>
                                <p class="text-gray-600 mb-2">
                                   Puntos: {{$premio->precio_puntos}}
                                </p>
                                <a href="{{route('cliente.premios.show', $premio)}}" class="btn btn-blue block w-full text-center">
                                    Ver mas
                                </a>
                             </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{$premios->links()}}
                </div>
            </div>
        </x-container>
    </div>

</div>

