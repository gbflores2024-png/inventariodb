@extends('adminlte::page')

@section('title', 'Nueva Devolución')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h1 class="mb-1">
                <i class="fas fa-undo text-primary"></i>
                Nueva Devolución
            </h1>

            <p class="text-muted mb-0">
                Registrar devolución de un producto vendido
            </p>

        </div>

        <a href="{{ route('devoluciones.index') }}"
           class="btn btn-outline-secondary">

            <i class="fas fa-arrow-left"></i>
            Volver

        </a>

    </div>

@stop


@section('content')

    {{-- ==========================================================
         MENSAJES DE VALIDACIÓN
         ========================================================== --}}

    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible fade show">

            <button type="button"
                    class="close"
                    data-dismiss="alert">

                <span>&times;</span>

            </button>

            <h5>
                <i class="fas fa-exclamation-triangle"></i>
                Se encontraron errores
            </h5>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('devoluciones.store') }}"
          method="POST">

        @csrf


        {{-- ======================================================
             SELECCIONAR VENTA
             ====================================================== --}}

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-receipt"></i>

                    Seleccionar venta

                </h3>

            </div>


            <div class="card-body">

                <div class="form-group mb-0">

                    <label for="id_venta">

                        Venta

                        <span class="text-danger">*</span>

                    </label>

                    <select name="id_venta"
                            id="id_venta"
                            class="form-control"
                            required>

                        <option value="">
                            -- Seleccione una venta --
                        </option>


                        @foreach($ventas as $venta)

                            <option value="{{ $venta->id_venta }}">

                                Venta #{{ $venta->id_venta }}

                                -

                                Pedido #{{ $venta->id_pedido }}

                                -

                                {{ $venta->pedido->reserva->cliente->nombre ?? 'Cliente no registrado' }}

                                -

                                Bs. {{ number_format($venta->total, 2) }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        {{-- ======================================================
             INFORMACIÓN DE LA VENTA
             ====================================================== --}}

        <div id="informacionVenta"
             style="display:none;">

            <div class="row">

                {{-- CLIENTE --}}

                <div class="col-md-6">

                    <div class="card card-info">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-user"></i>

                                Información del cliente

                            </h3>

                        </div>


                        <div class="card-body">

                            <p>
                                <strong>Nombre:</strong>

                                <span id="clienteNombre"></span>
                            </p>

                            <p>
                                <strong>Email:</strong>

                                <span id="clienteEmail"></span>
                            </p>

                            <p>
                                <strong>Teléfono:</strong>

                                <span id="clienteTelefono"></span>
                            </p>

                            <p class="mb-0">
                                <strong>Dirección:</strong>

                                <span id="clienteDireccion"></span>
                            </p>

                        </div>

                    </div>

                </div>


                {{-- VENTA --}}

                <div class="col-md-6">

                    <div class="card card-success">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-shopping-cart"></i>

                                Información de la venta

                            </h3>

                        </div>


                        <div class="card-body">

                            <p>
                                <strong>N° Venta:</strong>

                                <span id="numeroVenta"></span>
                            </p>

                            <p>
                                <strong>Pedido:</strong>

                                <span id="numeroPedido"></span>
                            </p>

                            <p>
                                <strong>Fecha:</strong>

                                <span id="fechaVenta"></span>
                            </p>

                            <p class="mb-0">

                                <strong>Total:</strong>

                                Bs.

                                <span id="totalVenta"></span>

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ==================================================
                 PRODUCTOS DE LA VENTA
                 ================================================== --}}

            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-box"></i>

                        Productos disponibles para devolución

                    </h3>

                </div>


                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>Producto</th>
                                    <th>Talla</th>
                                    <th>Color</th>
                                    <th>Cantidad</th>
                                    <th>Precio unitario</th>
                                </tr>

                            </thead>


                            <tbody id="tablaProductos">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            {{-- ==================================================
                 DATOS DE LA DEVOLUCIÓN
                 ================================================== --}}

            <div class="card card-warning">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-undo-alt"></i>

                        Datos de la devolución

                    </h3>

                </div>


                <div class="card-body">

                    <div class="row">

                        {{-- PRODUCTO --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="id_producto">

                                    Producto a devolver

                                    <span class="text-danger">*</span>

                                </label>

                                <select name="id_producto"
                                        id="id_producto"
                                        class="form-control"
                                        required
                                        disabled>

                                    <option value="">

                                        -- Seleccione una venta primero --

                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- CANTIDAD --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="cantidad">

                                    Cantidad

                                    <span class="text-danger">*</span>

                                </label>

                                <input type="number"
                                       name="cantidad"
                                       id="cantidad"
                                       class="form-control"
                                       min="1"
                                       required>

                            </div>

                        </div>


                        {{-- MOTIVO --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="motivo">

                                    Motivo

                                    <span class="text-danger">*</span>

                                </label>

                                <select name="motivo"
                                        id="motivo"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- Seleccione un motivo --
                                    </option>

                                    <option value="Producto defectuoso">
                                        Producto defectuoso
                                    </option>

                                    <option value="Talla incorrecta">
                                        Talla incorrecta
                                    </option>

                                    <option value="Color incorrecto">
                                        Color incorrecto
                                    </option>

                                    <option value="Cambio de producto">
                                        Cambio de producto
                                    </option>

                                    <option value="Otro">
                                        Otro
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- ESTADO --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="estado">

                                    Estado

                                    <span class="text-danger">*</span>

                                </label>

                                <select name="estado"
                                        id="estado"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- Seleccione un estado --
                                    </option>

                                    <option value="PENDIENTE">
                                        PENDIENTE
                                    </option>

                                    <option value="ACEPTADA">
                                        ACEPTADA
                                    </option>

                                    <option value="RECHAZADA">
                                        RECHAZADA
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- FECHA --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="fecha_devolucion">

                                    Fecha de devolución

                                    <span class="text-danger">*</span>

                                </label>

                                <input type="date"
                                       name="fecha_devolucion"
                                       id="fecha_devolucion"
                                       class="form-control"
                                       value="{{ date('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ==================================================
                 BOTONES
                 ================================================== --}}

            <div class="card">

                <div class="card-body text-right">

                    <a href="{{ route('devoluciones.index') }}"
                       class="btn btn-secondary btn-lg mr-2">

                        <i class="fas fa-times"></i>

                        Cancelar

                    </a>


                    <button type="submit"
                            class="btn btn-success btn-lg">

                        <i class="fas fa-save"></i>

                        Registrar Devolución

                    </button>

                </div>

            </div>

        </div>

    </form>


    {{-- ==========================================================
         DATOS PARA JAVASCRIPT
         ========================================================== --}}

    <script>

        const ventas = @json($ventas);


        const selectVenta =
            document.getElementById('id_venta');

        const selectProducto =
            document.getElementById('id_producto');

        const informacionVenta =
            document.getElementById('informacionVenta');


        const clienteNombre =
            document.getElementById('clienteNombre');

        const clienteEmail =
            document.getElementById('clienteEmail');

        const clienteTelefono =
            document.getElementById('clienteTelefono');

        const clienteDireccion =
            document.getElementById('clienteDireccion');


        const numeroVenta =
            document.getElementById('numeroVenta');

        const numeroPedido =
            document.getElementById('numeroPedido');

        const fechaVenta =
            document.getElementById('fechaVenta');

        const totalVenta =
            document.getElementById('totalVenta');


        const tablaProductos =
            document.getElementById('tablaProductos');


        selectVenta.addEventListener('change', function () {

            const idVenta = this.value;


            if (!idVenta) {

                informacionVenta.style.display = 'none';

                selectProducto.innerHTML = `

                    <option value="">

                        -- Seleccione una venta primero --

                    </option>

                `;

                selectProducto.disabled = true;

                tablaProductos.innerHTML = '';

                return;
            }


            const venta = ventas.find(
                v => v.id_venta == idVenta
            );


            if (!venta) {

                informacionVenta.style.display = 'none';

                return;
            }


            informacionVenta.style.display = 'block';


            /* ==================================================
               INFORMACIÓN DE LA VENTA
               ================================================== */

            numeroVenta.textContent =
                '#' + venta.id_venta;

            numeroPedido.textContent =
                '#' + venta.id_pedido;

            fechaVenta.textContent =
                venta.fecha_venta ?? 'No registrada';

            totalVenta.textContent =
                parseFloat(venta.total ?? 0).toFixed(2);


            /* ==================================================
               INFORMACIÓN DEL CLIENTE
               ================================================== */

            const reserva =
                venta.pedido
                    ? venta.pedido.reserva
                    : null;


            const cliente =
                reserva
                    ? reserva.cliente
                    : null;


            if (cliente) {

                clienteNombre.textContent =
                    cliente.nombre ?? 'No registrado';

                clienteEmail.textContent =
                    cliente.email ?? 'No registrado';

                clienteTelefono.textContent =
                    cliente.telefono ?? 'No registrado';

                clienteDireccion.textContent =
                    cliente.direccion ?? 'No registrada';

            } else {

                clienteNombre.textContent =
                    'No registrado';

                clienteEmail.textContent =
                    'No registrado';

                clienteTelefono.textContent =
                    'No registrado';

                clienteDireccion.textContent =
                    'No registrada';

            }


            /* ==================================================
               PRODUCTOS
               ================================================== */

            tablaProductos.innerHTML = '';


            selectProducto.innerHTML = `

                <option value="">

                    -- Seleccione producto --

                </option>

            `;


            selectProducto.disabled = false;


            if (
                reserva &&
                reserva.detalle_reservas &&
                reserva.detalle_reservas.length > 0
            ) {


                reserva.detalle_reservas.forEach(
                    detalle => {

                        const producto =
                            detalle.producto;


                        if (!producto) {

                            return;

                        }


                        /* TABLA */

                        const fila =
                            document.createElement('tr');


                        fila.innerHTML = `

                            <td>
                                ${producto.nombre ?? '-'}
                            </td>

                            <td>
                                ${producto.talla ?? '-'}
                            </td>

                            <td>
                                ${producto.color ?? '-'}
                            </td>

                            <td>
                                ${detalle.cantidad ?? 0}
                            </td>

                            <td>
                                Bs.
                                ${parseFloat(
                                    detalle.precio_unitario ?? 0
                                ).toFixed(2)}
                            </td>

                        `;


                        tablaProductos.appendChild(fila);


                        /* SELECT PRODUCTO */

                        const opcion =
                            document.createElement('option');


                        opcion.value =
                            producto.id_producto;


                        opcion.textContent =
                            producto.nombre +
                            ' - Talla ' +
                            (producto.talla ?? '-') +
                            ' - ' +
                            (producto.color ?? '-');


                        opcion.dataset.maxCantidad =
                            detalle.cantidad ?? 1;


                        selectProducto.appendChild(
                            opcion
                        );

                    }
                );


            } else {

                tablaProductos.innerHTML = `

                    <tr>

                        <td colspan="5"
                            class="text-center text-muted">

                            Esta venta no tiene productos
                            registrados.

                        </td>

                    </tr>

                `;

            }

        });


        /* ==========================================================
           CONTROLAR CANTIDAD
           ========================================================== */

        selectProducto.addEventListener(
            'change',
            function () {

                const opcion =
                    this.options[this.selectedIndex];


                if (
                    opcion &&
                    opcion.dataset.maxCantidad
                ) {

                    document.getElementById(
                        'cantidad'
                    ).max =
                        opcion.dataset.maxCantidad;

                } else {

                    document.getElementById(
                        'cantidad'
                    ).removeAttribute('max');

                }

            }
        );

    </script>

@stop