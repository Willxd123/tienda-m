<div>
    <div class="card">
        <form wire:submit="store">
            @csrf
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <div class="flex justify-between">
                    {{-- Select de Proveedor --}}
                    <div class="mb-4 flex-1">
                        <x-label>
                            Proveedor
                        </x-label>
                        <x-select wire:model="proveedor_id"
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700">
                            <option value="">Seleccione un proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </x-select>
                    </div>      
                    {{-- Select de producto --}}
                    <div class="mb-4 flex-1 ml-4">
                        <!-- Agrega un margen izquierdo para separar los selectores -->
                        <x-label>
                            Producto
                        </x-label>
                        <x-select wire:model="producto.producto_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700">
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $productoItem)
                                <option value="{{ $productoItem->id }}">{{ $productoItem->nombre }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="flex flex-col w-1/2 mr-2">
                        <x-label class="mb-1">
                            Cantidad
                        </x-label>
                        <x-input wire:model="producto.stock" class="w-full" placeholder="Ingrese la cantidad" />
                    </div>
                    <div class="flex flex-col w-1/2 ml-2">
                        <x-label class="mb-1">
                            Precio
                        </x-label>
                        <x-input wire:model="producto.precio" class="w-full" placeholder="Ingrese el precio" />
                    </div>
                </div>

                {{-- Botón de Agregar Producto --}}
                <div class="mt-4">
                    <x-button type="button" wire:click="agregarProducto">
                        Agregar Producto
                    </x-button>
                </div>

                {{-- Lista de Productos Agregados --}}

                <div class="mt-8">
                    <h2 class="text-lg font-bold mb-6 lg:text-center text-center">
                        Productos Agregados
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 bg-gray-100">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Producto
                                    </th>
                                    {{-- <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Proveedor
                                    </th> --}}
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            {{-- id="productos-agregados"  --}}
                            <tbody class="bg-white divide-y divide-gray-300">
                                @foreach ($lista_productos as $producto)
                                    <tr>
                                        <td class="px-6 py-2 text-sm text-gray-900 font-bold">
                                            {{ $producto['producto_id'] }}
                                        </td>
                                        <td class="px-6 py-2 text-sm text-gray-900 font-bold">
                                            {{ $producto['nombre'] }}
                                        </td>
                                        <td class="px-6 py-2 text-sm">
                                            {{ $producto['stock'] }}
                                        </td>
                                        <td class="px-6 py-2 text-sm">
                                            {{ $producto['precio'] }}
                                        </td>
                                        <td class="px-6 py-2 text-sm">
                                            {{ $producto['stock'] * $producto['precio'] }}
                                        </td>
                                        <td class="px-6 py-2 text-sm">
                                            <button type="button"
                                                wire:click="eliminarProducto({{ $producto['producto_id'] }})">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="mt-6">
                <h2 class="text-lg font-bold">
                    Total de la compra: {{ $nota_compras->monto_total }}
                </h2>
            </div>

            <div class="flex justify-end">
                <button type="submit" wire:click.prevent="store"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
