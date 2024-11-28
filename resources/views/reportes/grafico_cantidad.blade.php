<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Cantidad Vendida</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="text-align: center; width: 100%; height: 500px;">
        <canvas id="graficoCantidad"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('graficoCantidad').getContext('2d');
        new Chart(ctx, {
            type: '{{ $tipoGrafico }}',
            data: {
                labels: {!! json_encode(array_keys($cantidadPorMes)) !!},
                datasets: [{
                    label: 'Cantidad Vendida',
                    data: {!! json_encode(array_values($cantidadPorMes)) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
