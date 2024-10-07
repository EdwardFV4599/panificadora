@extends('layouts.appp')
@section('titulo', 'Productos')
@section('contenido')
<div class="container">
    <h3>Editar producto</h3>
    <form action="{{ route('productos.update', $id) }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="id" id="id" value="{{$producto->id}}" required hidden>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{$producto->nombre}}" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" value="{{$producto->cantidad}}" step="1.00" min="1" required>
        </div>
        <div class="form-group">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-control" name="categoria" id="categoria" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->categoria == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" value="{{$producto->precio}}" step="1.00" min="1" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion">{{$producto->descripcion}}</textarea>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="eliminado" id="eliminado" value="{{$producto->eliminado}}" required hidden>
        </div>

        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('productos.index') }}'">Atrás</button>
        <button type="submit" class="btn btn-success">Guardar</button>
        {{-- <input type="submit" class="btn btn-primary" value="Guardar"> --}}
    </form>
</div>
@endsection