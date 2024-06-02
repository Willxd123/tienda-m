<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Principal',
        'route' => route('admin.dashboard'),
    ],

    [
        'name' => 'Portadas',
    ],
]">

    <x-slot name="action">
        <a class= "btn btn-blue" href="{{ route('admin.portadas.create') }}">
            Nuevo
        </a>
    </x-slot>

    <ul class="space-y-4">
        @foreach ($portadas as $portada)
            <li class="bg-white rounded-lg shadow-lg overflow-hidden flex ">
                <img src="{{ $portada->imagen }}"
                    class="w-64 aspect-[3/1] object-cover object-center">
                <div class="p-4 flex-1 flex justify-between items-center">
                    <div>
                        <h1 class="font-semibold">
                            {{ $portada->titulo }}
                        </h1>
                        <p>
                            @if ($portada->activo)
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                Activo</span>
                            @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                Inactivo</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-bold">
                            Fecha de inicio
                        </p>
                        <p>
                            {{ $portada->inicio->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-bold">
                            Fecha de finalizacion
                        </p>
                        <p>
                            {{ $portada->fin ? $portada->fin->format('d/m/Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <a class="btn btn-blue" href="{{ route('admin.portadas.edit', $portada) }}"> Editar </a>
                    </div>
                    {{--                 <h2 class="text-xl font-bold">{{ $portada->titulo }}</h2>
                <p>Fecha de Inicio: {{ $portada->inicio }}</p>
                <p>Fecha de Fin: {{ $portada->fin }}</p>
                <p>Estado: {{ $portada->activo ? 'Activo' : 'Inactivo' }}</p> --}}
                </div>
            </li>
        @endforeach
    </ul>
</x-admin-layout>
