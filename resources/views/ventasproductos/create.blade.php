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
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
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


            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('ventasproductos.index') }}'">Atrás</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

        <button type="button" class="btn btn-primary mt-3" id="add-producto">Agregar Producto</button>
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
            document.getElementById('totalVenta').value = totalVenta.toFixed(2); // Actualizar el campo oculto con el total
        }

        // Función para actualizar el precio al seleccionar un producto
        document.getElementById('productos-container').addEventListener('change', function (event) {
            // Si el cambio es en el producto (select)
            if (event.target.classList.contains('producto')) {
                let productoId = event.target.value; // Obtener el ID del producto seleccionado
                let precioInput = event.target.closest('.producto-item').querySelector('.precio'); // Buscar el campo de precio en el mismo producto

                // Obtener el precio del producto seleccionado desde el texto del select
                let selectedOption = event.target.options[event.target.selectedIndex];
                let precio = selectedOption.text.split(' - ')[1].trim().replace('s/.', '').trim(); // Extraer solo el precio del texto
                precioInput.value = parseFloat(precio); // Asignar el precio al campo de precio

                calcularTotal(); // Llamar a la función para recalcular el total
            }

            // Si el cambio es en la cantidad (input)
            if (event.target.classList.contains('cantidad')) {
                calcularTotal(); // Recalcular el total cada vez que cambie la cantidad
            }
        });

        // Función para agregar un nuevo producto al formulario
        document.getElementById('add-producto').addEventListener('click', function () {
            let container = document.getElementById('productos-container');
            let firstProductoItem = document.querySelector('.producto-item'); // Selecciona el primer producto item
            
            if (firstProductoItem) {
                let newProducto = firstProductoItem.cloneNode(true); // Clona el primer producto
                newProducto.querySelectorAll('input').forEach(input => input.value = ''); // Limpia los valores de los inputs
                newProducto.querySelectorAll('select').forEach(select => select.value = ''); // Limpia los valores de los selects
                
                // Actualiza los índices de los campos en el nuevo producto
                let detalles = container.querySelectorAll('.producto-item');
                detalles.forEach((producto, index) => {
                    producto.querySelector('.cantidad').setAttribute('name', `detalles[${index}][cantidad]`);
                    producto.querySelector('.precio').setAttribute('name', `detalles[${index}][precio]`);
                    producto.querySelector('.total').setAttribute('name', `detalles[${index}][total]`);
                    producto.querySelector('.producto').setAttribute('name', `detalles[${index}][producto_id]`);
                });
                
                container.appendChild(newProducto); // Agrega el nuevo producto al contenedor
                calcularTotal(); // Recalcular el total después de agregar el nuevo producto
            }
        });

        // Función para eliminar un producto agregado
        document.getElementById('productos-container').addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-producto')) {
                event.target.closest('.producto-item').remove(); // Eliminar el producto
                calcularTotal(); // Recalcular el total después de eliminar un producto
            }
        });

        // Inicializar el total cuando se cargue la página
        window.onload = function() {
            // Asegurarse de que el primer producto también se calcule al cargar
            let primerosProductos = document.querySelectorAll('.producto-item');
            primerosProductos.forEach(function (producto) {
                let cantidad = parseInt(producto.querySelector('.cantidad').value) || 0;
                let precio = parseFloat(producto.querySelector('.precio').value) || 0;
                let totalProducto = cantidad * precio;
                producto.querySelector('.total').value = totalProducto.toFixed(2);
            });

            calcularTotal(); // Llamar a la función para calcular el total al cargar la página por primera vez
        };

    </script>
@endsection