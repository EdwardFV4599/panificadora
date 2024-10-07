@extends('layouts.appp')
@section('titulo', 'Categorias')
@section('contenido')
    <h3>Lista de categorias</h3>
    <div class="card mb-4">
        <div class="card-header">
            <form class="form-inline my-2" method="get">
                <div class="container-fluid h-100">
                    <div class="row w-100 align-items-center">
                        {{-- Registrar --}}
                        <div class="col-7">
                            <a href="{{ route('categorias.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
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
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Acciones</h6></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($categorias->count() == 0)
                        <tr>
                            <td colspan="3">No hay registros</td>
                        </tr>
                    @endif

                    @foreach ($categorias as $item)
                        <tr>
                            <td class="text-xxs mb-0 text-center">{{$item->id}}</td>
                            <td class="text-xxs mb-0 text-center">{{$item->nombre}}</td>
                            <td class="text-xxs mb-0 text-center">
                                <a href="{{ route('categorias.edit', [$item->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                &nbsp;
                                <form action="{{ route('categorias.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" >
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection