@extends('layouts.appp')
@section('titulo', 'Categorias')
@section('contenido')
<div class="container">
    <h3>Editar materia prima</h3>
    <form action="{{ route('categorias.update', $id) }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="id" id="id" value="{{$categoria->id}}" required hidden>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{$categoria->nombre}}" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="eliminado" id="eliminado" value="{{$categoria->eliminado}}" required hidden>
        </div>

        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('categorias.index') }}'">Atrás</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        {{-- <input type="submit" class="btn btn-primary" value="Guardar"> --}}
    </form>
</div>
@endsection