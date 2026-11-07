@extends('adminlte::page')

@section('title', 'Nueva Venta')

@section('content_header') <div class="d-flex justify-content-between align-items-center"> <div> <h1 class="mb-1"> <i class="fas fa-cash-register text-primary"></i>
Nueva Venta </h1> <p class="text-muted mb-0">
Registrar una nueva venta a partir de un pedido </p> </div>

```
    <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i>
        Volver a ventas
    </a>
</div>
```

@stop

@section('content')

{{-- ==========================================================
MENSAJES DE VALIDACIÓN
========================================================== --}}

@if ($errors->any()) <div class="alert alert-danger"> <h5> <i class="fas fa-exclamation-triangle"></i>
Se encontraron algunos errores: </h5>

```
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
```

@endif

<form action="{{ route('ventas.store') }}" method="POST">

```
@csrf

{{-- ==========================================================
     SELECCIÓN DEL PEDIDO
     ========================================================== --}}

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-invoice"></i>
            Seleccionar pedido
        </h3>
    </div>

    <div class="card-body">

        <div class="form-group mb-0">

            <label for="id_pedido">
                Pedido <span class="text-danger">*</span>
            </label>

            <select name="id_pedido"
                    id="id_pedido"
                    class="form-control form-control-lg"
                    required>

                <option value="">
                    -- Seleccione un pedido --
                </option>

                @foreach($pedidos as $pedido)

                    <option value="{{ $pedido->id_pedido }}">

                        Pedido #{{ $pedido->id_pedido }}
                        -
                        {{ $pedido->reserva->cliente->nombre ?? 'Cliente no registrado' }}
                        -
                        {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y') }}

                    </option>

                @endforeach

            </select>

            <small class="form-text text-muted">
                Seleccione un pedido para consultar los datos del cliente
                y los productos antes de registrar la venta.
            </small>

        </div>

    </div>

</div>


{{-- ==========================================================
     INFORMACIÓN DEL PEDIDO
     ========================================================== --}}

<div id="informacionPedido" style="display:none;">

    <div class="row">

        {{-- ==================================================
             CLIENTE
             ================================================== --}}

        <div class="col-lg-6">

            <div class="card card-info h-100">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-user"></i>
                        Información del cliente
                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-sm-12 mb-3">

                            <div class="d-flex align-items-center">

                                <div class="mr-3">
                                    <i class="fas fa-user-circle fa-2x text-info"></i>
                                </div>

                                <div>
                                    <small class="text-muted">
                                        Cliente
                                    </small>

                                    <div class="font-weight-bold"
                                         id="clienteNombre">
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <small class="text-muted">
                                <i class="fas fa-envelope"></i>
                                Email
                            </small>

                            <div id="clienteEmail">
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <small class="text-muted">
                                <i class="fas fa-phone"></i>
                                Teléfono
                            </small>

                            <div id="clienteTelefono">
                            </div>

                        </div>


                        <div class="col-12">

                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt"></i>
                                Dirección
                            </small>

                            <div id="clienteDireccion">
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ==================================================
             PEDIDO
             ================================================== --}}

        <div class="col-lg-6">

            <div class="card card-primary h-100">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-shopping-cart"></i>
                        Información del pedido
                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <small class="text-muted">
                                N° Pedido
                            </small>

                            <div>
                                <span class="badge badge-primary"
                                      style="font-size: 14px;">
                                    <span id="numeroPedido"></span>
                                </span>
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <small class="text-muted">
                                Fecha
                            </small>

                            <div>
                                <i class="far fa-calendar-alt text-primary"></i>
                                <span id="fechaPedido"></span>
                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Estado
                            </small>

                            <div>
                                <span class="badge badge-success"
                                      style="font-size: 13px;"
                                      id="estadoPedido">
                                </span>
                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Total del pedido
                            </small>

                            <div class="font-weight-bold text-primary"
                                 style="font-size: 20px;">

                                Bs.
                                <span id="totalPedido">
                                    0.00
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================================
         PRODUCTOS
         ========================================================== --}}

    <div class="card card-info">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-box-open"></i>
                Productos del pedido
            </h3>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="bg-primary">

                        <tr>

                            <th>
                                Producto
                            </th>

                            <th class="text-center">
                                Talla
                            </th>

                            <th class="text-center">
                                Color
                            </th>

                            <th class="text-center">
                                Cantidad
                            </th>

                            <th class="text-right">
                                Precio unitario
                            </th>

                            <th class="text-right">
                                Subtotal
                            </th>

                        </tr>

                    </thead>

                    <tbody id="tablaProductos">
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- ==========================================================
     DATOS DE LA VENTA
     ========================================================== --}}

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fas fa-receipt"></i>
            Datos de la venta
        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            {{-- FECHA --}}

            <div class="col-md-6">

                <div class="form-group">

                    <label for="fecha_venta">
                        Fecha de venta
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>

                        <input type="date"
                               name="fecha_venta"
                               id="fecha_venta"
                               class="form-control"
                               value="{{ date('Y-m-d') }}"
                               required>

                    </div>

                </div>

            </div>


            {{-- TOTAL --}}

            <div class="col-md-6">

                <div class="form-group">

                    <label for="total">
                        Total de la venta
                    </label>

                    <div class="input-group input-group-lg">

                        <div class="input-group-prepend">

                            <span class="input-group-text">
                                Bs.
                            </span>

                        </div>

                        <input type="number"
                               step="0.01"
                               name="total"
                               id="total"
                               class="form-control text-right font-weight-bold"
                               placeholder="0.00"
                               readonly
                               required>

                    </div>

                    <small class="form-text text-muted">
                        El total se obtiene automáticamente del pedido seleccionado.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ==========================================================
     TOTAL DESTACADO
     ========================================================== --}}

<div class="card bg-primary">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h4 class="mb-1">
                    <i class="fas fa-money-bill-wave"></i>
                    TOTAL DE LA VENTA
                </h4>

                <p class="mb-0">
                    Monto total correspondiente al pedido seleccionado.
                </p>

            </div>

            <div class="col-md-4 text-md-right">

                <span style="font-size: 32px;
                             font-weight: bold;">

                    Bs.
                    <span id="totalDestacado">
                        0.00
                    </span>

                </span>

            </div>

        </div>

    </div>

</div>


{{-- ==========================================================
     BOTONES
     ========================================================== --}}

<div class="card">

    <div class="card-body text-right">

        <a href="{{ route('ventas.index') }}"
           class="btn btn-secondary btn-lg mr-2">

            <i class="fas fa-times"></i>
            Cancelar

        </a>


        <button type="submit"
                class="btn btn-primary btn-lg">

            <i class="fas fa-save"></i>
            Registrar Venta

        </button>

    </div>

</div>
```

