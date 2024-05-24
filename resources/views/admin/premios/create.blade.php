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
        'name' => 'Nuevo',
    ],
]">


@livewire('admin.premio.premio-create')
</x-admin-layout>
