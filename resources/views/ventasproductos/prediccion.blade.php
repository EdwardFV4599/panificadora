@extends('layouts.appp')
@section('titulo', 'Predicción')
@section('contenido')
    <div class="container-fluid">
        <h2>Predicción de ventas para el próximo mes</h2>
        <p id="prediccion"></p>
    </div>
@endsection

@section('scripts')
    <script>
        fetch('/predecir-ventas')
            .then(response => response.json())
            .then(data => {
                document.getElementById('prediccion').innerText = 
                    `Cantidad prevista: ${data.predicted_sales}`;
            })
            .catch(error => console.error('Error:', error));
    </script>
@endsection