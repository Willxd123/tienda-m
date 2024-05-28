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
        'name' => 'Nuevo',
    ],
]">
    <div class="card">
        <form action="{{ route('admin.promotors.store') }}" method="POST">
            @csrf

            <x-validation-errors class="mb-4" />

            <div class="mb-2">
                <x-label class="mb-2">Nombre</x-label>
                <x-input class="w-full mb-4" placeholder="Ingrese el nombre del promotor" name="name"
                    value="{{ old('name') }}" />

                <x-label class="mb-2">NIT</x-label>
                <x-input class="w-full mb-4" placeholder="Ingrese el nit" name="nit"
                    value="{{ old('nit') }}" />

                <x-label class="mb-2">Dirección</x-label>
                <x-input class="w-full mb-4" placeholder="Ingrese la dirección del promotor" name="direccion"
                    value="{{ old('direccion') }}" />

                <x-label class="mb-2">Teléfono</x-label>
                <x-input class="w-full mb-4" placeholder="Ingrese el teléfono del promotor" name="telefono"
                    value="{{ old('telefono') }}" />

                <x-label class="mb-2">Correo</x-label>
                <x-input class="w-full mb-4" placeholder="Ingrese el correo del promotor" name="email"
                    value="{{ old('email') }}" />

                <x-label for="password" class="mb-2">Contraseña</x-label>
                <x-input type="password" class="w-full mb-4" required placeholder="Ingrese la contraseña del promotor"
                    name="password" />

                <x-label for="password_confirmation" class="mb-2">Confirmar Contraseña</x-label>
                <x-input type="password" class="w-full mb-4" required placeholder="Confirme la contraseña del promotor"
                    name="password_confirmation" />
            </div>

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>
</x-admin-layout>
