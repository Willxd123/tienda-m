<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        th, tr, td{
            padding-left: 4px; 
            padding-right: 4px; 
            margin-left: 4px;
            margin-right: 4px;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

    </style>
</head>
<body>
    
</body>
</html>
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
