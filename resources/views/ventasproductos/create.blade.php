@extends('layouts.appp')
@section('titulo', 'Ventas de productos')
@section('contenido')
<div class="container-fluid">
    <h3><strong>Registrar venta de productos</strong></h3>
    <form action="{{ route('ventasproductos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" id="fecha" required>
        </div>
        <div class="form-group">
            <label for="cliente" class="form-label">Cliente</label>
            <input type="text" class="form-control" name="cliente" id="cliente" required>
        </div>

        <h4>Detalles de la venta</h4>
        <div id="productos-container">
            <div class="producto-item mb-3">
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="producto_id" class="form-label">Producto</label>
                        <select class="form-control producto" name="detalles[0][producto_id]" required>
                            <option value="" disabled selected>Seleccione un producto</option> 
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }} - s/.{{ number_format($producto->precio, 2) }}</option>
                            @endforeach
                        </select>                            
                    </div>
                    <div class="col-md-2">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control cantidad" name="detalles[0][cantidad]" min="1" step="1" required>
                    </div>
                    <div class="col-md-2">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control precio" name="detalles[0][precio]" step="0.1" min="0" required readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control total" name="detalles[0][total]" step="0.1" min="0" required readonly>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-producto">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="total" id="totalVenta">

        <button type="button" class="btn btn-primary" id="add-producto">Agregar producto</button>
        <button type="submit" class="btn btn-success" onclick="guardarVenta()">Guardar venta</button>
    </form>

    <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('ventasproductos.index') }}'">Volver atrás</button>
</div>
@endsection

@section('scripts')
    <script>
        // Función para calcular el total de cada producto y el total general
        function calcularTotal() {
            let totalVenta = 0;
            let productos = document.querySelectorAll('.producto-item');
            
            productos.forEach(function (producto) {
                let cantidad = parseInt(producto.querySelector('.cantidad').value) || 0;
                let precio = parseFloat(producto.querySelector('.precio').value) || 0;
                let totalProducto = cantidad * precio;

                producto.querySelector('.total').value = totalProducto.toFixed(2);
                totalVenta += totalProducto;
            });

            document.getElementById('totalVenta').value = totalVenta.toFixed(2);
        }

        // Función para actualizar el precio al seleccionar un producto
        document.getElementById('productos-container').addEventListener('change', function (event) {
            if (event.target.classList.contains('producto')) {
                let productoId = event.target.value;
                let precioInput = event.target.closest('.producto-item').querySelector('.precio');
                
                let selectedOption = event.target.options[event.target.selectedIndex];
                let precio = selectedOption.text.split(' - ')[1].trim().replace('s/.', '').trim();

                precioInput.value = parseFloat(precio);
                calcularTotal();
            }

            if (event.target.classList.contains('cantidad')) {
                calcularTotal();
            }
        });

        // Función para agregar un nuevo producto al formulario
        document.getElementById('add-producto').addEventListener('click', function () {
            let container = document.getElementById('productos-container');
            let newProducto = document.querySelector('.producto-item').cloneNode(true);

            // Limpia campos en la nueva fila
            newProducto.querySelectorAll('input').forEach(input => input.value = '');
            newProducto.querySelectorAll('select').forEach(select => select.value = '');

            let index = container.querySelectorAll('.producto-item').length;

            newProducto.querySelector('.cantidad').setAttribute('name', `detalles[${index}][cantidad]`);
            newProducto.querySelector('.precio').setAttribute('name', `detalles[${index}][precio]`);
            newProducto.querySelector('.total').setAttribute('name', `detalles[${index}][total]`);
            newProducto.querySelector('.producto').setAttribute('name', `detalles[${index}][producto_id]`);

            container.appendChild(newProducto);

            calcularTotal();
        });

        // Función para eliminar un producto agregado
        document.getElementById('productos-container').addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-producto')) {
                event.target.closest('.producto-item').remove();
                calcularTotal();
            }
        });

        // Función de inicialización para el cálculo al cargar la página
        window.onload = function() {
            calcularTotal();
        };
    </script>
    
    {{-- ----------------------------------------------------------------------------------------------- --}}

    <script>
        let codigoVenta;
    
        window.onload = function() {
            // Iniciar el temporizador cuando accedas a la vista
            fetch('/ventasproductos/crear')
                .then(response => response.json())
                .then(data => {
                    codigoVenta = data.codigo_venta;
                    console.log("Código de Venta:", codigoVenta);
                });
        }
    
        function guardarVenta() {
            // Enviar el código de venta al backend cuando se presione "Guardar"
            fetch('/ventasproductos/guardar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ codigo_venta: codigoVenta })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            });
        }
    </script>
@endsection
