@extends('layouts.appp')
@section('titulo', 'Reportes')
@section('contenido')
<div class="container-fluid mt-4">
    <h1 class="mb-4">Generar reporte de ventas</h1>

    <form action="/reportes/generar" method="POST" class="form-inline">
        @csrf
        <div class="form-group mr-3">
            <label for="producto_id" class="mr-2">Seleccionar Producto:</label>
            <select name="producto_id" id="producto_id" class="form-control">
                <option value="">Todos los Productos</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mr-3">
            <label for="fecha_inicio" class="mr-2">Fecha Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
        </div>

        <div class="form-group mr-3">
            <label for="fecha_final" class="mr-2">Fecha Final:</label>
            <input type="date" name="fecha_final" id="fecha_final" class="form-control">
        </div>

        <div class="form-group mr-3">
            <label for="tipo_grafico" class="mr-2">Tipo de Gráfico:</label>
            <select name="tipo_grafico" id="tipo_grafico" class="form-control">
                <option value="bar">Barra</option>
                <option value="line">Línea</option>
                <option value="pie">Pastel</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
</div>
@endsection
