<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Principal',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Rangos',
        'route' => route('admin.rangos.index'),
    ],
    [
        'name' => $rango->nivel,
    ],
]">

    <div class="card">
        <form action="{{ route('admin.rangos.update', $rango) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-4">
                <x-label class="mb-3">
                    Nivel
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nivel" name="nivel" value="{{ old('nivel', $rango->nivel) }}" />
            </div>

            <div class="mb-4">
                <x-label class="mb-3">
                    Descuento
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el descuento" name="descuento" value="{{ old('descuento', $rango->descuento) }}" />
            </div>

            <div class="mb-4">
                <x-label class="mb-3">
                    Compras Mínimas
                </x-label>
                <x-input class="w-full" placeholder="Ingrese las compras mínimas" name="compras_minimas" value="{{ old('compras_minimas', $rango->compras_minimas) }}" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="mr-4">
                    Actualizar
                </x-button>
                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>
            </div>

        </form>
    </div>

    <form id="delete-form" action="{{ route('admin.rangos.destroy', $rango) }}" method="POST" name="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "¿Seguro?",
                    text: "El cambio no se podrá revertir!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, elimínalo",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
