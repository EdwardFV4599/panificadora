<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Ventas</h1>
    <p><strong>Producto:</strong> {{ $productoNombre }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Mes</th>
                <th>Cantidad</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ DateTime::createFromFormat('!m', $venta->mes)->format('F') }}</td>
                    <td>{{ $venta->total_cantidad }}</td>
                    <td>{{ number_format($venta->total_precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Resumen</h2>
    <table>
        <thead>
            <tr>
                <th>Mes</th>
                <th>Total Vendido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventasPorMes as $mes => $total)
                <tr>
                    <td>{{ DateTime::createFromFormat('!m', $mes)->format('F') }}</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total General</th>
                <th>{{ number_format($totalGeneral, 2) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
