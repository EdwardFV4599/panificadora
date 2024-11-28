@extends('layouts.appp')
@section('titulo', 'Elaboración de productos')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Tabla de elaboración de productos</strong></h3>
        <div class="card mb-4">
            <div class="card-header">
                {{-- <form class="form-inline my-2" method="get">
                    <div class="container-fluid h-100">
                        <div class="row w-100 align-items-center">
                            Registrar
                            <div class="col-8">
                                <9a href="{{ route('productos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>
                            </div>
                        </div>
                    </div>
                </form> --}}
            </div>

            <div class="card-body table-responsive">
            {{-- Tabla --}}
                <table id="mi-tabla" class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Codigo</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Producto</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Stock actual</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Ver detalles</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Agregar</h6></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($productos as $item)
                            <tr>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->id}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->nombre}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->stock_actual}}</td>     
                                <td class="text-xxs mb-0 text-center align-middle">
                                    <a href="" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                </td>
                                <td class="text-xxs mb-0 text-center align-middle">
                                    <a href="" class="btn btn-info btn-sm"><i class="fas fa-plus"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection