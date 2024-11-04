@extends('layouts.appp')
@section('titulo', 'Productos')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Registrar producto</strong></h3>
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    @foreach ($categorias as $item)
                    <option value="{{ $item->id}}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" name="precio" id="precio" step="0.1" min="0" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
            </div>

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('productos.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection