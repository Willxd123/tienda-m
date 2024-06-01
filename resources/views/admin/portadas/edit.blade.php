<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Principal',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Lista de Usuarios',
        'route' => route('admin.users.index'),
    ],
    [
        'name' => $user->name,
    ],
]">

<div class="card">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-4">
            <x-label class="mb-3">
                Nombre
            </x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre" name="name" value="{{ old('name', $user->name) }}" />
        </div>
        <div class="mb-4">
            <x-label class="mb-3">
                Correo
            </x-label>
            <x-input class="w-full" placeholder="Ingrese el Correo" name="email" value="{{ old('email', $user->email) }}" />
        </div>
        <div class="mb-4">
            <x-label class="mb-3">
                Contraseña
            </x-label>
            <x-input type="password" class="w-full" placeholder="Ingrese la nueva contraseña" name="password" />
        </div>

        {{-- Para tener checkboxes de roles --}}
        <div class="space-y-2">
            <label for="roles" class="block font-medium mb-2">
                Roles
            </label>
            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @foreach ($roles as $role)
                    <li class="border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center px-3 py-2">
                            <input name="roles[]" type="checkbox" value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'checked' : '' }} class="form-checkbox h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="role_{{ $role->name }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $role->name }}</label>
                        </div>
                    </li>
                @endforeach
            </ul>
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

    <form id="delete-form" action="{{ route('admin.users.destroy', $user) }}" method="POST" name="delete-form">
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
