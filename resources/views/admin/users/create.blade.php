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
        'name' => 'Nuevo Usuario',
    ],
]">

<div class="card">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf



        <div class="mb-4">

            <!-- NOMBRE -->
            <x-label for="name" class="block font-medium mb-2">
                Nombre
            </x-label>
            <x-input type="text" name="name" id="name" class="w-full"
                placeholder="ingrese el nombre del usuario"
                value="{{ old('name') }}"
                required autofocus />

            <!-- CORREO ELECTRÓNICO -->
            <x-label for="email" class="block font-medium mt-4 mb-2">
                Correo Electrónico
            </x-label>
            <x-input type="email" name="email" id="email" class="w-full"
                placeholder="ingrese el correo electronico"
                value="{{ old('email') }}"
                required />

            <!-- CONTRASEÑA -->
            <x-label for="password" class="block font-medium mt-4 mb-2">
                Contraseña
            </x-label>
            <x-input type="password" name="password" id="password" class="w-full" required
                placeholder="ingrese la contraseña"/>

        </div>
        <div class="mb-4">
            <!-- FOTO DE PERFIL -->
            <x-label for="profile_photo" class="block font-medium mb-2">
                Foto de Perfil
            </x-label>
            <x-input type="file" name="profile_photo_path" id="profile_photo_path" class="w-full" />
        </div>
        <div class="mb-4">
            {{-- Roles --}}
            <x-label for="roles" class="block font-medium mb-2">Roles:</x-label>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($roles as $role)
                    <div class="flex items-center">
                        <input type="radio" class="px-2 py-2 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-blue-200 focus:border-blue-600"
                            name="roles[]" value="{{ $role->name }}" >
                        <span class="ml-2">{{ $role->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end ">
            <x-button class="ml-2">
                Guardar
            </x-button>
        </div>

    </form>
</div>


</x-admin-layout>
