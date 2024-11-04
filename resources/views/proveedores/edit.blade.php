@extends('layouts.appp')
@section('titulo', 'Proveedores')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Editar proveedor</strong></h3>
        <form action="{{ route('proveedores.update', $id) }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="id" id="id" value="{{$proveedor->id}}" required readonly>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{$proveedor->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="ruc">RUC</label>
                <input type="text" class="form-control" name="ruc" id="ruc" value="{{$proveedor->ruc}}" required maxlength="11">
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" name="correo" id="correo" value="{{$proveedor->correo}}" required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="{{$proveedor->telefono}}" required maxlength="9">
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" class="form-control" name="direccion" id="direccion" value="{{$proveedor->direccion}}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion">{{$proveedor->descripcion}}</textarea>
            </div>

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('proveedores.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection