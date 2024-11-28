@extends('layouts.appp')
@section('titulo', 'Graficas ventas')
@section('contenido')
    <div class="container-fluid">
        <h1>Gráficas de ventas por producto</h1>
        <div id="graficas" class="row">
            @foreach(range(1, 9) as $index)
                <div class="col-6" style="width: 600px; margin: 20px auto;">
                    <canvas id="grafica-producto-{{ $index }}"></canvas>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const response = await fetch('/graficas/ventas-mensuales');
            const data = await response.json();

            let index = 1;
            for (const producto in data) {
                const ctx = document.getElementById(`grafica-producto-${index}`).getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre'],
                        datasets: [{
                            label: producto,
                            data: Object.values(data[producto]),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: `Ventas Mensuales de ${producto}`
                            }
                        }
                    }
                });
                index++;
            }
        });
    </script>
@endsection