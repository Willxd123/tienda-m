<!-- php del sidebar, declaracion para botones-->
@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            //usuarios
            'name' => 'Usuario',
            'icon' => 'fa-solid fa-user',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
        ],
        [
            //familia de familias
            'name' => 'Familias',
            'icon' => 'fa-solid fa-box-open',
            'route' => route('admin.familias.index'),
            'active' => request()->routeIs('admin.familias.*'),
        ],
        [
            //familia de catergorias
            'name' => 'Categorias',
            'icon' => 'fa-solid fa-layer-group',
            'route' => route('admin.categorias.index'),
            'active' => request()->routeIs('admin.categorias.*'),
        ],
        [
            //familia de subcategoria
            'name' => 'Subategorias',
            'icon' => 'fa-solid fa-tags',
            'route' => route('admin.subcategorias.index'),
            'active' => request()->routeIs('admin.subcategorias.*'),
        ],
        [
            //familia de productos
            'name' => 'Productos',
            'icon' => 'fa-solid fa-gifts',
            'route' => route('admin.productos.index'),
            'active' => request()->routeIs('admin.productos.*'),
        ],
        [
            //proveedores
            'name' => 'Proveedor',
            'icon' => 'fa-solid fa-truck-field',
            'route' => route('admin.proveedors.index'),
            'active' => request()->routeIs('admin.proveedors.*'),
        ],
        [

            'name' => 'Bitacora',
            'icon' => 'fa-solid fa-book',
            'route' => route('admin.bitacora.index'),
            'active' => request()->routeIs('admin.bitacora.index'),
        ],
        [
            //compra
            'name' => 'Compra',
            'icon' => 'fa-solid fa-bag-shopping',
            'route' => route('admin.nota_compras.index'),
            'active' => request()->routeIs('admin.nota_compras.*'),

        ],
    ];
@endphp

<!--funcionalidad y estilo de sidebar -->
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100vh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <!-- declaracion de foreachs-->
            @foreach ($links as $link)
                <!-- gregar botones y estilos-->

                <!--boton inicio-->
                <li>
                    <a href="{{ $link['route'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100' : '' }}">

                        <!-- estilo de icono-->
                        <span class="inline-flex w-6 h6 justify-center items-center">
                            <i class="{{ $link['icon'] }} text-gray-500"></i>
                        </span>
                        <!-- nombre del boton-->
                        <span class="ms-2">
                            {{ $link['name'] }}
                        </span>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</aside>
