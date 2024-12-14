<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de ventas, inventarios y reportes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1, h4 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h3>Tiempos de registros de ventas, inventarios y reportes</h3>

    <!-- Datos de Ventas -->
    <h4>Datos de ventas</h4>
    <table>
        <thead>
            <tr>
                <th>Código venta</th>
                <th>Fecha</th>
                <th>Hora inicial</th>
                <th>Hora final</th>
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventastiempos as $item)
                <tr>
                    <td>{{ $item->codigo_venta }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->hora_inicial }}</td>
                    <td>{{ $item->hora_final }}</td>
                    <td>{{ $item->duracion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Datos de Inventarios -->
    <h4>Datos de inventarios</h4>
    <table>
        <thead>
            <tr>
                <th>Código compra</th>
                <th>Fecha</th>
                <th>Hora inicial</th>
                <th>Hora final</th>
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventariostiempos as $item)
                <tr>
                    <td>{{ $item->codigo_compra }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->hora_inicial }}</td>
                    <td>{{ $item->hora_final }}</td>
                    <td>{{ $item->duracion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Datos de Reportes -->
    <h4>Datos de reportes</h4>
    <table>
        <thead>
            <tr>
                <th>Código reporte</th>
                <th>Fecha</th>
                <th>Hora inicial</th>
                <th>Hora final</th>
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportestiempos as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->hora_inicial }}</td>
                    <td>{{ $item->hora_final }}</td>
                    <td>{{ $item->duracion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
