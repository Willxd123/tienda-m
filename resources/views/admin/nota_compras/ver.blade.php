<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Compra',
        'route' => route('admin.nota_compras.index'),
    ],
    [
        'name' => 'Detalle Nota de Compra',
    ],
]">

<div class="container mx-auto py-6">
    <h1 class="text-lg font-bold mb-6">
        Detalle de Nota de Compra
    </h1>

    <!-- Información de la nota de compra -->
    <div class="mt-4">
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            ID: 
        </th></b>
            {{ $compras->id }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Proveedor: 
        </th></b>
            {{ $compras->proveedor->nombre }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Fecha: 
        </th></b>
            {{ $compras->created_at }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Monto Total: 
        </th></b>
            {{ $compras->monto_total }}
        </p>
    </div>

    <!-- Detalles de los productos comprados -->
    <div class="mt-8">
        <h2 class="text-lg font-bold mb-6 lg:text-center text-center">
            Productos Agregados
        </h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-300 bg-gray-100">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            Producto
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            Cantidad
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            Precio
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            Total
                        </th>
                        <!-- Si deseas agregar más columnas, aquí puedes hacerlo -->
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300">
                    @foreach ($detalles as $detalle)
                        <tr>
                            <td class="px-6 py-2 text-sm text-gray-900">
                                {{ $detalle->id }}
                            </td>
                            <td class="px-6 py-2 text-sm text-gray-900">
                                {{ $detalle->producto->nombre }}
                            </td>
                            <td class="px-6 py-2 text-sm">
                                {{ $detalle->cantidad }}
                            </td>
                            <td class="px-6 py-2 text-sm">
                                {{ $detalle->precio }}
                            </td>
                            <td class="px-6 py-2 text-sm">
                                {{ $detalle->cantidad * $detalle->precio }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-admin-layout>