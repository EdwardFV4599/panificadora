<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Ventas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="text-align: center; width: 100%; height: 500px;">
        <canvas id="graficoVentas" style="width: 100%; height: 100%;"></canvas>
    </div>
    
    <div style="text-align: center; width: 100%; height: 500px;">
        <canvas id="graficoCantidad" style="width: 100%; height: 100%;"></canvas>
    </div>
    

    <script>
        const ctxVentas = document.getElementById('graficoVentas').getContext('2d');
        const ctxCantidad = document.getElementById('graficoCantidad').getContext('2d');

        const chartVentas = new Chart(ctxVentas, {
            type: '{{ $tipoGrafico }}',
            data: {
                labels: {!! json_encode(array_keys($ventasPorMes)) !!},
                datasets: [{
                    label: 'Total de Ventas (S/)',
                    data: {!! json_encode(array_values($ventasPorMes)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        const chartCantidad = new Chart(ctxCantidad, {
            type: 'bar',  // Cambiar a 'bar' o cualquier tipo si lo deseas
            data: {
                labels: {!! json_encode(array_keys($ventasPorMes)) !!},
                datasets: [{
                    label: 'Cantidad Vendida',
                    data: {!! json_encode(array_values($cantidadPorMes)) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
</body>
</html>
