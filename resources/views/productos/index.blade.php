@extends('layouts.appp')
@section('titulo', 'Productos')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Tabla de productos</strong></h3>
        <div class="card mb-4">
            <div class="card-header">
                <form class="form-inline my-2" method="get">
                    <div class="container-fluid h-100">
                        <div class="row w-100 align-items-center">
                            {{-- <div class="col-8">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body table-responsive">
                {{-- Tabla --}}
                <table id="mi-tabla" class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Código</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Nombre</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Categoria</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Stock actual</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Precio</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Descripción</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Editar</h6></th>
                            {{-- <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Eliminar</h6></th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($productos as $item)
                            <tr>
                                <td class="text-xxs mb-0 text-center align-middle">COD-0{{$item->id}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->nombre}}</td>
                                @foreach ($categorias as $categoria)
                                    @if ($categoria->id == $item->categoria)
                                        <td class="text-xxs mb-0 text-center align-middle">{{$categoria->nombre}}</td>
                                    @endif
                                @endforeach
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->stock_actual}}</td>     
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->precio}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->descripcion}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">
                                    <a href="{{ route('productos.edit', [$item->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                                {{-- <td class="text-xxs mb-0 text-center align-middle">
                                    <form action="{{ route('productos.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection