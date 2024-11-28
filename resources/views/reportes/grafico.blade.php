<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Ventas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="text-align: center;">
        <canvas id="graficoVentas" style="width: 100%; max-width: 600px;"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('graficoVentas').getContext('2d');
        const chart = new Chart(ctx, {
            type: '{{ $tipoGrafico }}',
            data: {
                labels: {!! json_encode(array_keys($ventasPorMes)) !!},
                datasets: [
                    {
                        label: 'Total de Ventas (S/)',
                        data: {!! json_encode(array_values($ventasPorMes)) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Cantidad Vendida',
                        data: {!! json_encode(array_values($cantidadPorMes)) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
</body>
</html>
