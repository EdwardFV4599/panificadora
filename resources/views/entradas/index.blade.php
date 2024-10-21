@extends('layouts.appp')
@section('titulo', 'Entradas')
@section('contenido')
    <h3>Lista de entradas de materia prima</h3>
    <div class="card mb-4">
        <div class="card-header">
            <form class="form-inline my-2" method="get">
                <div class="container-fluid h-100">
                    <div class="row w-100 align-items-center">
                        {{-- Registrar --}}
                        <div class="col-7">
                            <a href="{{ route('entradas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
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
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Materia prima</h6></th>
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Proveedor</h6></th>
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Existencia agregada</h6></th>
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Existencia actual</h6></th>
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Precio</h6></th>
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Encargado</h6></th>
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Fecha</h6></th>
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Descripción</h6></th>
                        <th class="text-uppercase text-xxs mb-0 text-center" scope="col"><h6>Acciones</h6></th>
                    </tr>
                </thead>

                <tbody>
                    @if ($entradas->count() == 0)
                        <tr>
                            <td colspan="3">No hay registros</td>
                        </tr>
                    @endif

                    @foreach ($entradas as $item)
                        <tr>
                            <td class="text-xxs mb-0 text-center">{{$item->id}}</td>
                            @foreach ($materiasPrimas as $materiaPrima)
                                @if ($materiaPrima->id == $item->materia_prima)
                                    <td class="text-xxs mb-0 text-center">{{$materiaPrima->nombre}}</td>
                                @endif
                            @endforeach
                            @foreach ($proveedores as $proveedor)
                                @if ($proveedor->id == $item->proveedor)
                                    <td class="text-xxs mb-0 text-center">{{$proveedor->nombre}}</td>
                                @endif
                            @endforeach
                            <td class="text-xxs mb-0 text-center">{{$item->existencia_agregada}}</td>
                            @foreach ($materiasPrimas as $materiaPrima)
                                @if ($materiaPrima->id == $item->materia_prima)
                                    <td class="text-xxs mb-0 text-center">{{$materiaPrima->existencia_actual}}</td>
                                @endif
                            @endforeach
                            <td class="text-xxs mb-0 text-center">{{$item->precio}}</td>
                            <td class="text-xxs mb-0 text-center">{{$item->encargado}}</td>
                            <td class="text-xxs mb-0 text-center">{{$item->fecha}}</td>
                            <td class="text-xxs mb-0 text-center">{{$item->descripcion}}</td>
                            <td class="text-xxs mb-0 text-center">
                                <a href="{{ route('entradas.edit', [$item->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                &nbsp;
                                <form action="{{ route('entradas.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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