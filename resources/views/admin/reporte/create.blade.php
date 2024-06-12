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
            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Reportes de Compras</h3>
            <ul
                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="laravel-checkbox-list" type="checkbox" name="campos[]" value="id"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="laravel-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Numero</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="vue-checkbox-list" type="checkbox" name="campos[]" value="monto_total"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="vue-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Montos</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="react-checkbox-list" type="checkbox" name="campos[]" value="proveedor_id"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="react-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Proveedor</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="angular-checkbox-list" type="checkbox" name="campos[]" value="fecha"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="angular-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fecha y Hora</label>
                    </div>
                </li>
            </ul>
            <ul
                class="mt-3 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de descarga</label>
                    <select id="countries" name="formato"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Selecciona un formato</option>
                        <option value="pdf">PDF</option>
                        <option value="excel">EXCEL</option>
                        <option value="html">HTML</option>
                    </select>
                </li>
            </ul>

            <div class="flex justify-end mt-2">
                <x-button>
                    Descargar
                </x-button>
            </div>

        </form>

    </div>
    <div class="card">
        <form action="{{ route('admin.reporte.store2') }}" method="POST">
            @csrf
            <x-validation-errors class="mb-4" />
            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Reportes de Ventas</h3>
            <ul
                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="laravel-checkbox-list" type="checkbox" name="campos[]" value="id"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="laravel-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Numero</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="vue-checkbox-list" type="checkbox" name="campos[]" value="monto_total"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="vue-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Monto</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="react-checkbox-list" type="checkbox" name="campos[]" value="promotor_id"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="react-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Promotor</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="angular-checkbox-list" type="checkbox" name="campos[]" value="fecha"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="angular-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fecha y Hora</label>
                    </div>
                </li>
            </ul>
            <ul
                class="mt-3 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de descarga</label>
                    <select id="countries" name="formato"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Selecciona un formato</option>
                        <option value="pdf">PDF</option>
                        <option value="excel">EXCEL</option>
                        <option value="html">HTML</option>
                    </select>
                </li>
            </ul>

            <div class="flex justify-end mt-2">
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
