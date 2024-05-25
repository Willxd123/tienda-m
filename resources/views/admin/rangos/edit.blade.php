<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Principal',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Lista de Usuarios',
        'route' => route('admin.roles.index'),
    ],
    [
        'name' => $role->name,
    ],
]">

<div class="card">
    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-4">
            <x-label class="mb-3">
                Nombre
            </x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre" name="name" value="{{ old('name', $role->name) }}" />
        </div>

        <div class="mb-4">
                {{-- Permisos --}}
                <x-label for="permisos" class="block font-medium mb-2">Permisos</x-label>
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($permisos as $permiso)
                        <div class="flex items-center">
                            <input type="checkbox" class="px-2 py-2 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-blue-200 focus:border-blue-600" 
                                name="permisos[]" value="{{ $permiso->id }}" {{ $role->hasPermissionTo($permiso) ? 'checked' : '' }}>
                                <span class="ml-2">{{ $permiso->description }}</span>
                        </div>
                    @endforeach
                </div>
            </div>         

        <div class="flex justify-end mt-4">
            <x-button class="mr-4">
                Actualizar
            </x-button>
            <x-danger-button onclick="confirmDelete()">
                Eliminar
            </x-danger-button>
        </div>

    </form>
</div>

    <form id="delete-form" action="{{ route('admin.roles.destroy', $role) }}" method="POST" name="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "¿Seguro?",
                    text: "El cambio no se podrá revertir!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, elimínalo",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
