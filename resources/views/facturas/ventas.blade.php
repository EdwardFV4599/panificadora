<!DOCTYPE html>
<html>
<head>
    <title>Factura Electrónica</title>
    <style>
        body {
            font-family: "Courier New", Courier, monospace;
            margin: 0;
            padding: 0 50px;
            font-size: 0.9em;
            background-color: #f4f4f4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 120px; /* Ajusta el tamaño según tu logo */
            height: auto;
            background-image: url('../resources/img/logo.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .linea {
            border-bottom: 1px solid #000;
        }

        .titulo {
            font-weight: bold;
            font-size: 1.4em;
            margin-top: 20px;
        }

        .derecha {
            text-align: right;
        }

        .negrita {
            font-weight: bold;
        }

        .interlineado {
            margin-bottom: -10px;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.8em;
        }

        .footer-info {
            margin-top: 20px;
            font-size: 0.8em;
            text-align: center;
        }

        .footer-info p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Factura Electrónica</h1>
        <p class="negrita interlineado">R.U.C: 10266950247</p>
        <p class="interlineado">Av. Exequiel Gonzales Caceda #756, Chepén - La Libertad</p>
        <p class="interlineado">Telf: 965 656 689</p>
        <p class="interlineado">www.coronel.com</p>
        <p class="negrita">F000{{$venta->id}} - 18842</p>
    </div>

    <table>
        <tr>
            <td>Fecha de emisión</td>
            <td>: {{$venta->fecha}}</td>
        </tr>
        <tr>
            <td>Forma de pago</td>
            <td>: Efectivo</td>
        </tr>
        <tr class="linea">
            <td>Atendido por</td>
            <td>: {{ auth()->user()->name }}</td>
        </tr>
        {{-- ----------------------------------------------------------------------- --}}

        <tr>
            <td>Cliente</td>
            <td>: {{$venta->cliente}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
        @foreach($detalles as $detalle)
        <tr class="linea">
            <td>{{ $detalle->producto->nombre }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td>{{ number_format($detalle->precio, 2) }}</td>
        </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <td>Venta total S/.</td>
            <td class="derecha">{{ number_format($venta->total, 2) }}</td>
        </tr>
        <tr>
            <td>Importe pagado S/.</td>
            <td class="derecha">{{ number_format($venta->total, 2) }}</td>
        </tr>
        <tr class="linea">
            <td>Vuelto S/.</td>
            <td class="derecha">0.00</td>
        </tr>
        <!-- Agrega más filas según sea necesario -->
    </table>

    <footer>
        ¡Gracias por su compra!
    </footer>

    <div class="footer-info">
        <p>Para consultas o más información, visite nuestra página web.</p>
    </div>
</body>
</html>
