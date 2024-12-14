@extends('layouts.appp')
@section('titulo', 'Tiempos de registros')
@section('contenido')
    <div class="container-fluid mt-4">
        <h3><strong>Tiempos de registro de ventas, inventarios y reportes</strong></h3>
        
        <!-- Datos de Ventas -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>Datos de ventas</h5>
            </div>
            <div class="card-body">
                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código venta</th>
                                <th>Fecha</th>
                                <th>Hora inicial</th>
                                <th>Hora final</th>
                                <th>Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventastiempos as $item)
                                <tr>
                                    <td>{{ $item->codigo_venta }}</td>
                                    <td>{{ $item->fecha }}</td>
                                    <td>{{ $item->hora_inicial }}</td>
                                    <td>{{ $item->hora_final }}</td>
                                    <td>{{ $item->duracion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Datos de Inventarios -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5>Datos de inventarios</h5>
            </div>
            <div class="card-body">
                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código compra</th>
                                <th>Fecha</th>
                                <th>Hora inicial</th>
                                <th>Hora final</th>
                                <th>Duración</th>
                                <th>Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventariostiempos as $item)
                                <tr>
                                    <td>{{ $item->codigo_compra }}</td>
                                    <td>{{ $item->fecha }}</td>
                                    <td>{{ $item->hora_inicial }}</td>
                                    <td>{{ $item->hora_final }}</td>
                                    <td>{{ $item->duracion }}</td>
                                    <td>{{ $item->error }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Datos de Reportes -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h5>Datos de reportes</h5>
            </div>
            <div class="card-body">
                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código reporte</th>
                                <th>Fecha</th>
                                <th>Hora inicial</th>
                                <th>Hora final</th>
                                <th>Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportestiempos as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->fecha }}</td>
                                    <td>{{ $item->hora_inicial }}</td>
                                    <td>{{ $item->hora_final }}</td>
                                    <td>{{ $item->duracion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Botones para exportar -->
        <div class="text-center mt-4">
            <a href="{{ route('tiempos.exportExcel') }}" class="btn btn-success btn-lg mr-2">
                Descargar en Excel
            </a>
            <a href="{{ route('tiempos.exportPdf') }}" class="btn btn-danger btn-lg">
                Descargar en PDF
            </a>
        </div>

        {{-- Espaciado --}}
        <div class="mb-3"></div>
    </div>
@endsection
