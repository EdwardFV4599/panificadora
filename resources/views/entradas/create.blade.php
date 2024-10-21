@extends('layouts.appp')
@section('titulo', 'Materias primas')
@section('contenido')
<div class="container">
    <h3>Crear proveedor</h3>
    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="ruc">RUC</label>
            <input type="text" class="form-control" name="ruc" id="ruc" required maxlength="11">
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="text" class="form-control" name="correo" id="correo" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" required maxlength="9">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
        </div>
        {{-- Hidden --}}
        <div class="form-group">
            <input type="text" class="form-control" name="eliminado" id="eliminado" value="0" required hidden>
        </div>

        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('proveedores.index') }}'">Atrás</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        {{-- <input type="submit" class="btn btn-primary" value="Guardar"> --}}
    </form>
</div>
@endsection