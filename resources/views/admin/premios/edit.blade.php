<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Premios',
        'route' => route('admin.premios.index'),
    ],
    [
        'name' => $premio->producto->nombre,
    ],
]">

@livewire('admin.premio.premio-edit',['premio' => $premio])

</x-admin-layout>
