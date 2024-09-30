@extends('layouts.appp')
@section('titulo', 'Materias primas')
@section('contenido')
<div class="container">
    <h1>Crear materia prima</h1>
    <form action="{{ route('materia_primas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" step="1.00" min="1" required>
        </div>
        <div class="form-group">
            <label for="unidad">Unidad</label>
            <input type="text" class="form-control" name="unidad" id="unidad" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" step="1.00" min="1" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="eliminado" id="eliminado" value="0" required hidden>
        </div>

        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('materia_primas.index') }}'">Atrás</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        {{-- <input type="submit" class="btn btn-primary" value="Guardar"> --}}
    </form>
</div>
@endsection