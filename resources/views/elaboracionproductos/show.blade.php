@extends('layouts.appp')
@section('titulo', 'Historial de Elaboración')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Historial de elaboración de {{ $producto->nombre }}</strong></h3>
        <div class="card mb-4">
            <div class="card-header">
                <form class="form-inline my-2" method="get">
                    <div class="container-fluid h-100">
                        <div class="row w-100 align-items-center">
                            <div class="col-12">
                                <a href="{{ route('elaboracionproductos.index') }}" class="btn btn-primary">Regresar</a>
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
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col">ID</th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col">Cantidad Elaborada</th>
                            <th class="text-uppercase text-xxs mb-0 text-center align-middle" scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historial as $registro)
                            <tr>
                                <td class="text-xxs mb-0 text-center align-middle">{{ $registro->id }}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{ $registro->cantidad_elaborada }}</td>
                                <td class="text-xxs mb-0 text-center align-middle">{{ $registro->fecha }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
