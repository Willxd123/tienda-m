<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Producto',
        'route' => route('admin.productos.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">


@livewire('admin.productos.producto-create')
</x-admin-layout>
