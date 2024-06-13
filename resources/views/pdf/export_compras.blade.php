<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        th, tr{
            padding-left: 4px; 
            padding-right: 4px; 
        }

    </style>
</head>

<body>
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
</body>

</html>