</form>

{{-- ==============================================================
JAVASCRIPT
============================================================== --}}

<script>

    const pedidos = @json($pedidos);

    const selectPedido =
        document.getElementById('id_pedido');

    const informacionPedido =
        document.getElementById('informacionPedido');

    const clienteNombre =
        document.getElementById('clienteNombre');

    const clienteEmail =
        document.getElementById('clienteEmail');

    const clienteTelefono =
        document.getElementById('clienteTelefono');

    const clienteDireccion =
        document.getElementById('clienteDireccion');

    const numeroPedido =
        document.getElementById('numeroPedido');

    const fechaPedido =
        document.getElementById('fechaPedido');

    const estadoPedido =
        document.getElementById('estadoPedido');

    const totalPedido =
        document.getElementById('totalPedido');

    const total =
        document.getElementById('total');

    const totalDestacado =
        document.getElementById('totalDestacado');

    const tablaProductos =
        document.getElementById('tablaProductos');


    /*
    |--------------------------------------------------------------------------
    | CAMBIO DE PEDIDO
    |--------------------------------------------------------------------------
    */

    selectPedido.addEventListener('change', function () {

        const idPedido = this.value;


        /*
        |--------------------------------------------------------------------------
        | SI NO SE SELECCIONÓ NINGÚN PEDIDO
        |--------------------------------------------------------------------------
        */

        if (!idPedido) {

            informacionPedido.style.display = 'none';

            total.value = '';
            totalDestacado.textContent = '0.00';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | BUSCAR PEDIDO
        |--------------------------------------------------------------------------
        */

        const pedido = pedidos.find(
            p => p.id_pedido == idPedido
        );


        if (!pedido) {

            informacionPedido.style.display = 'none';

            total.value = '';
            totalDestacado.textContent = '0.00';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | MOSTRAR INFORMACIÓN
        |--------------------------------------------------------------------------
        */

        informacionPedido.style.display = 'block';


        numeroPedido.textContent =
            '#' + pedido.id_pedido;


        fechaPedido.textContent =
            pedido.fecha_pedido ?? 'No registrada';


        estadoPedido.textContent =
            pedido.estado ?? 'No registrado';


        /*
        |--------------------------------------------------------------------------
        | INFORMACIÓN DEL CLIENTE
        |--------------------------------------------------------------------------
        */

        const reserva = pedido.reserva;


        if (reserva && reserva.cliente) {

            clienteNombre.textContent =
                reserva.cliente.nombre ?? 'No registrado';

            clienteEmail.textContent =
                reserva.cliente.email ?? 'No registrado';

            clienteTelefono.textContent =
                reserva.cliente.telefono ?? 'No registrado';

            clienteDireccion.textContent =
                reserva.cliente.direccion ?? 'No registrada';

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


        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS
        |--------------------------------------------------------------------------
        */

        tablaProductos.innerHTML = '';


        if (
            reserva &&
            reserva.detalle_reservas &&
            reserva.detalle_reservas.length > 0
        ) {

            reserva.detalle_reservas.forEach(detalle => {

                const producto =
                    detalle.producto;


                const fila =
                    document.createElement('tr');


                const nombreProducto =
                    producto
                        ? producto.nombre
                        : 'Producto no encontrado';


                const talla =
                    producto
                        ? producto.talla
                        : '-';


                const color =
                    producto
                        ? producto.color
                        : '-';


                const cantidad =
                    detalle.cantidad ?? 0;


                const precio =
                    parseFloat(detalle.precio_unitario ?? 0)
                        .toFixed(2);


                const subtotal =
                    parseFloat(detalle.subtotal ?? 0)
                        .toFixed(2);


                fila.innerHTML = `

                    <td>
                        <i class="fas fa-box text-primary mr-1"></i>
                        ${nombreProducto}
                    </td>

                    <td class="text-center">
                        ${talla}
                    </td>

                    <td class="text-center">
                        ${color}
                    </td>

                    <td class="text-center font-weight-bold">
                        ${cantidad}
                    </td>

                    <td class="text-right">
                        Bs. ${precio}
                    </td>

                    <td class="text-right font-weight-bold">
                        Bs. ${subtotal}
                    </td>

                `;


                tablaProductos.appendChild(fila);

            });

        } else {

            tablaProductos.innerHTML = `

                <tr>

                    <td colspan="6"
                        class="text-center text-muted py-4">

                        <i class="fas fa-box-open fa-2x mb-2"></i>

                        <br>

                        Este pedido no tiene productos registrados.

                    </td>

                </tr>

            `;

        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        if (
            reserva &&
            reserva.total !== null &&
            reserva.total !== undefined
        ) {

            const monto =
                parseFloat(reserva.total).toFixed(2);


            totalPedido.textContent =
                monto;


            total.value =
                monto;


            totalDestacado.textContent =
                monto;

        } else {

            totalPedido.textContent =
                '0.00';

            total.value =
                '0.00';

            totalDestacado.textContent =
                '0.00';

        }

    });

</script>

@stop
