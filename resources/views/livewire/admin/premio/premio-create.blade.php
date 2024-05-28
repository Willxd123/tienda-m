<div>

    <button id="toggleFormButton"></button>

    <form wire:submit="store" enctype="multipart/form-data">

        <div class="card">
            <div>
                <x-validation-errors class="mb-4" />

                <div class="mb-4 space-y-4">

                    {{-- Select de producto --}}
                    <div class="mb-4 flex-1">
                        <!-- Agrega un margen izquierdo para separar los selectores -->
                        <x-label>
                            Producto
                        </x-label>
                        <x-select wire:model="premio.producto_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700">
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $productoItem)
                                <option value="{{ $productoItem->id }}">{{ $productoItem->nombre }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div>
                        <x-label class="mb-1">Stock</x-label>
                        <x-input type="number" class="w-full" placeholder="Ingrese el stock del premio"
                            wire:model="premio.stock" />
                    </div>

                    <div>
                        <x-label class="mb-1">Precio-Puntos</x-label>
                        <x-input type="number" class="w-full" placeholder="Ingrese el precio del premio"
                            wire:model="premio.precio_puntos" />
                    </div>
                </div>


                <div class="flex justify-end py-3">
                    <x-button>
                        Guardar
                    </x-button>
                </div>
            </div>       
    </form>
</div>
