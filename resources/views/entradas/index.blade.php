@extends('layouts.appp')
@section('titulo', 'Entradas')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Lista de compras de insumos</strong></h3>
        <div class="card mb-4">
            <div class="card-header">
                <form class="form-inline my-2" method="get">
                    <div class="container-fluid h-100">
                        <div class="row w-100 align-items-center">
                            {{-- Registrar --}}
                            <div class="col-8">
                                <a href="{{ route('entradas.create') }}" class="btn btn-primary">Agregar nueva compra</a>
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
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Insumo</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Proveedor</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Stock agregado</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Stock actual</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Precio</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Encargado</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Fecha</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Descripción</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Editar</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Eliminar</h6></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($entradas as $item)
                            <tr>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->id}}</td>
                                @foreach ($materiasPrimas as $materiaPrima)
                                    @if ($materiaPrima->id == $item->materia_prima)
                                        <td class="text-xxs mb-0 text-center align-middle">{{$materiaPrima->nombre}}</td>
                                    @endif
                                @endforeach
                                @foreach ($proveedores as $proveedor)
                                    @if ($proveedor->id == $item->proveedor)
                                        <td class="text-xxs mb-0 text-center align-middle">{{$proveedor->nombre}}</td>
                                    @endif
                                @endforeach
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->existencia_agregada}}</td>
                                @foreach ($materiasPrimas as $materiaPrima)
                                    @if ($materiaPrima->id == $item->materia_prima)
                                        <td class="text-xxs mb-0 text-center align-middle">{{$materiaPrima->existencia_actual}}</td>
                                    @endif
                                @endforeach
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->precio}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->encargado}}</td>
                                <td class="text-xxs mb-0 text-center align-middle text-nowrap">{{$item->fecha}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->descripcion}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">
                                    <a href="{{ route('entradas.edit', [$item->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                </td>
                                <td class="text-xxs mb-0 text-center align-middle">
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
    </div>
@endsection