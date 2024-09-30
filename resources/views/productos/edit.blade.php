@extends('layouts.appp')

@section('contenido')
<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $producto->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" value="{{ $producto->precio }}" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion">{{ $producto->descripcion }}</textarea>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" value="{{ $producto->stock }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar Producto</button>
    </form>
</div>
@endsection
