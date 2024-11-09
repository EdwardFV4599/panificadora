@extends('layouts.appp')
@section('titulo', 'Elaboración de productos')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Lista de productos elaborados</strong></h3>
        <div class="card mb-4">
            <div class="card-header">
                <form class="form-inline my-2" method="get">
                    <div class="container-fluid h-100">
                        <div class="row w-100 align-items-center">
                            {{-- Registrar --}}
                            <div class="col-8">
                                <a href="{{ route('elaboraproductos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body table-responsive">
            {{-- Tabla --}}
                <table id="mi-tabla" class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>#</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Producto</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Cantidad elaborada</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Existencia actual</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Encargado</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Fecha</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Descripción</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Acciones</h6></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($elaboraproductos as $item)
                            <tr>




                                    <a href="{{ route('elaboraproductos.edit', [$item->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                    &nbsp;
                                    <form action="{{ route('elaboraproductos.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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
    </div>
@endsection