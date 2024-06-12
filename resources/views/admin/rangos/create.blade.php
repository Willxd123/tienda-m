<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Principal',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Rangos',
        'route' => route('admin.rangos.index'),
    ],
    [
        'name' => 'Nuevo Rango',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.rangos.store') }}" method="POST" class="card-body">
            @csrf

            <div class="mb-4">
                <!-- NIVEL -->
                <x-label for="nivel" class="block font-medium mb-2">
                    Nivel
                </x-label>
                <x-input type="text" name="nivel" id="nivel" class="w-full"
                    placeholder="Ingrese el nivel" value="{{ old('nivel') }}" required autofocus />
            </div>

            <div class="mb-4">
                <!-- DESCUENTO -->
                <x-label for="descuento" class="block font-medium mb-2">
                    Descuento
                </x-label>
                <x-input type="text" name="descuento" id="descuento" class="w-full"
                    placeholder="Ingrese el descuento" value="{{ old('descuento') }}" required />
            </div>

            <div class="mb-4">
                <!-- COMPRAS MÍNIMAS -->
                <x-label for="compras_minimas" class="block font-medium mb-2">
                    Compras Mínimas
                </x-label>
                <x-input type="text" name="compras_minimas" id="compras_minimas" class="w-full"
                    placeholder="Ingrese las compras mínimas" value="{{ old('compras_minimas') }}" required />
            </div>

            <div class="flex justify-end ">
                <x-button class="ml-2">
                    Guardar
                </x-button>
            </div>

        </form>
    </div>

</x-admin-layout>
