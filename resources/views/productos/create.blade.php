@extends('layouts.appp')

@section('contenido')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" required>
        </div>
        <button type="submit" class="btn btn-success">Crear Producto</button>
    </form>
</div>
@endsection
