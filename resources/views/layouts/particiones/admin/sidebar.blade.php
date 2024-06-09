<!-- php del sidebar, declaracion para botones-->
@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
            //'can' => 'admin.dashboard',
        ],
        [
            //usuarios
            'name' => 'Usuario',
            'icon' => 'fa-solid fa-user',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
            //'can' => 'admin.users.index',
        ],
        [
            //Promotor
            'name' => 'Promotor',
            'icon' => 'fa-solid fa-users',
            'route' => route('admin.promotors.index'),
            'active' => request()->routeIs('admin.promotors.*'),
            //'can' => 'admin.promotors.index',
        ],
        [
            //roles
            'name' => 'Rol',
            'icon' => 'fa-solid fa-address-book',
            'route' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*'),
            //'can' => 'admin.roles.index',
        ],
        [
            //rango
            'name' => 'Rango',
            'icon' => 'fa-solid fa-list-ol',
            'route' => route('admin.rangos.index'),
            'active' => request()->routeIs('admin.rangos.*'),
            //'can' => 'admin.rangos.index',
        ],
        [
            //familia de familias
            'name' => 'Familias',
            'icon' => 'fa-solid fa-box-open',
            'route' => route('admin.familias.index'),
            'active' => request()->routeIs('admin.familias.*'),
            //'can' => 'admin.familias.index',
        ],
        [
            //familia de catergorias
            'name' => 'Categorias',
            'icon' => 'fa-solid fa-layer-group',
            'route' => route('admin.categorias.index'),
            'active' => request()->routeIs('admin.categorias.*'),
            //'can' => 'admin.categorias.index',
        ],
        [
            //familia de subcategoria
            'name' => 'Subategorias',
            'icon' => 'fa-solid fa-tags',
            'route' => route('admin.subcategorias.index'),
            'active' => request()->routeIs('admin.subcategorias.*'),
            //'can' => 'admin.subcategorias.index',
        ],
        [
            //familia de productos
            'name' => 'Productos',
            'icon' => 'fa-solid fa-gifts',
            'route' => route('admin.productos.index'),
            'active' => request()->routeIs('admin.productos.*'),
            //'can' => 'admin.productos.index',
        ],
        [
            //premios
            'name' => 'Premios',
            'icon' => 'fa-solid fa-award',
            'route' => route('admin.premios.index'),
            'active' => request()->routeIs('admin.premios.*'),
            //'can' => 'admin.premios.index',
        ],
        [
            //premio del promotor detalle
            'name' => 'Mis premios',
            'icon' => 'fa-solid fa-gift',
            'route' => route('admin.premios_promotors.index'),
            'active' => request()->routeIs('admin.premios_promotors.*'),
        ],
        [
            //proveedores
            'name' => 'Proveedor',
            'icon' => 'fa-solid fa-truck-field',
            'route' => route('admin.proveedors.index'),
            'active' => request()->routeIs('admin.proveedors.*'),
            //'can' => 'admin.proveedors.index',
        ],
        [
            //compra
            'name' => 'Compra',
            'icon' => 'fa-solid fa-bag-shopping',
            'route' => route('admin.nota_compras.index'),
            'active' => request()->routeIs('admin.nota_compras.*'),
            //'can' => 'admin.nota_compras.index',
        ],
        [
            'name' => 'Reportes',
            'icon' => 'fa-solid fa-file-invoice',
            'route' => route('admin.reporte.create'),
            'active' => request()->routeIs('admin.reporte.create'),
            //'can' => 'admin.reporte.index',
        ],
        [
            'name' => 'Bitacora',
            'icon' => 'fa-solid fa-book',
            'route' => route('admin.bitacora.index'),
            'active' => request()->routeIs('admin.bitacora.index'),
            //'can' => 'admin.bitacora.index',
        ],
        //portadas
        [
            'name' => 'Portada',
            'icon' => 'fa-solid fa-panorama',
            'route' => route('admin.portadas.index'),
            'active' => request()->routeIs('admin.portadas.*'),
            //'can' => 'admin.bitacora.index',
        ],
        //configuracion
        [
            'name' => 'Configuracion',
            'icon' => 'fa-solid fa-gears',
            'route' => route('admin.configuracions.index'),
            'active' => request()->routeIs('admin.configuracions.*'),
            //'can' => 'admin.bitacora.index',
        ],
        //Catalogo
        [
            'name' => 'Catalogo',
            'icon' => 'fa-solid fa-book-open',
            'route' => route('admin.catalogos.index'),
            'active' => request()->routeIs('admin.catalogos.*'),
            //'can' => 'admin.bitacora.index',
        ],
    ];
@endphp

{{-- <ul>
    @foreach ($links as $link)
        @can($link['can'])
            <li class="{{ $link['active'] ? 'active' : '' }}">
                <a href="{{ $link['route'] }}">
                    <i class="{{ $link['icon'] }}"></i> {{ $link['name'] }}
                </a>
            </li>
        @endcan
    @endforeach
</ul> --}}

<!-- Funcionalidad y estilo del sidebar -->
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100vh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                {{-- @can($link['can']) --}}
                <li class="{{ $link['active'] ? 'bg-gray-400 rounded-lg' : '' }}">
                    <a href="{{ $link['route'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                            <i class="{{ $link['icon'] }} text-gray-500"></i>
                        </span>
                        <span class="ms-2">{{ $link['name'] }}</span>
                    </a>
                </li>
                {{-- @endcan --}}
            @endforeach
        </ul>
    </div>
</aside>
