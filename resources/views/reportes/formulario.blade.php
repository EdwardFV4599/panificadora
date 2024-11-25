@extends('layouts.appp')
@section('titulo', 'Reportes')
@section('contenido')
    <div class="container-fluid">
        <h1>Generar reporte de ventas</h1>

        <form action="/reportes/generar" method="POST">
            @csrf
            <label for="producto_id">Seleccionar Producto:</label>
            <select name="producto_id" id="producto_id">
                <option value="">Todos los Productos</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
    
            <button type="submit">Generar Reporte</button>
        </form>
    </div>
@endsection

@section('scripts')

@endsection