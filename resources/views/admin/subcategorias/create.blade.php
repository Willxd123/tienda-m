<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategoria',
        'route' => route('admin.subcategorias.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">


@livewire('admin.subcategorias.subcategoria-create')
</x-admin-layout>
