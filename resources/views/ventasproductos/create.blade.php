@extends('layouts.appp')
@section('titulo', 'Compras de insumos')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Registrar compra de insumo</strong></h3>
        <form action="{{ route('comprasinsumos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="insumo" class="form-label">Insumo</label>
                <select class="form-control" name="insumo" id="insumo" required>
                    @foreach ($insumos as $item)
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
                <label for="stock_agregado">Stock agregado</label>
                <input type="number" class="form-control" name="stock_agregado" id="stock_agregado" step="0.1" min="0" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
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

            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('comprasinsumos.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection