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
        'name' => $producto->nombre,
    ],
]">

@livewire('admin.productos.producto-edit',['producto' => $producto])

</x-admin-layout>
