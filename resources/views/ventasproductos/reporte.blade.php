<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ventas</title>
</head>
<body>
    <h1>Reporte de Ventas</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                @if($venta->detalles->isNotEmpty()) <!-- Verificar si hay detalles -->
                    @foreach($venta->detalles as $detalle)
                        <tr>
                            <td>{{ $venta->fecha }}</td>
                            <td>{{ $venta->cliente }}</td>
                            <td>{{ $venta->total }}</td>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->precio }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No hay detalles disponibles para esta venta.</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
