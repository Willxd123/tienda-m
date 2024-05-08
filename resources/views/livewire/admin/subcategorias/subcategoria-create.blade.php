
<div>
    <form wire:submit="save">
        <div class="card">
            <div >
                <x-validation-errors class="mb-4"/>
                    <!-- select familia -->
                    <div class="mb-4">
                        <x-label class="mb-3">
                            Familia
                        </x-label>

                        <x-select class="w-full" wire:model.live="subcategoria.familia_id"
                        wire:loading.attr="disabled" wire:target="subcategoria.familia_id">
                            <option value="" disabled>Seleccione una familia</option>
                            @foreach ($familias as $familia)
                                <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-label class="mb-3">
                            categoria
                        </x-label>
                        <x-select class="w-full" wire:model.live="subcategoria.categoria_id">
                            <option value="" disabled {{ is_null($subcategoria['categoria_id']) ? 'selected' : '' }}>
                                Seleccione una categoría</option>
                            @foreach ($this->categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </x-select>
                        
                    </div>

                    <!-- select categoria -->

                    <div>
                        <x-label class="mb-3">Nombre</x-label>
                        <x-input class="w-full" placeholder="Ingrese el nombre de la subcategoria" name="nombre"
                            wire:model="subcategoria.nombre"/>
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button>Guardar</x-button>
                </div>

            </div>

    </form>

    @dump($subcategoria);

</div>



                  