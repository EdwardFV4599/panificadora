<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte táctico de ventas</title>
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
            margin-top: 20px; /* Reducir el espacio entre gráficos */
            margin-bottom: -120px; /* Eliminar espacio debajo de los gráficos */
        }
        .grafico img {
            width: 100%;
            max-width: 500px; /* Controlar el tamaño de la imagen */
            height: auto;  /* Mantener proporción */
            display: block;
            margin: 0 auto; /* Centrar la imagen */
        }
        .grafico h3 {
            margin-top: 20px; /* Eliminar margen superior en títulos */
            margin-bottom: 10px; /* Espacio pequeño debajo del título */
        }
    </style>
</head>
<body>
    <div class="titulo">
        <h2>Reporte táctico de ventas</h2>
        <h3>Producto: {{ $productoNombre }}</h3>
        <h4>Rango de fechas: 
            {{ $fechaInicio ? date('d/m/Y', strtotime($fechaInicio)) : 'Sin inicio definido' }} - 
            {{ $fechaFinal ? date('d/m/Y', strtotime($fechaFinal)) : 'Sin final definido' }}
        </h4>
    </div>

    <!-- Tabla de ventas por mes -->
    <table>
        <thead>
            <tr>
                <th>Mes</th>
                <th>Total ventas (S/.)</th>
                <th>Cantidad vendida</th>
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

    <!-- Mostrar el gráfico de ventas -->
    <div class="grafico">
        <h3>Gráfico de ventas (S/.)</h3>
        <img src="{{ $graficoVentasPath }}" alt="Gráfico de Ventas">
    </div>

    <!-- Mostrar el gráfico de cantidad vendida -->
    <div class="grafico">
        <h3>Gráfico de cantidad vendida</h3>
        <img src="{{ $graficoCantidadPath }}" alt="Gráfico de Cantidad Vendida">
    </div>
</body>
</html>
