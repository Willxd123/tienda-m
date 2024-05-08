<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categoria',
        'route' => route('admin.categorias.index'),
    ],
    [
        'name' => 'Agregar Imágenes',
    ],
]">
    {{-- <form action="{{ route('admin.imagenes.store') }}" method="POST"> --}}
        <form action="{{ route('admin.imagenes.store', ['id' => $producto->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="form-group my-4">
                    <label for="ruta1" class="mt-3 font-sans text-lg text-gray-800">Seleccionar Imágen 1</label>
                    <input type="file" name="ruta1" id="ruta1" class="form-control-file ml-3" accept="image/*">
                </div>
                <div class="form-group my-4">
                    <label for="ruta2" class="mt-3 font-sans text-lg text-gray-800">Seleccionar Imágen 2</label>
                    <input type="file" name="ruta2" id="ruta2" class="form-control-file ml-3" accept="image/*">
                </div>
                <div class="form-group my-4">
                    <label for="ruta3" class="mt-3 font-sans text-lg text-gray-800">Seleccionar Imágen 3</label>
                    <input type="file" name="ruta3" id="ruta3" class="form-control-file ml-3" accept="image/*">
                </div>
                <div class="form-group my-4">
                    <label for="ruta4" class="mt-3 font-sans text-lg text-gray-800">Seleccionar Imágen 4</label>
                    <input type="file" name="ruta4" id="ruta4" class="form-control-file ml-3" accept="image/*">
                </div>
                <button type="submit" class="mt-4 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Enviar</button>
            </div>
        </form>
        
</x-admin-layout>
