@extends('layouts.appp')
@section('titulo', 'Graficas')
@section('contenido')
    <div class="container-fluid">
        <h1>Gráfico de ventas mensuales</h1>

        <!-- Contenedor para el gráfico -->
        <canvas id="ventasChart" width="500" height="200"></canvas>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('ventasChart').getContext('2d');
            
            // Datos pasados desde el controlador
            var ventasMensuales = @json($ventasMensuales);

            // Crear el gráfico
            var ventasChart = new Chart(ctx, {
                type: 'line', // Tipo de gráfico
                data: {
                    labels: [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre'
                    ], // Meses
                    datasets: [{
                        label: 'Ventas Mensuales',
                        data: ventasMensuales, // Datos de ventas mensuales
                        borderColor: 'rgb(75, 192, 192)', // Color de la línea
                        borderWidth: 4, // Grosor de la línea (ajustado a 4)
                        fill: false // No rellenar el área bajo la línea
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true // El eje Y comienza en 0
                        }
                    }
                }
            });
        });
    </script>
@endsection