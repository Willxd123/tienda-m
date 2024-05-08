<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Proveedor',
        'route' => route('admin.proveedors.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">
    <div class="card">
        <form action="{{ route('admin.proveedors.store') }}" method="POST">
            @csrf

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-3">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="ingrese el nombre del proveedor" 
                name="nombre"
                value="{{old('nombre')}}"/>

                <x-label class="mb-3">
                    Direccion
                </x-label>
                <x-input class="w-full" placeholder="ingrese la direccion del proveedor" 
                name="direccion"
                value="{{old('direccion')}}"/>

                <x-label class="mb-3">
                    Correo
                </x-label>
                <x-input class="w-full" placeholder="ingrese el correo del proveedor" 
                name="correo"
                value="{{old('correo')}}"/>
           
                <x-label class="mb-3">
                    Encargado
                </x-label>
                <x-input class="w-full" placeholder="ingrese el nombre del encargado" 
                name="encargado"
                value="{{old('encargado')}}"/>                
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>

        </form>

    </div>
</x-admin-layout>
