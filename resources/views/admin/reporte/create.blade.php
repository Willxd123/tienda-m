<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Reportes',
        'route' => route('admin.reporte.create'),
    ],
    [
        'name' => 'Generar un nuevo reporte',
    ],
]">
    <div class="card">
        <form action="{{ route('admin.reporte.store') }}" method="POST">
            @csrf

            <x-validation-errors class="mb-4" />
            {{--  --}}
            <div class="mb-4">
                <label class="">Número de venta: </label>
                <input type="checkbox" id="venta" name="venta" class="mr-2">
            </div>

            <div class="mb-4">
                <label class="">Proveedor: </label>
                <input type="checkbox" id="proveedor" name="proveedor" class="mr-2">
            </div>

            <div class="mb-4">
                <label class="">Fecha: </label>
                <input type="checkbox" id="fecha" name="fecha" class="mr-2">
            </div>

            <div class="mb-4">
                <label class="">Monto Total: </label>
                <input type="checkbox" id="monto" name="monto" class="mr-2">
            </div>

            <div class="mb-4">
                <label for="Inicio" class="block text-sm font-medium text-gray-700">Inicio:</label>
                <input type="date" id="fecha_ini" name="fecha"
                    class="mt-1 mb-5 block w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                <label for="Fin" class="text-sm font-medium text-gray-700, mt-6">Fin:</label>
                <input type="date" id="fecha_fin" name="fecha"
                    class="mt-1 block w-auto py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

            </div>
            <div class="mb-4">
                Formato de descarga:
            </div>
            <div class="mb-4">
                <label>Excel</label>
                <i class="fa-solid fa-file-csv"></i>
                <input type="checkbox" id="monto" name="monto" class="mr-2">
            </div>

            {{--  --}}
            <div class="flex justify-end">
                <x-button>
                    Descargar
                </x-button>
            </div>

        </form>

    </div>
    <script>
        var fechaActual = new Date().toISOString().slice(0, 10);
        document.getElementById("fecha_ini").value = fechaActual;
        document.getElementById("fecha_fin").value = fechaActual;
    </script>
</x-admin-layout>
