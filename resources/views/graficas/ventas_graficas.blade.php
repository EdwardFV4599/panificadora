@extends('layouts.appp')
@section('titulo', 'Gráficos de ventas')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Gráficos de ventas</strong></h3>
        
        <!-- Formulario de selección de fechas y periodo -->
        <form id="filtros-form" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="fecha_inicio">Fecha inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="fecha_final">Fecha final:</label>
                    <input type="date" id="fecha_final" name="fecha_final" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="periodo">Periodo:</label>
                    <select id="periodo" name="periodo" class="form-control">
                        <option value="dia">Día</option>
                        <option value="semana">Semana</option>
                        <option value="mes" selected>Mes</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar gráficos</button>
        </form>

        <!-- Contenedor de gráficos -->
        <div class="row" id="graficas">
            <!-- Los gráficos se llenarán dinámicamente -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById('filtros-form');
            const graficasContainer = document.getElementById('graficas');

            // Nueva paleta de 9 colores distintos, sin tonos rosados
            const colorPalette = [
                'rgba(54, 162, 235, 1)', // Azul
                'rgba(75, 192, 192, 1)', // Verde Aqua
                'rgba(153, 102, 255, 1)', // Púrpura
                'rgba(255, 159, 64, 1)', // Naranja
                'rgba(255, 99, 132, 1)', // Rojo
                'rgba(255, 205, 86, 1)', // Amarillo
                'rgba(201, 203, 207, 1)', // Gris
                'rgba(255, 99, 71, 1)', // Tomate
                'rgba(0, 123, 255, 1)'  // Azul Oscuro
            ];

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                // Obtener valores del formulario
                const fechaInicio = document.getElementById('fecha_inicio').value;
                const fechaFinal = document.getElementById('fecha_final').value;
                const periodo = document.getElementById('periodo').value;

                // Validar que las fechas no estén vacías
                if (!fechaInicio || !fechaFinal) {
                    alert('Por favor selecciona las fechas de inicio y fin.');
                    return;
                }

                // Construir la URL con parámetros
                const url = `/graficas/ventas?fecha_inicio=${fechaInicio}&fecha_final=${fechaFinal}&periodo=${periodo}`;

                try {
                    // Hacer la petición al servidor
                    const response = await fetch(url);

                    if (!response.ok) {
                        throw new Error(`Error HTTP: ${response.status}`);
                    }

                    const data = await response.json();
                    if (data.error) {
                        throw new Error(data.error);
                    }

                    // Limpiar gráficos previos
                    graficasContainer.innerHTML = '';

                    // Variables para el gráfico de pastel
                    const pieData = [];
                    const pieLabels = [];
                    let totalVentas = 0;

                    // Crear gráfico de pastel
                    const pieDiv = document.createElement('div');
                    pieDiv.style.width = '400px'; // Establecer un tamaño fijo
                    pieDiv.style.margin = '0 auto'; // Centrar el gráfico
                    graficasContainer.appendChild(pieDiv);

                    const pieCanvas = document.createElement('canvas');
                    pieCanvas.id = 'grafica-pie';
                    pieDiv.appendChild(pieCanvas);

                    // Verificar si hay datos para el gráfico de pastel
                    Object.keys(data).forEach((productoId, index) => {
                        const productoNombre = data[productoId].nombre;  // Obtener el nombre del producto
                        const ventas = Object.values(data[productoId].ventas);
                        const sumaVentas = ventas.reduce((sum, valor) => sum + parseFloat(valor), 0);

                        // Agregar datos para el gráfico de pastel
                        pieData.push(sumaVentas);
                        pieLabels.push(productoNombre);
                        totalVentas += sumaVentas;

                        // Depuración: Mostrar la suma de ventas y los datos
                        console.log(`Producto: ${productoNombre}, Ventas: ${ventas}, Suma Ventas: ${sumaVentas}`);
                    });

                    // Solo crear el gráfico de pastel si hay datos
                    if (pieData.length > 0) {
                        const pieCtx = pieCanvas.getContext('2d');

                        new Chart(pieCtx, {
                            type: 'pie',
                            data: {
                                labels: pieLabels,
                                datasets: [{
                                    data: pieData,
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 0.7)',
                                        'rgba(54, 162, 235, 0.7)',
                                        'rgba(255, 159, 64, 0.7)',
                                        'rgba(153, 102, 255, 0.7)',
                                        'rgba(255, 99, 132, 0.7)',
                                        'rgba(255, 205, 86, 0.7)',
                                        'rgba(201, 203, 207, 0.7)',
                                        'rgba(163, 51, 136, 0.7)',
                                        'rgba(98, 182, 226, 0.7)'
                                    ],
                                    borderColor: [
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(255, 205, 86, 1)',
                                        'rgba(201, 203, 207, 1)',
                                        'rgba(163, 51, 136, 1)',
                                        'rgba(98, 182, 226, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'left', // Cambiar la posición de la leyenda
                                        labels: {
                                            boxWidth: 20, // Ajustar el tamaño de los cuadros
                                            padding: 10  // Ajustar el espaciado entre los elementos
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                const percentage = tooltipItem.raw / totalVentas * 100;
                                                return `${tooltipItem.label}: ${tooltipItem.raw} (${percentage.toFixed(2)}%)`;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    } else {
                        alert('No hay datos disponibles para el gráfico de pastel.');
                    }

                    // Crear gráficos para cada producto
                    Object.keys(data).forEach((productoId, index) => {
                        const productoNombre = data[productoId].nombre;  // Obtener el nombre del producto
                        const canvas = document.createElement('canvas');
                        canvas.id = `grafica-producto-${index}`;
                        
                        // Crear una columna para cada gráfico (2 gráficos por fila)
                        const colDiv = document.createElement('div');
                        colDiv.classList.add('col-md-6');  // 6 columnas por gráfico, creando 2 por fila
                        colDiv.appendChild(canvas);
                        graficasContainer.appendChild(colDiv);

                        const ctx = canvas.getContext('2d');
                        const color = colorPalette[index % colorPalette.length]; // Asigna color de la paleta

                        // Obtener las ventas para el gráfico de línea
                        const ventas = Object.values(data[productoId].ventas);
                        const sumaVentas = ventas.reduce((sum, valor) => sum + parseFloat(valor), 0);

                        // Crear el gráfico de línea con sombreado
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: Object.keys(data[productoId].ventas),
                                datasets: [{
                                    label: productoNombre,  // Mostrar el nombre del producto
                                    data: ventas,
                                    fill: true,  // Habilitar el sombreado
                                    backgroundColor: color.replace('1)', '0.2)'),  // Sombreado con el mismo color
                                    borderColor: color,  // Color de la línea
                                    borderWidth: 2,
                                    tension: 0.1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    }
                                }
                            }
                        });
                    });
                } catch (error) {
                    console.error('Error al cargar los datos:', error);
                    alert('Error al cargar los datos.');
                }
            });
        });
    </script>
@endsection
