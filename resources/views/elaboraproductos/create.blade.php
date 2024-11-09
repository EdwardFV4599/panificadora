@extends('layouts.appp')
@section('titulo', 'Entradas')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Registrar entrada de materia prima</strong></h3>
        <form action="{{ route('entradas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="materia_prima" class="form-label">Materia prima</label>
                <select class="form-control" name="materia_prima" id="materia_prima" required>
                    @foreach ($materiasPrimas as $item)
                    <option value="{{ $item->id}}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="proveedor" class="form-label">Proveedor</label>
                <select class="form-control" name="proveedor" id="proveedor" required>
                    @foreach ($proveedores as $item)
                    <option value="{{ $item->id}}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="existencia_agregada">Existencia agregada</label>
                <input type="number" class="form-control" name="existencia_agregada" id="existencia_agregada" step="0.1" min="0" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio por unidad</label>
                <input type="number" class="form-control" name="precio" id="precio" step="0.1" min="0" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" name="fecha" id="fecha" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
            </div>
            {{-- Hidden --}}
            <div class="form-group">
                <input type="text" class="form-control" name="encargado" id="encargado" value="{{ auth()->user()->name }}" required hidden>
            </div>

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('entradas.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection