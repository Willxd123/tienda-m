<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Compra',
        'route' => route('admin.nota_compras.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

@livewire('admin.nota-compra.nota-compra-create')

</x-admin-layout>