<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Ordenes',
        'route' => route('admin.ordens.index'),
    ],
    [
        'name' => 'Detalles de la orden',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.ordens.update', $venta->id) }}" method="POST" id="update-form">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-10">
                <!-- Información de la nota de venta -->
                <div class="col-span-1 mt-4">
                    <h1 class="text-lg font-bold mb-6 lg:text-center text-center">Información del promotor</h1>
                    <p><b>Promotor:</b> {{ $venta->promotor->user->name }}</p>
                    <p><b>Teléfono:</b> {{ $venta->promotor->telefono }}</p>
                    <p><b>Correo:</b> {{ $venta->promotor->user->email }}</p>
                    <p><b>NIT:</b> {{ $venta->promotor->nit }}</p>
                    <p><b>Dirección:</b> {{ $venta->promotor->direccion }}</p>
                    <hr class="my-6 border-spacing-2 border-gray-400 sm:mx-auto lg:my-8" />
                    <h1 class="text-lg font-bold mb-6 lg:text-center text-center">Detalle de venta</h1>
                    <p><b>ID:</b> {{ $venta->id }}</p>
                    <p><b>Fecha de compra:</b> {{ $venta->fecha }}</p>
                    <p><b>Cantidad de productos:</b> {{ $detalles->sum('cantidad') }}</p>
                    <p><b>Monto Total:</b> {{ $venta->monto_total }}</p>
                </div>
                <div class="col-span-1">
                    <div>
                        <img src="{{ $venta->promotor->user->profile_photo_path }}" alt="Foto de perfil"
                            class="size-full">
                    </div>
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

            <!-- Estado de la orden -->
            <div class="mt-8 flex justify-between space-x-3">
                <div class="w-1/2 flex justify-start">
                    @if ($bitacora)
                        <div class="bg-gray-200 p-4 rounded-lg">
                            <h2 class="text-lg font-bold mb-4">Detalles de Entrega</h2>
                            <p><b>Usuario:</b> {{ $bitacora->usuario }}</p>
                            <p><b>Fecha y Hora:</b> {{ $bitacora->fecha_hora }}</p>
                            <p><b>Navegador:</b> {{ $bitacora->navegador }}</p>
                            <p><b>Dirección IP:</b> {{ $bitacora->direccion_ip }}</p>
                        </div>
                    @else
                        <div class="bg-gray-200 p-4 rounded-lg">
                            <h2 class="text-lg font-bold mb-4">Detalles de Entrega</h2>
                            <p>Aún no se ha entregado el pedido.</p>
                        </div>
                    @endif
                </div>
                <div class="flex  justify-items-center  space-x-3">
                    <div>
                        <a class="btn btn-gray" href="{{ route('admin.ordens.index') }}"> Cancelar</a>
                        @if ($orden->estado == 0)
                            {{--    <input type="submit" name="estado" value="1"> --}}
                            <!-- Valor por defecto para confirmar el estado -->
                            <button type="button" onclick="confirmOrder()" class="btn btn-blue">
                                Confirmar Orden
                            </button>
                            <input type="hidden" name="estado" value="0">
                        @else
                            <button type="button"
                                class="bg-red-700 text-white font-bold py-2 px-4 rounded cursor-not-allowed" disabled>
                                Orden Recogida
                            </button>
                        @endif
                    </div>
                </div>


            </div>
        </form>
    </div>
    @push('js')
        <script>
            function confirmOrder() {
                Swal.fire({
                    title: '¿Estás seguro de la Informacion?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, confirmar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si se confirma, actualizar el estado y enviar el formulario
                        document.getElementById('update-form').elements['estado'].value = 1;
                        document.getElementById('update-form').submit();
                    }
                });
            }
        </script>
    @endpush
</x-admin-layout>
