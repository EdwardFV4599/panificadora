@extends('layouts.appp')
@section('titulo', 'Materias primas')
@section('contenido')
<div class="container">
    <h1>Editar materia prima</h1>
    <form action="{{ route('materia_primas.update', $id) }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="id" id="id" value="{{$materiaPrima->id}}" required hidden>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{$materiaPrima->nombre}}" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" value="{{$materiaPrima->cantidad}}" step="1.00" min="1" required>
        </div>
        <div class="form-group">
            <label for="unidad">Unidad</label>
            <input type="text" class="form-control" name="unidad" id="unidad" value="{{$materiaPrima->unidad}}" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" value="{{$materiaPrima->precio}}" step="1.00" min="1" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion">{{$materiaPrima->descripcion}}</textarea>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="eliminado" id="eliminado" value="{{$materiaPrima->eliminado}}" required hidden>
        </div>

        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('materia_primas.index') }}'">Atrás</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        {{-- <input type="submit" class="btn btn-primary" value="Guardar"> --}}
    </form>
</div>
@endsection