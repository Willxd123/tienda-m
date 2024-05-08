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
    <form action="{{ route('admin.users.store') }}" method="POST" class="card-body">
        @csrf

        <div class="mb-4">

            <!-- NOMBRE -->
            <x-label for="name" class="block font-medium mb-2">
                Nombre
            </x-label>
            <x-input type="text" name="name" id="name" class="form-input w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200" 
                value="{{ old('name') }}" 
                required autofocus />

            <!-- CORREO ELECTRÓNICO -->
            <x-label for="email" class="block font-medium mt-4 mb-2">
                Correo Electrónico
            </x-label>
            <x-input type="email" name="email" id="email" class="form-input w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200" 
                value="{{ old('email') }}" 
                required />

            <!-- CONTRASEÑA -->
            <x-label for="password" class="block font-medium mt-4 mb-2">
                Contraseña
            </x-label>
            <x-input type="password" name="password" id="password" class="form-input w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200" required />
        
        </div>

        <div class="mb-4">
            {{-- Roles --}}
            <x-label for="roles" class="block font-medium mb-2">Roles:</x-label>
            <div class="space-y-2">
                @foreach ($roles as $role)
                    <div class="flex items-center">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="form-checkbox h-4 w-4 text-indigo-600">
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
