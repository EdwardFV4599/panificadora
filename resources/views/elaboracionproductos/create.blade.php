@extends('layouts.appp')
@section('titulo', 'Agregar elaboración')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Agregar elaboración para {{ $producto->nombre }}</strong></h3>
        <form action="{{ route('elaboracionproductos.store', $producto->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cantidad_elaborada">Cantidad elaborada:</label>
                <input type="number" name="cantidad_elaborada" class="form-control" required>
            </div>

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('elaboracionproductos.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection