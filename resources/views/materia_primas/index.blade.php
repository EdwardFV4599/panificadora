@extends('layouts.appp')
@section('titulo', 'Materias primas')
@section('contenido')
<div class="container">
    <h1>Lista de Materias Primas</h1>
    <a href="{{ route('materia_primas.create') }}" class="btn btn-primary">Crear Materia Prima</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Unidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiasPrimas as $materiaPrima)
                <tr>
                    <td>{{ $materiaPrima->nombre }}</td>
                    <td>{{ $materiaPrima->cantidad }}</td>
                    <td>{{ $materiaPrima->unidad }}</td>
                    <td>{{ $materiaPrima->precio }}</td>
                    <td>
                        <a href="{{ route('materia_primas.edit', $materiaPrima->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('materia_primas.destroy', $materiaPrima->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


@section('contenido')
<div class="card mb-4">
    <div class="card-header">
        <form class="form-inline my-2" method="get">
            <div class="container-fluid h-100">
                <div class="row w-100 align-items-center">
                    {{-- Registrar --}}
                    <div class="col-7">
                        <a href="{{ route('materia_primas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
    {{-- Tabla --}}
        <table id="mi-tabla" class="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>#</h6></th>
                    <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Nombre</h6></th>
                    <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Cantidad</h6></th>
                    <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Unidad</h6></th>
                    <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Precio</h6></th>
                    <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Acciones</h6></th>
                </tr>
            </thead>

            <tbody>
                @if ($productos->count() == 0)
                    <tr>
                        <td colspan="3">No hay registros</td>
                    </tr>
                @endif

                @foreach ($productos as $item)
                    <tr>
                        <td class="text-xxs mb-0 text-center">{{$item->id}}</td>
                        <td class="text-xxs mb-0 text-center">{{$item->nombre}}</td>
                        <td class="text-xxs mb-0 text-center">{{$item->precio}}</td>
                        <td class="text-xxs mb-0 text-center">{{$item->descripcion}}</td>
                        <td class="text-xxs mb-0 text-center">{{$item->stock}}</td>
                        <td class="text-xxs mb-0 text-center">
                            <a href="{{ route('productos.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                            &nbsp;
                            
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>

                            <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Registro eliminado</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                ¿Está seguro que desea eliminar este registro?<br>
                                                <i>Se eliminará toda la información registrada</i>
                                            </div>

                                            <div class="modal-footer m-2">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection