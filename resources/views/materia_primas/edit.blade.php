@extends('layouts.appp')
@section('titulo', 'Materias primas')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Editar materia prima</strong></h3>
        <form action="{{ route('materia_primas.update', $id) }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="id" id="id" value="{{$materiaPrima->id}}" required readonly>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{$materiaPrima->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="existencia_actual">Existencia actual</label>
                <input type="number" class="form-control" name="existencia_actual" id="existencia_actual" value="{{$materiaPrima->existencia_actual}}" step="0.1" min="0" required readonly>
            </div>
            <div class="form-group">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" name="unidad" id="unidad" value="{{$materiaPrima->unidad}}" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" name="precio" id="precio" value="{{$materiaPrima->precio}}" step="0.1" min="0" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion">{{$materiaPrima->descripcion}}</textarea>
            </div>

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('materia_primas.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection