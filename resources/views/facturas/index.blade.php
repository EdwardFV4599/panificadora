@extends('layouts.appp')
@section('titulo', 'Factura de producto')
@section('contenido')
    <div class="container-fluid">
        <h3><strong>Factura electrónica</strong></h3>
        <div class="card mb-4">
            <div class="card-header">
                <form class="form-inline my-2" method="get">
                    <div class="container-fluid h-100">
                        <div class="row w-100 align-items-center">
                            {{-- Registrar --}}
                            <div class="col-12">
                                <a href="{{ route('ventasproductos.index') }}" class="btn btn-secondary">Regresar</a>
                                <form action="{{ route('factura.descargar', $venta->id) }}" method="GET">
                                    <button type="submit" class="btn btn-primary">Imprimir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body table-responsive">
                <div class="factura-contenido">
                    <table class="table table-sm table-bordered mb-4">
                        <tbody>
                            <tr>
                                <td><strong>Fecha de emisión:</strong></td>
                                <td>{{ $venta->fecha }}</td>
                            </tr>
                            <tr>
                                <td><strong>Forma de pago:</strong></td>
                                <td>Efectivo</td>
                            </tr>
                            <tr class="table-active">
                                <td><strong>Atendido por:</strong></td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Cliente:</strong></td>
                                <td>{{ $venta->cliente }}</td>
                            </tr>
                        </tbody>
                    </table>
    
                    <h4 class="my-3">Detalles de la Venta:</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ number_format($detalle->precio, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Venta total S/.</strong></td>
                            <td class="text-right">{{ number_format($venta->total, 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Importe pagado S/.</strong></td>
                            <td class="text-right">{{ number_format($venta->total, 2) }}</td>
                        </tr>
                        <tr class="table-active">
                            <td><strong>Vuelto S/.</strong></td>
                            <td class="text-right">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
