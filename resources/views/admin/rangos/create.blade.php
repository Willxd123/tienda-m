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
        'name' => 'Nuevo Rol',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.roles.store') }}" method="POST" class="card-body">
            @csrf

            <div class="mb-4">

                <!-- NOMBRE -->
                <x-label for="name" class="block font-medium mb-2">
                    Nombre
                </x-label>
                <x-input type="text" name="name" id="name" class="w-full"
                    placeholder="ingrese el nombre del rol" value="{{ old('name') }}" required autofocus />
            </div>

            
            <div class="mb-4">
                {{-- Permisos --}}
                <x-label for="permisos" class="block font-medium mb-2">Permisos</x-label>
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($permisos as $permiso)
                        <div class="flex items-center">
                            <input type="checkbox" class="px-2 py-2 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-blue-200 focus:border-blue-600" 
                                name="permisos[]" value="{{ $permiso->id }}">
                                <span class="ml-2">{{ $permiso->description }}</span>
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
