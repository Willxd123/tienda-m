<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Venta',
        'route' => route('admin.detalle_ventas.index'),
    ],
    [
        'name' => 'Detalle Nota de Venta',
    ],
]">

<div class="container mx-auto py-6">
    <h1 class="text-lg font-bold mb-6">
        Detalle de Nota de Venta
    </h1>

    <!-- Información de la nota de venta -->
    <div class="mt-4">
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            ID: 
        </th></b>
            {{ $ventas->id }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Promotor: 
        </th></b>
            {{ $ventas->promotor->user->name }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Cantidad: 
        </th></b>
            {{ $ventas->cantidad }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Fecha: 
        </th></b>
            {{ $ventas->fecha }}
        </p>
        <p><b><th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
            Monto Total: 
        </th></b>
            {{ $ventas->monto_total }}
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