<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
        'route' => route('admin.portadas.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.portadas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-validation-errors class="mb-4" />
            <div class="flex items-center justify-center w-full mb-2">
                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p id="file-name" class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para
                                cargar imagen </span> o arrastre</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG o GIF (MAX. 1024x1024px)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" accept="image/*" name="imagen" onchange="updateFileName()" />
                </label>
            </div>
            <div class="mb-4">
                <x-label class="mb-3">
                    Titulo
                </x-label>
                <x-input class="w-full" placeholder="ingrese el titulo de la portada" name="titulo"
                    value="{{ old('titulo') }}" />
            </div>
            <div class="mb-4">
                <x-label class="mb-3">
                    Fecha de Incio
                </x-label>
                <x-input type="date" class="w-full" name="inicio"
                    value="{{ old('inicio', now()->format('Y-m-d')) }}" />
            </div>
            <div class="mb-4">
                <x-label class="mb-3">
                    Fecha final de portada
                </x-label>
                <x-input type="date" class="w-full" name="fin"
                    value="{{ old('fin')}}" />
            </div>
            <div class="mb-4 flex space-x-2">
                <label for="">
                    <x-input type="radio" name="activo" value="1" checked/>
                    Activo
                </label>
                <label for="">
                    <x-input type="radio" name="activo" value="0" />
                    Inactivo
                </label>
            </div>
            <div class="flex justify-end ">
                <x-button class="ml-2">
                    Guardar
                </x-button>
            </div>
        </form>
    </div>
    <script>
        function updateFileName() {
            var input = document.getElementById('dropzone-file');
            var fileName = input.files[0] ? input.files[0].name : 'Click para cargar imagen o arrastre';
            document.getElementById('file-name').innerText = fileName;
        }
    </script>
</x-admin-layout>
