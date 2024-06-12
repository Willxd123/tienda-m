<table>
    <thead>
        @if ($proveedores->isEmpty())
            <tr>
                @foreach ($campos as $campo)
                    <th>{{ $campo }}</th>
                @endforeach
            </tr>
        @else
            <tr>
                @foreach ($campos as $campo)
                    <th>{{ $campo }}</th>
                @endforeach
                <th>proveedor</th>
            </tr>
        @endif

    </thead>
    <tbody>
        @if ($proveedores->isEmpty())
            @foreach ($nota_compras as $nota_compra)
                <tr>
                    @foreach ($campos as $campo)
                        <td>{{ $nota_compra->$campo }}</td>
                    @endforeach
                </tr>
            @endforeach
        @else
            @foreach ($nota_compras as $key => $nota_compra)
                <tr>
                    @foreach ($campos as $campo)
                        <td>{{ $nota_compra->$campo }}</td>
                    @endforeach
                    <td>{{ $proveedores[$key]->nombre }}</td>
                </tr>
            @endforeach
        @endif

    </tbody>
</table>
