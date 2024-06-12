<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'configuracions',
    ],
]">

    {{--     <x-slot name="action">
        <a class="btn btn-blue" href="{{ route('admin.configuracions.create') }}">
            Nuevo
        </a>

    </x-slot> --}}
    @foreach ($configuracions as $configuracion)
        <div class="mb-2 flex items-end justify-end -mt-14 lg:mb-5">
            <div>
                <a class="btn btn-greenblue" href="{{ route('admin.configuracions.edit', $configuracion) }}"> Logotipo y
                    Color </a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2 py-5">
            <div class="flex col-span-1">
                <img class="bg-gray-200 h-auto w-full max-w-full rounded-lg" src="{{ $configuracion->logotipo }}" alt="">
            </div>
            <div class="col-span-1">
                @foreach ($configuracion->colors as $color)
                    <div class="bg-{{ $color->color }} h-full max-w-full rounded-lg text-{{ $color->color }}">
                        {{ $color->color }}
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</x-admin-layout>
{{-- <div class="bg-green-950 text-green-950"></div> --}}
{{-- <div class="bg-green-800 text-green-800"></div> --}}
{{-- <div class="bg-green-600 text-green-600"></div> --}}
{{-- <div class="bg-green-400 text-green-400"></div> --}}
{{-- <div class="bg-yellow-900 text-yellow-900"></div> --}}
{{-- <div class="bg-yellow-700 text-yellow-700"></div> --}}
{{-- <div class="bg-yellow-600 text-yellow-600"></div> --}}
{{-- <div class="bg-yellow-400 text-yellow-400"></div> --}}
{{-- <div class="bg-gray-800 text-gray-800"></div> --}}
{{-- <div class="bg-gray-600 text-gray-600"></div> --}}
{{-- <div class="bg-gray-500 text-gray-500"></div> --}}
{{-- <div class="bg-gray-400 text-gray-400"></div> --}}
{{-- <div class="bg-red-950 text-red-950"></div> --}}
{{-- <div class="bg-red-800 text-red-800"></div> --}}
{{-- <div class="bg-red-600 text-red-600"></div> --}}
{{-- <div class="bg-red-500 text-red-500"></div> --}}
{{-- <div class="bg-blue-950 text-blue-950"></div> --}}
{{-- <div class="bg-blue-800 text-blue-800"></div> --}}
{{-- <div class="bg-blue-700 text-blue-700"></div> --}}
{{-- <div class="bg-blue-600 text-blue-600"></div> --}}
{{-- <div class="bg-blue-500 text-blue-500"></div> --}}
{{-- <div class="bg-blue-400 text-blue-400"></div> --}}
{{-- <div class="bg-purple-950 text-purple-950"></div> --}}
{{-- <div class="bg-purple-800 text-purple-800"></div> --}}
{{-- <div class="bg-purple-700 text-purple-700"></div> --}}
{{-- <div class="bg-purple-600 text-purple-600"></div> --}}
{{-- <div class="bg-purple-500 text-purple-500"></div> --}}
{{-- <div class="bg-purple-400 text-purple-400"></div> --}}
{{-- <div class="bg-orange-950 text-orange-950"></div> --}}
{{-- <div class="bg-orange-800 text-orange-800"></div> --}}
{{-- <div class="bg-orange-700 text-orange-700"></div> --}}
{{-- <div class="bg-orange-600 text-orange-600"></div> --}}
{{-- <div class="bg-orange-500 text-orange-500"></div> --}}
{{-- <div class="bg-orange-400 text-orange-400"></div> --}}
{{-- <div class="bg-pink-950 text-pink-950"></div> --}}
{{-- <div class="bg-pink-800 text-pink-800"></div> --}}
{{-- <div class="bg-pink-700 text-pink-700"></div> --}}
{{-- <div class="bg-pink-600 text-pink-600"></div> --}}
{{-- <div class="bg-pink-500 text-pink-500"></div> --}}
{{-- <div class="bg-pink-400 text-pink-400"></div> --}}
