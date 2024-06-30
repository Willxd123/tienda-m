<div>
    <a class="btn btn-gray" wire:click = "$set('open', true)">
        Versd
    </a>


    <x-dialog-modal wire:model="open">
        <x-slot name='title'>
            Compras de {{ $venta->promotor->user->name }}
        </x-slot>
        <x-slot name='content'>
            <div>
                <div class="grid grid-cols-2 gap-10">
                    <!-- Información de la nota de venta -->
                    <div class="mt-4">
                        <h1 class="text-lg font-bold mb-6 lg:text-center text-center">Informacion del promotor</h1>
                        <p><b>Promotor:</b> {{ $venta->promotor->user->name }}</p>
                        <p><b>Telefono:</b> {{ $promotor->telefono }}</p>
                        <p><b>Correo:</b> {{ $promotor->user->email }}</p>
                        <p><b>Nit:</b> {{ $promotor->nit }}</p>
                        <p><b>Dirrecion:</b> {{ $promotor->direccion }}</p>
                        <hr class="my-6 border-spacing-2 border-gray-400 sm:mx-auto lg:my-8" />
                        <h1 class="text-lg font-bold mb-6 lg:text-center text-center">Detalle de venta</h1>
                        <p><b>ID:</b> {{ $venta->id }}</p>
                        <p><b>Fecha de compra:</b> {{ $venta->fecha }}</p>
                        <p><b>Cantidad de productos:</b> {{ $totalCantidad }}</p>
                        <p><b>Monto Total:</b> {{ $venta->monto_total }}</p>
                    </div>
                    <div class="absolute top-10 right-0">
                        <img src="{{ $venta->promotor->user->profile_photo_path }}" alt="Foto de perfil"
                            class="size-60">
                    </div>
                </div>

                <!-- Detalles de los productos comprados -->
                <div class="mt-8">
                    <h2 class="text-lg font-bold mb-6 lg:text-center text-center">Productos Agregados</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 bg-gray-100">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Producto</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Cantidad</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Precio</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300">
                                @foreach ($detalles as $detalle)
                                    <tr>
                                        <td class="px-6 py-2 text-sm text-gray-900">{{ $detalle->id }}</td>
                                        <td class="px-6 py-2 text-sm text-gray-900">{{ $detalle->producto->nombre }}
                                        </td>
                                        <td class="px-6 py-2 text-sm">{{ $detalle->cantidad }}</td>
                                        <td class="px-6 py-2 text-sm">{{ $detalle->precio }}</td>
                                        <td class="px-6 py-2 text-sm">{{ $detalle->cantidad * $detalle->precio }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <div class="space-x-2" wire:click="$set('open', false)">
                <button class="btn btn-gray">
                    Cancelar
                </button>
                <button class="btn btn-blue" wire:click="verificarOrden" wire:loading.attr="disabled" class="disabled:opacity-25">
                    Confirmar Pedido
                </button>
            </div>

        </x-slot>
    </x-dialog-modal>
</div>
