@extends('layouts.appp')
@section('titulo', 'Ventas de productos')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Tabla de ventas de productos</strong></h3>
        <div class="card mb-4">
            <div class="card-header">
                <form class="form-inline my-2" method="get">
                    <div class="container-fluid h-100">
                        <div class="row w-100 align-items-center">
                            {{-- Registrar --}}
                            <div class="col-10">
                                <a href="{{ route('ventasproductos.create') }}" class="btn btn-primary">Agregar nueva venta</a>
                            </div>
                            {{-- <div class="col-2">
                                <a href="{{ route('exportarCSV') }}" _target="blank" class="btn btn-primary">Generar CSV</a>
                            </div> --}}
                            <div class="col-2">
                                <a href="{{ route('vergrafica') }}" class="btn btn-primary" target="_blank">Ver gráfica</a>
                            </div>
                            {{-- <div class="col-2">
                                <a href="{{ route('ventas.predecir') }}" class="btn btn-primary" target="_blank">Ver prediccion</a>
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
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>#</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Fecha</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Total</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Cliente</h6></th>
                            {{-- <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Descripción</h6></th> --}}
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Ver factura</h6></th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col"><h6>Cancelar</h6></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ventasproductos as $item)
                            <tr>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->id}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->fecha}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->total}}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{$item->cliente}}</td>
                                {{-- <td class="text-xxs mb-0 text-center align-middle">{{$item->descripcion}}</td> --}}
                                <td class="text-xxs mb-0 text-center align-middle">
                                    <a href="{{ route('factura.mostrar', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="text-xxs mb-0 text-center align-middle">
                                    <form action="{{ route('ventasproductos.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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