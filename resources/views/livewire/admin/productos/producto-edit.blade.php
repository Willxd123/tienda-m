<div>
    <form wire:submit="store" enctype="multipart/form-data">

        <!--imagen-->

        <div class="card">
            <div>
                <x-validation-errors class="mb-4" />

                <div class="mb-4">

                    <div>
                        <x-label class="mb-3">Nombre</x-label>
                        <x-input class="w-full" placeholder="Ingrese el nombre del producto"
                            wire:model="productoEdit.nombre" />
                    </div>
                    <div>
                        <x-label class="mb-3">stock</x-label>
                        <x-input type="number" class="w-full" placeholder="Ingrese el stock del producto"
                            wire:model="productoEdit.stock" />
                    </div>
                    <div>
                        <x-label class="mb-3">Descripcion</x-label>
                        <x-textarea class="w-full" placeholder="Ingrese la descripsion del producto"
                            wire:model="productoEdit.descripcion" />
                    </div>

                </div>

                <!-- select familia -->
                <x-label class="mb-3">Familia</x-label>
                <x-select class="w-full" wire:model.live="familia_id" wire:loading.attr="disabled"
                    wire:target="updatedProductoFamiliaId">
                    <option value="" disabled>Seleccione una familia</option>
                    @foreach ($familias as $familia)
                        <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                    @endforeach
                </x-select>

                <!-- select categoria -->
                <x-label class="mb-3">Categoría</x-label>
                <x-select class="w-full" wire:model.live="categoria_id" wire:loading.attr="disabled"
                    wire:target="updatedProductoCategoriaId">
                    <option value="" disabled {{ is_null($producto['categoria_id']) ? 'selected' : '' }}>
                        Seleccione una categoría</option>
                    @foreach ($this->categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </x-select>

                <!-- select subcategoria -->
                <x-label class="mb-3">Subcategoría</x-label>
                <x-select class="w-full" wire:model.live="productoEdit.subcategoria_id" wire:loading.attr="disabled"
                    wire:target="updatedProductoCategoriaId">
                    <option value="" disabled>Seleccione una subcategoría</option>
                    @foreach ($this->subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                    @endforeach
                </x-select>

                <div>
                    <x-label class="mb-3">Precio</x-label>
                    <x-input type="number" step="0.01" class="w-full" placeholder="Ingrese el precio del producto"
                        wire:model="productoEdit.precio" />
                </div>


                <div class="flex justify-end py-3">
                    <x-danger-button onclick="confirmDelete()">
                        Eliminar
                    </x-danger-button>
                    <x-button class="ml-2 ">Actualizar</x-button>
                </div>
            </div>
    </form>
    <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" id="delete-from">
        @csrf
        @method('DELETE')

    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {

                        document.getElementById('delete-from').submit();
                    }
                });
            }
        </script>
    @endpush
</div>
