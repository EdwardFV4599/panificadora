@extends('layouts.appp')
@section('titulo', 'Factura de producto')
@section('contenido')
    <div class="container-fluid">
        <h1 class="text-center">Factura Electrónica</h1>

        <div class="factura-contenido">
            <!-- Información de la factura -->
            <div class="header">
                <img src="../resources/img/logo.png" class="logo" alt="Logo de la empresa">
                <p class="negrita interlineado">R.U.C: 10266950247</p>
                <p class="interlineado">Av. Gonzales Caceda</p>
                <p class="interlineado">Chepén - La Libertad</p>
                <p class="interlineado">Telf: 123 - 4567</p>
                <p class="interlineado">www.coronel.com</p>
                <p class="interlineado">info@empresa.com</p>
                <p class="titulo interlineado">Factura Electrónica</p>
                <p class="negrita">F000{{$venta->id}} - 18842</p>
            </div>

            <table>
                <tr>
                    <td><strong>Fecha de emisión:</strong></td>
                    <td>{{ $venta->fecha }}</td>
                </tr>
                <tr>
                    <td><strong>Forma de pago:</strong></td>
                    <td>Efectivo</td>
                </tr>
                <tr class="linea">
                    <td><strong>Atendido por:</strong></td>
                    <td>{{ auth()->user()->name }}</td>
                </tr>
                <tr>
                    <td><strong>Cliente:</strong></td>
                    <td>{{ $venta->cliente }}</td>
                </tr>
                <tr class="linea">
                    <td><strong>Descripción:</strong></td>
                    <td>{{ $venta->descripcion }}</td>
                </tr>
            </table>

            <h4>Detalles de la Venta:</h4>
            <table class="table table-bordered">
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

            <table>
                <tr>
                    <td><strong>Venta total S/.</strong></td>
                    <td class="derecha">{{ number_format($venta->total, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Importe pagado S/.</strong></td>
                    <td class="derecha">{{ number_format($venta->total, 2) }}</td>
                </tr>
                <tr class="linea">
                    <td><strong>Vuelto S/.</strong></td>
                    <td class="derecha">0.00</td>
                </tr>
            </table>

            <!-- Botón para descargar la factura como PDF -->
            <form action="{{ route('factura.descargar', $venta->id) }}" method="GET">
                <button type="submit" class="btn btn-primary">Descargar PDF</button>
            </form>
        </div>
    </div>

    <footer>
        ¡Gracias por su compra!
    </footer>

@endsection
