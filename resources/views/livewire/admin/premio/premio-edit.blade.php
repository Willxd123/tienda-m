<div>
    <form wire:submit="store" enctype="multipart/form-data">

        <div class="card">
            <div>
                <x-validation-errors class="mb-4" />

                <div class="mb-4">

                    {{-- Select de producto --}}
                    <div class="mb-4 flex-1">
                        <x-label>Producto</x-label>
                        <x-select wire:model="premioEdit.producto_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700">
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $productoItem)
                                <option value="{{ $productoItem->id }}">{{ $productoItem->nombre }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div>
                        <x-label class="mb-3">Stock</x-label>
                        <x-input type="number" class="w-full" placeholder="Ingrese el stock del premio"
                            wire:model="premioEdit.stock" />
                    </div>

                    <div>
                        <x-label class="mb-3">Precio</x-label>
                        <x-input type="number" step="0.01" class="w-full" placeholder="Ingrese el precio del premio"
                            wire:model="premioEdit.precio_puntos" />
                    </div>
                </div>

                <div class="flex justify-end py-3">
                    <x-danger-button onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                        Eliminar
                    </x-danger-button>

                    <x-button class="ml-2">
                        Actualizar
                    </x-button>
                </div>

            </div>
        </div>
    </form>
    
    <form action="{{ route('admin.premios.destroy', $premioEdit['id']) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

</div>
