@extends('layouts.appp')
@section('titulo', 'Entradas')
@section('contenido')
<div class="container">
    <h3>Editar entrada</h3>
    <form action="{{ route('entradas.update', $id) }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="id" id="id" value="{{$entrada->id}}" required readonly>
        </div>
        <div class="form-group">
            <label for="materia_prima" class="form-label">Materia prima</label>
            <select class="form-control" name="materia_prima" id="materia_prima" required>
                @foreach ($materiasPrimas as $materiaPrima)
                    <option value="{{ $materiaPrima->id }}" {{ $entrada->materia_prima == $materiaPrima->id ? 'selected' : '' }}>
                        {{ $materiaPrima->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="proveedor" class="form-label">Proveedor</label>
            <select class="form-control" name="proveedor" id="proveedor" required>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ $entrada->proveedor == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="existencia_agregada">Existencia agregada</label>
            <input type="number" class="form-control" name="existencia_agregada" id="existencia_agregada" value="{{$entrada->existencia_agregada}}" step="0.1" min="0" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio por unidad</label>
            <input type="number" class="form-control" name="precio" id="precio" value="{{$entrada->precio}}" step="0.1" min="0" required>
        </div>
        <div class="form-group">
            <label for="precio">Encargado</label>
            <input type="text" class="form-control" name="encargado" id="encargado" value="{{$entrada->encargado}}" required readonly>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" name="fecha" id="fecha" value="{{$entrada->fecha}}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion">{{$entrada->descripcion}}</textarea>
        </div>

        {{-- Hidden --}}
        <div class="form-group">
            <input type="text" class="form-control" name="eliminado" id="eliminado" value="{{$entrada->eliminado}}" required hidden>
        </div>

        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('entradas.index') }}'">Atrás</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        {{-- <input type="submit" class="btn btn-primary" value="Guardar"> --}}
    </form>
</div>
@endsection