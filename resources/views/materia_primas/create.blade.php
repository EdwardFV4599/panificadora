@extends('layouts.appp')
@section('titulo', 'Materias primas')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Registrar materia prima</strong></h3>
        <form action="{{ route('materia_primas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" name="unidad" id="unidad" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
            </div>

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('materia_primas.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection