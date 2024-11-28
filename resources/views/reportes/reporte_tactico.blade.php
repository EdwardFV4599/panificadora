<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Táctico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .titulo {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .grafico {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="titulo">
        <h1>Reporte Táctico de Ventas</h1>
        <h3>Producto: {{ $productoNombre }}</h3>
        <h4>Rango de Fechas: 
            {{ $fechaInicio ? date('d/m/Y', strtotime($fechaInicio)) : 'Sin inicio definido' }} -
            {{ $fechaFinal ? date('d/m/Y', strtotime($fechaFinal)) : 'Sin final definido' }}
        </h4>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mes</th>
                <th>Total Ventas (S/)</th>
                <th>Cantidad Vendida</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventasPorMes as $mes => $total)
                <tr>
                    <td>{{ \Carbon\Carbon::createFromFormat('m', $mes)->format('F') }}</td>
                    <td>S/ {{ number_format($total, 2) }}</td>
                    <td>{{ $cantidadPorMes[$mes] ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="grafico">
        <h3>Gráfico de Ventas</h3>
        <img src="{{ $graficoPath }}" alt="Gráfico de Ventas" style="width: 100%; max-width: 600px;">
    </div>
</body>
</html>
