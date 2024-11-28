<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Ventas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="text-align: center; width: 100%; height: 500px;">
        <canvas id="graficoVentas"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('graficoVentas').getContext('2d');
        new Chart(ctx, {
            type: '{{ $tipoGrafico }}',
            data: {
                labels: {!! json_encode(array_keys($ventasPorMes)) !!},
                datasets: [{
                    label: 'Total de Ventas (S/)',
                    data: {!! json_encode(array_values($ventasPorMes)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 35 // Aumenta el tamaño de las etiquetas del eje X
                            }
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 35 // Aumenta el tamaño de las etiquetas del eje Y
                            },
                            beginAtZero: true
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 35 // Aumenta el tamaño de la leyenda
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
