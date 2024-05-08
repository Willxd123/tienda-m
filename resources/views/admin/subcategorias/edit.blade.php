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
        'name' => $subcategoria->nombre,
    ],
    
]">


@livewire('admin.subcategorias.subcategoria-edit',compact('subcategoria'))
</x-admin-layout>
