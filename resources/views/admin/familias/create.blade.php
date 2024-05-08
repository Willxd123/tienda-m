<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.familias.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">
    <div class="card">
        <form action="{{ route('admin.familias.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label class="mb-3">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="ingrese el nombre de la familia" 
                name="nombre"
                value="{{old('nombre')}}"/>
            </div>
            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>

        </form>

    </div>
</x-admin-layout>
