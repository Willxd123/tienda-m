<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Configuracion',
        'route' => route('admin.configuracions.index'),
    ],
    [
        'name' => 'Personalizacion',
    ],
]">
    <div class="card">
        <form action="{{ route('admin.configuracions.update', $configuracion) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-center w-full mb-2">
                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p id="file-name" class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                class="font-semibold">Click para
                                cargar imagen </span> o arrastre</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG o GIF (MAX. 1024x1024px)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" accept="image/*" name="logotipo"
                        onchange="updateFileName()" />
                </label>
            </div>
            <div class="card mb-2">
                <h3 class="mb-4 font-semibold text-center text-gray-900 dark:text-white">Seleccione un color</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach ($colors as $color)
                    <li class="rounded-lg bg-{{$color->color}} ">
                        <div class="flex items-center ps-3">
                            <input id="color_{{ $color->id }}"
                            type="radio"
                            name="colors[]"
                            value="{{ $color->id }}"
                            {{ in_array($color->id, $configuracion->colors->pluck('id')->toArray()) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="color_{{ $color->id }}"
                            class="py-3 ms-2 text-sm font-medium text-{{$color->color}} dark:text-gray-300">
                            {{ $color->color }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-end ">
                <x-button class="ml-2">
                    Actualizar
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
