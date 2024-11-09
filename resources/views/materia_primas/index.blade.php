@extends('layouts.appp')
@section('titulo', 'Materias primas')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Lista de materias primas</strong></h3>
        <div class="card mb-4">
            <div class="card-header">
                <form class="form-inline my-2" method="get">
                    <div class="container-fluid h-100">
                        <div class="row w-100 align-items-center">
                            {{-- Registrar --}}
                            <div class="col-8">
                                <a href="{{ route('materia_primas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
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
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Nombre</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Existencia actual</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Unidad</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Descripción</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Editar</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Eliminar</h6></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($materiasPrimas as $item)
                            <tr>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->id}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->nombre}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->existencia_actual}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->unidad}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->descripcion}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">
                                    <a href="{{ route('materia_primas.edit', [$item->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                                <td class="text-xxs mb-0 text-center align-middle">
                                    <form action="{{ route('materia_primas.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" >
                                            <i class="fas fa-trash"></i>
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