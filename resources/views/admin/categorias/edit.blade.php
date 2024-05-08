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
        'name' => $categoria->nombre,
    ],
]">
    <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card">
            <x-validation-errors class="mb-4" />
            
            <div class="mb-4 ">
                <!-- select categoria -->
                <div class="mb-4">
                    <x-label for="familia_id" class="mb-2">familia</x-label>

                    <x-select name="familia_id" class="w-full">
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}"
                                @selected(old('familia_id',$categoria->familia_id)== $familia->id)>
                                {{$familia->nombre}}
                            </option>
                        @endforeach
                    </x-select>
                </div>


                <div>
                    <x-label for="nombre" class="mb-3">Nombre</x-label>
                    <x-input class="w-full" id="nombre" placeholder="Ingrese el nombre" name="nombre"
                        value="{{ old('nombre', $categoria->nombre) }}" />
                </div>
            </div>
            <div class="flex justify-end">

                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>


                <x-button>actualizar</x-button>
            </div>
        </div>
    </form>
    <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" id="delete-from">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
     
                        document.getElementById('delete-from').submit();
                    }
                });
            }
        </script>
    @endpush
</x-admin-layout>
