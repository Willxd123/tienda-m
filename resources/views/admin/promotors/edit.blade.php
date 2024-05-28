<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Promotor',
        'route' => route('admin.promotors.index'),
    ],
    [
        'name' => $promotor->user->name,
    ],
]">
    <div class="card">
        <form action="{{ route('admin.promotors.update', $promotor) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="mb-4">
                <x-label for="name" class="mb-3">Nombre</x-label>
                <x-input id="name" class="w-full" placeholder="Ingrese el nombre" name="name"
                    value="{{ old('name', $promotor->user->name) }}" />
            </div>

            <div class="mb-4">
                <x-label for="nit" class="mb-3">NIT</x-label>
                <x-input id="nit" class="w-full" placeholder="Ingrese el nit" name="nit"
                    value="{{ old('nit', $promotor->nit) }}" />
            </div>

            <div class="mb-4">
                <x-label for="telefono" class="mb-3">Teléfono</x-label>
                <x-input id="telefono" class="w-full" placeholder="Ingrese el teléfono" name="telefono"
                    value="{{ old('telefono', $promotor->telefono) }}" />
            </div>

            <div class="mb-4">
                <x-label for="direccion" class="mb-3">Dirección</x-label>
                <x-input id="direccion" class="w-full" placeholder="Ingrese la dirección" name="direccion"
                    value="{{ old('direccion', $promotor->direccion) }}" />
            </div>

            <div class="mb-4">
                <x-label for="email" class="mb-3">Correo</x-label>
                <x-input id="email" class="w-full" placeholder="Ingrese el correo" name="email"
                    value="{{ old('email', $promotor->user->email) }}" />
            </div>

            <div class="mb-4">
                <x-label for="password" class="mb-3">Contraseña</x-label>
                <x-input id="password" type="password" class="w-full"
                    placeholder="Ingrese la nueva contraseña" name="password" />
            </div>

            <div class="mb-4">
                <x-label for="password_confirmation" class="mb-3">Confirmar Contraseña</x-label>
                <x-input id="password_confirmation" type="password" class="w-full"
                    placeholder="Confirme la nueva contraseña" name="password_confirmation" />
            </div>

            <div class="flex justify-end">
                <x-danger-button type="button" onclick="confirmDelete()">Eliminar</x-danger-button>
                <x-button class="ml-2">Actualizar</x-button>
            </div>
        </form>
    </div>

    <form action="{{ route('admin.promotors.destroy', $promotor) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush
</x-admin-layout>
