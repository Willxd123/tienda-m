<div>
    <div class="px-6 py-4">
        <x-input type="text" wire:model.live="buscar" placeholder="Buscar órdenes por nombre de usuario..." class="w-full"/>
    </div>

    @if ($ordenes->count())
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Promotor</th>
                        <th scope="col" class="px-6 py-3">Fecha de Nota de Venta</th>
                        <th scope="col" class="px-6 py-3">Monto Total</th>
                        <th scope="col" class="px-6 py-3">Estado</th>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordenes as $orden)
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $orden->notaVenta->id }}</th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $orden->notaVenta->promotor->user->name }}</td>
                            <td class="px-6 py-4">{{ $orden->notaVenta->fecha }}</td>
                            <td class="px-6 py-4">{{ $orden->notaVenta->monto_total }}</td>
                            <td class="px-6 py-4">
                                @if ($orden->estado)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                        Entregado
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                        Pendiente
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.ordens.edit', ['orden' => $orden->notaVenta->id]) }}" class="btn btn-gray">
                                    Ver Orden
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                @if ($orden->notaVenta->factura == null)
                                    <span>Móvil</span>
                                @else
                                    <a href="{{ $orden->notaVenta->factura }}" target="_blank">Factura</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $ordenes->links() }}
        </div>
    @else
        <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Info alert!</span> Aún no se registró una orden.
            </div>
        </div>
    @endif
</div>
