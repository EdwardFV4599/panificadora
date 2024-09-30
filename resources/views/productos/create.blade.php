@extends('layouts.appp')

@section('contenido')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" name="precio" id="precio" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" required>
        </div>
        <button type="submit" class="btn btn-success">Crear Producto</button>
    </form>
</div>
@endsection


@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{ route('guardarMesa') }}" method="post" class="col-md-8">
            <h5 class="title" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                <strong>
                    <center>Registrar datos de la mesa </center>
                </strong>
            </h5>
            @csrf

            <div class="col-md-12 m-5">
                <div class="mb-3">
                    <label for="" class="form-label">Nombre de Mesa</label>
                    <input type="text" class="form-control" name="nombre" id="" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Capacidad</label>
                    <select class="form-select" aria-label="Default select example" name="capacidad" required>
                        <option value="1">1 persona</option>
                        <option value="2">2 personas</option>
                        <option value="3">3 personas</option>
                        <option value="4">4 personas</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Estado</label>
                    <select class="form-select" aria-label="Default select example" name="estado" required>
                        <option value="Disponible">Disponible</option>
                        <option value="Reservada">Reservada</option>
                        <option value="Ocupada">Ocupada</option>
                    </select>
                </div>
            </div>

            <div class="mb-2" style="text-align: center">
                <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('mesa') }}'">Atrás</button>
                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </form>
    </div>
</div>
@endsection