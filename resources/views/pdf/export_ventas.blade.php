<table>
    <thead>
        @if ($promotores->isEmpty())
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
                <th>promotor</th>
            </tr>
        @endif

    </thead>
    <tbody>
        @if ($promotores->isEmpty())
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
                    <td>{{ $promotores[$key]->user->name }}</td>
                </tr>
            @endforeach
        @endif

    </tbody>
</table>
