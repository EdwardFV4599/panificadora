@extends('layouts.appp')
@section('titulo', 'Insumo9s')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Editar insumo</strong></h3>
        <form action="{{ route('insumos.update', $id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{$insumo->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" name="unidad" id="unidad" value="{{$insumo->unidad}}" required>
            </div>
            <div class="form-group">
                <label for="stock_actual">Stock actual</label>
                <input type="number" class="form-control" name="stock_actual" id="stock_actual" value="{{$insumo->stock_actual}}" step="0.1" min="0" required readonly>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion">{{$insumo->descripcion}}</textarea>
            </div>

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('insumos.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection