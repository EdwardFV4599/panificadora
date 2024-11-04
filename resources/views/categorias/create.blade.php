@extends('layouts.appp')
@section('titulo', 'Categorias')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Registrar categoría</strong></h3>
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('categorias.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection