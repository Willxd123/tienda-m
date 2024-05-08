<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categoria',
        'route' => route('admin.categorias.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">
    <form action="{{ route('admin.categorias.store') }}" method="POST">
        <div class="card">

            @csrf
            <x-validation-errors class="mb-4" />


            <div class="mb-4 ">
                <!-- select categoria -->
                <div class="mb-4">
                    <x-label for="familia_id" class="mb-2">familia</x-label>

                    <x-select name="familia_id" class="w-full">
                        
                        <option value="" disabled>Seleccione una familia</option>
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}"
                                @selected(old('familia_id')== $familia->id)>
                                {{$familia->nombre}}
                            </option>
                        @endforeach
                    </x-select>
                </div>


                <div>
                    <x-label for="nombre" class="mb-3">Nombre</x-label>
                    <x-input class="w-full" id="nombre" placeholder="Ingrese el nombre" name="nombre"
                        value="{{ old('nombre') }}" />
                </div>
            </div>
            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>

        </div>
    </form>
</x-admin-layout>
