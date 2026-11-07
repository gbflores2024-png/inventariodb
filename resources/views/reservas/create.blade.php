@extends('adminlte::page')

@section('title', 'Nueva Reserva')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <h1>
            <i class="fas fa-calendar-plus"></i>
            Nueva Reserva
        </h1>

    </div>

@stop


@section('content')


{{-- ============================================================
     MENSAJES DE ERROR
     ============================================================ --}}

@if ($errors->any())

    <div class="alert alert-danger">

        <button type="button"
                class="close"
                data-dismiss="alert">
            ×
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


{{-- ============================================================
     FORMULARIO
     ============================================================ --}}

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-shopping-basket"></i>

            Registrar nueva reserva

        </h3>

    </div>


    <form action="{{ route('reservas.store') }}"
          method="POST">

        @csrf


        <div class="card-body">


            {{-- =================================================
                 INFORMACIÓN GENERAL
                 ================================================= --}}

            <div class="card card-info">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-info-circle"></i>

                        Información de la reserva

                    </h3>

                </div>


                <div class="card-body">

                    <div class="row">


                        {{-- CLIENTE --}}

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="id_cliente">

                                    Cliente
                                    <span class="text-danger">*</span>

                                </label>


                                <select name="id_cliente"
                                        id="id_cliente"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- Seleccione un cliente --
                                    </option>


                                    @foreach($clientes as $cliente)

                                        <option value="{{ $cliente->id_cliente }}"
                                            {{ old('id_cliente') == $cliente->id_cliente ? 'selected' : '' }}>

                                            {{ $cliente->nombre }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- FECHA --}}

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="fecha_reserva">

                                    Fecha Reserva
                                    <span class="text-danger">*</span>

                                </label>


                                <input type="date"
                                       name="fecha_reserva"
                                       id="fecha_reserva"
                                       class="form-control"
                                       value="{{ old('fecha_reserva', date('Y-m-d')) }}"
                                       required>

                            </div>

                        </div>


                        {{-- ESTADO --}}

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="estado">

                                    Estado
                                    <span class="text-danger">*</span>

                                </label>


                                <select name="estado"
                                        id="estado"
                                        class="form-control"
                                        required>

                                    <option value="PENDIENTE">
                                        PENDIENTE
                                    </option>

                                    <option value="CONFIRMADA">
                                        CONFIRMADA
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PRODUCTOS
                 ================================================= --}}

            <div class="card card-success">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-box"></i>

                        Productos de la reserva

                    </h3>

                </div>


                <div class="card-body">


                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th style="width: 45%;">
                                        Producto
                                    </th>

                                    <th style="width: 15%;">
                                        Cantidad
                                    </th>

                                    <th style="width: 20%;">
                                        Precio
                                    </th>

                                    <th style="width: 20%;">
                                        Subtotal
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="productosContainer">

                                <tr class="producto-row">


                                    {{-- PRODUCTO --}}

                                    <td>

                                        <select name="productos[0][id_producto]"
                                                class="form-control producto-select"
                                                required>

                                            <option value="">
                                                -- Seleccione producto --
                                            </option>


                                            @foreach($productos as $producto)

                                                <option value="{{ $producto->id_producto }}"
                                                        data-precio="{{ $producto->precio }}">

                                                    {{ $producto->nombre }}

                                                    @if($producto->talla)
                                                        - Talla {{ $producto->talla }}
                                                    @endif

                                                    @if($producto->color)
                                                        - {{ $producto->color }}
                                                    @endif

                                                </option>

                                            @endforeach

                                        </select>

                                    </td>


                                    {{-- CANTIDAD --}}

                                    <td>

                                        <input type="number"
                                               name="productos[0][cantidad]"
                                               class="form-control cantidad"
                                               min="1"
                                               value="1"
                                               required>

                                    </td>


                                    {{-- PRECIO --}}

                                    <td>

                                        <span class="precio">
                                            Bs. 0.00
                                        </span>

                                    </td>


                                    {{-- SUBTOTAL --}}

                                    <td>

                                        <strong class="subtotal">
                                            Bs. 0.00
                                        </strong>

                                    </td>

                                </tr>

                            </tbody>


                            <tfoot>

                                <tr>

                                    <td colspan="3"
                                        class="text-right">

                                        <strong>
                                            TOTAL:
                                        </strong>

                                    </td>

                                    <td>

                                        <strong class="text-success"
                                                style="font-size: 20px;">

                                            Bs.
                                            <span id="totalVisual">
                                                0.00
                                            </span>

                                        </strong>

                                    </td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>


                    <button type="button"
                            id="agregarProducto"
                            class="btn btn-info">

                        <i class="fas fa-plus"></i>

                        Agregar otro producto

                    </button>

                </div>

            </div>


            {{-- =================================================
                 TOTAL OCULTO
                 ================================================= --}}

            <input type="hidden"
                   name="total"
                   id="total"
                   value="0">


        </div>


        {{-- =====================================================
             BOTONES
             ===================================================== --}}

        <div class="card-footer">


            <button type="submit"
                    class="btn btn-success">

                <i class="fas fa-save"></i>

                Guardar Reserva

            </button>


            <a href="{{ route('reservas.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Cancelar

            </a>

        </div>


    </form>

