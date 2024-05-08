<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Proveedor',
        'route' => route('admin.proveedors.index'),
    ],
    [
        'name' => $proveedor->nombre,
    ],
]">
    <div class="card">
        <form action="{{ route('admin.proveedors.update', $proveedor) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-4 "> <!-- Se utiliza grid para dividir en dos columnas -->
                <div>
                    <x-label class="mb-3">
                        Nombre
                    </x-label>
                    <x-input class="w-full" placeholder="Ingrese el nombre" name="nombre"
                        value="{{ old('nombre', $proveedor->nombre) }}" />
                </div>
            </div>
            <div>
                <x-label class="mb-3">
                    Direccion
                </x-label>
                <x-input class="w-full" placeholder="Ingrese la direccion" name="direccion"
                    value="{{ old('direccion', $proveedor->direccion) }}" />
            </div>
            <div>
                <x-label class="mb-3">
                    Correo
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el correo" name="correo"
                    value="{{ old('correo', $proveedor->correo) }}" />
            </div>
            <div>
                <x-label class="mb-3">
                    Encargado
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre del encargado" name="encargado"
                    value="{{ old('encargado', $proveedor->encargado) }}" />
            </div>
            <div class="flex justify-end ">

                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>


                <x-button class="ml-2">
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>
    <form action="{{ route('admin.proveedors.destroy', $proveedor) }}" method="POST" id="delete-from">
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