</div>


@stop



@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {


    let contador = 1;


    /*
    |--------------------------------------------------------------------------
    | CALCULAR TOTALES
    |--------------------------------------------------------------------------
    */

    function calcularTotales()
    {

        let totalGeneral = 0;


        document.querySelectorAll('.producto-row')
            .forEach(function (fila) {


                const select =
                    fila.querySelector('.producto-select');

                const cantidadInput =
                    fila.querySelector('.cantidad');

                const precioTexto =
                    fila.querySelector('.precio');

                const subtotalTexto =
                    fila.querySelector('.subtotal');


                if (!select || !cantidadInput)
                    return;


                const opcion =
                    select.options[select.selectedIndex];


                const precio =
                    parseFloat(
                        opcion.dataset.precio || 0
                    );


                const cantidad =
                    parseInt(
                        cantidadInput.value || 0
                    );


                const subtotal =
                    precio * cantidad;


                precioTexto.textContent =
                    'Bs. ' + precio.toFixed(2);


                subtotalTexto.textContent =
                    'Bs. ' + subtotal.toFixed(2);


                totalGeneral += subtotal;

            });


        document.getElementById('totalVisual')
            .textContent =
                totalGeneral.toFixed(2);


        document.getElementById('total')
            .value =
                totalGeneral.toFixed(2);

    }


    /*
    |--------------------------------------------------------------------------
    | CAMBIAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'change',
        function (event) {

            if (
                event.target.classList
                    .contains('producto-select')
            ) {

                calcularTotales();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CAMBIAR CANTIDAD
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'input',
        function (event) {

            if (
                event.target.classList
                    .contains('cantidad')
            ) {

                calcularTotales();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | AGREGAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    document.getElementById('agregarProducto')
        .addEventListener(
            'click',
            function () {


                const container =
                    document.getElementById(
                        'productosContainer'
                    );


                const fila =
                    document.createElement('tr');


                fila.classList.add(
                    'producto-row'
                );


                fila.innerHTML = `

                    <td>

                        <select
                            name="productos[${contador}][id_producto]"
                            class="form-control producto-select"
                            required>

                            <option value="">
                                -- Seleccione producto --
                            </option>

                            @foreach($productos as $producto)

                                <option
                                    value="{{ $producto->id_producto }}"
                                    data-precio="{{ $producto->precio }}">

                                    {{ $producto->nombre }}

                                    @if($producto->talla)
                                        - Talla {{ $producto->talla }}
                                    @endif

                                    @if($producto->color)
                                        - {{ $producto->color }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </td>


                    <td>

                        <input
                            type="number"
                            name="productos[${contador}][cantidad]"
                            class="form-control cantidad"
                            min="1"
                            value="1"
                            required>

                    </td>


                    <td>

                        <span class="precio">
                            Bs. 0.00
                        </span>

                    </td>


                    <td>

                        <strong class="subtotal">
                            Bs. 0.00
                        </strong>

                        <button
                            type="button"
                            class="btn btn-danger btn-sm float-right eliminarProducto">

                            <i class="fas fa-trash"></i>

                        </button>

                    </td>

                `;


                container.appendChild(fila);


                contador++;


            }
        );


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {


            const boton =
                event.target.closest(
                    '.eliminarProducto'
                );


            if (!boton)
                return;


            const filas =
                document.querySelectorAll(
                    '.producto-row'
                );


            if (filas.length <= 1) {

                alert(
                    'Debe existir al menos un producto.'
                );

                return;

            }


            boton.closest('tr').remove();


            calcularTotales();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CALCULAR AL CARGAR
    |--------------------------------------------------------------------------
    */

    calcularTotales();

});

</script>

@stop