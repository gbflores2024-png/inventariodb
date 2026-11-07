@extends('adminlte::page')

@section('title', 'Inventario Dinámico')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <div>
        <h1>
            <i class="fas fa-warehouse text-primary"></i>
            Inventario Dinámico
        </h1>

        <p class="text-muted mb-0">
            Gestión visual del inventario por estantes
        </p>
    </div>

    <div>
        <a href="{{ route('inventarios.index') }}"
           class="btn btn-secondary">
            <i class="fas fa-list"></i>
            Lista de Inventario
        </a>
    </div>

</div>

@stop


@section('content')

{{-- ========================================================= --}}
{{-- ESTADÍSTICAS --}}
{{-- ========================================================= --}}

<div class="row">

    {{-- TOTAL PRODUCTOS --}}
    <div class="col-md-3">
        <div class="small-box bg-info">

            <div class="inner">
                <h3>{{ $totalProductos }}</h3>

                <p>Registros de Inventario</p>
            </div>

            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>

        </div>
    </div>


    {{-- DISPONIBLE --}}
    <div class="col-md-3">
        <div class="small-box bg-success">

            <div class="inner">
                <h3>{{ $stockDisponible }}</h3>

                <p>Unidades Disponibles</p>
            </div>

            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>

        </div>
    </div>


    {{-- RESERVADO --}}
    <div class="col-md-3">
        <div class="small-box bg-warning">

            <div class="inner">
                <h3>{{ $stockReservado }}</h3>

                <p>Unidades Reservadas</p>
            </div>

            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>

        </div>
    </div>


    {{-- STOCK BAJO --}}
    <div class="col-md-3">
        <div class="small-box bg-danger">

            <div class="inner">
                <h3>{{ $stockBajo }}</h3>

                <p>Stock Bajo / Crítico</p>
            </div>

            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

        </div>
    </div>

</div>


{{-- ========================================================= --}}
{{-- FILTROS --}}
{{-- ========================================================= --}}

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fas fa-filter"></i>
            Filtros rápidos
        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-5">

                <label>
                    <i class="fas fa-search"></i>
                    Buscar producto
                </label>

                <input type="text"
                       id="buscarProducto"
                       class="form-control"
                       placeholder="Ej: Jean Slim Fit">

            </div>


            <div class="col-md-4">

                <label>
                    Estado del stock
                </label>

                <select id="filtroEstado"
                        class="form-control">

                    <option value="todos">
                        Todos los estados
                    </option>

                    <option value="ok">
                        🟢 Stock OK
                    </option>

                    <option value="bajo">
                        🟡 Stock Bajo
                    </option>

                    <option value="critico">
                        🔴 Stock Crítico
                    </option>

                    <option value="sin">
                        ⚪ Sin Producto
                    </option>

                </select>

            </div>


            <div class="col-md-3 d-flex align-items-end">

                <button type="button"
                        id="limpiarFiltros"
                        class="btn btn-secondary btn-block">

                    <i class="fas fa-undo"></i>
                    Limpiar filtros

                </button>

            </div>

        </div>
            
{{-- NUEVO: FILTROS POR PRODUCTO, TALLA Y COLOR --}}
<hr>

<form method="GET"
      action="{{ route('inventarios.dinamico') }}">

    <div class="row">

        {{-- NUEVO: FILTRO POR PRODUCTO --}}
        <div class="col-md-4">

            <label>
                <i class="fas fa-tshirt"></i>
                Producto
            </label>

            <select name="id_producto"
                    class="form-control">

                <option value="">
                    Todos los productos
                </option>

                @foreach($productos as $producto)

                    <option value="{{ $producto->id_producto }}"
                        {{ request('id_producto') == $producto->id_producto
                            ? 'selected' : '' }}>

                        {{ $producto->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- NUEVO: FILTRO POR TALLA --}}
        <div class="col-md-4">

            <label>
                <i class="fas fa-ruler"></i>
                Talla
            </label>

            <select name="id_talla"
                    class="form-control">

                <option value="">
                    Todas las tallas
                </option>

                @foreach($tallas as $talla)

                    <option value="{{ $talla->id_talla }}"
                        {{ request('id_talla') == $talla->id_talla
                            ? 'selected' : '' }}>

                        {{ $talla->grupo }} -
                        {{ $talla->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- NUEVO: FILTRO POR COLOR --}}
        <div class="col-md-4">

            <label>
                <i class="fas fa-palette"></i>
                Color
            </label>

            <select name="id_color"
                    class="form-control">

                <option value="">
                    Todos los colores
                </option>

                @foreach($colores as $color)

                    <option value="{{ $color->id_color }}"
                        {{ request('id_color') == $color->id_color
                            ? 'selected' : '' }}>

                        {{ $color->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

    </div>

    {{-- NUEVO: BOTONES --}}
    <div class="mt-3">

        <button type="submit"
                class="btn btn-primary">

            <i class="fas fa-search"></i>
            Aplicar filtros

        </button>

        <a href="{{ url()->current() }}"
           class="btn btn-outline-secondary">

            <i class="fas fa-eraser"></i>
            Restablecer selección

        </a>

    </div>

</form>
{{-- FIN DE FILTROS NUEVOS --}}

    </div>

</div>


{{-- ========================================================= --}}
{{-- INVENTARIO VISUAL --}}
{{-- ========================================================= --}}

<div class="card">

    <div class="card-header bg-dark text-white">

        <h3 class="card-title">
            <i class="fas fa-th-large"></i>
            Almacén - Vista de Estantes
        </h3>

    </div>


    <div class="card-body inventario-area">


        {{-- ================================================= --}}
        {{-- ESTANTE A --}}
        {{-- ================================================= --}}

        <div class="estante-container">

            <div class="estante-titulo">
                ESTANTE A
            </div>

            <div class="estante">

                @for($slot = 0; $slot < 4; $slot++)

                    @php

                        $inventario = null;

                        foreach($inventarios as $indice => $item) {

                            if($indice == $slot) {
                                $inventario = $item;
                                break;
                            }

                        }

                    @endphp


                    @if($inventario)

                        @include('inventarios.partials.tarjeta', [
                            'inventario' => $inventario
                        ])

                    @else

                        <div class="tarjeta-vacia">

                            <div class="vacio-icon">
                                <i class="fas fa-box-open"></i>
                            </div>

                            <h5>Espacio vacío</h5>

                            <span class="badge badge-secondary">
                                Sin producto
                            </span>

                            <div class="vacio-texto">
                                Disponible: 0
                            </div>

                        </div>

                    @endif

                @endfor

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- ESTANTE B --}}
        {{-- ================================================= --}}

        <div class="estante-container">

            <div class="estante-titulo">
                ESTANTE B
            </div>

            <div class="estante">

                @for($slot = 0; $slot < 4; $slot++)

                    @php

                        $posicion = $slot + 4;

                        $inventario = null;

                        foreach($inventarios as $indice => $item) {

                            if($indice == $posicion) {
                                $inventario = $item;
                                break;
                            }

                        }

                    @endphp


                    @if($inventario)

                        @include('inventarios.partials.tarjeta', [
                            'inventario' => $inventario
                        ])

                    @else

                        <div class="tarjeta-vacia">

                            <div class="vacio-icon">
                                <i class="fas fa-box-open"></i>
                            </div>

                            <h5>Espacio vacío</h5>

                            <span class="badge badge-secondary">
                                Sin producto
                            </span>

                            <div class="vacio-texto">
                                Disponible: 0
                            </div>

                        </div>

                    @endif

                @endfor

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- ESTANTE C --}}
        {{-- ================================================= --}}

        <div class="estante-container">

            <div class="estante-titulo">
                ESTANTE C
            </div>

            <div class="estante">

                @for($slot = 0; $slot < 4; $slot++)

                    @php

                        $posicion = $slot + 8;

                        $inventario = null;

                        foreach($inventarios as $indice => $item) {

                            if($indice == $posicion) {
                                $inventario = $item;
                                break;
                            }

                        }

                    @endphp


                    @if($inventario)

                        @include('inventarios.partials.tarjeta', [
                            'inventario' => $inventario
                        ])

                    @else

                        <div class="tarjeta-vacia">

                            <div class="vacio-icon">
                                <i class="fas fa-box-open"></i>
                            </div>

                            <h5>Espacio vacío</h5>

                            <span class="badge badge-secondary">
                                Sin producto
                            </span>

                            <div class="vacio-texto">
                                Disponible: 0
                            </div>

                        </div>

                    @endif

                @endfor

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- LEYENDA --}}
{{-- ========================================================= --}}

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fas fa-info-circle"></i>
            Leyenda de Estados
        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-3">

                <span class="estado-circulo estado-verde"></span>

                <strong>Stock OK</strong>

                <br>

                <small class="text-muted">
                    Disponible mayor al mínimo
                </small>

            </div>


            <div class="col-md-3">

                <span class="estado-circulo estado-amarillo"></span>

                <strong>Stock Bajo</strong>

                <br>

                <small class="text-muted">
                    Disponible próximo al mínimo
                </small>

            </div>


            <div class="col-md-3">

                <span class="estado-circulo estado-rojo"></span>

                <strong>Stock Crítico</strong>

                <br>

                <small class="text-muted">
                    Disponible por debajo del mínimo
                </small>

            </div>


            <div class="col-md-3">

                <span class="estado-circulo estado-gris"></span>

                <strong>Sin Producto</strong>

                <br>

                <small class="text-muted">
                    Espacio disponible
                </small>

            </div>

        </div>

    </div>

</div>


@stop


{{-- ========================================================= --}}
{{-- CSS --}}
{{-- ========================================================= --}}

@section('css')

<style>

    /* AREA GENERAL */

    .inventario-area {
        background: #f4f6f9;
        padding: 25px;
    }


    /* ESTANTES */

    .estante-container {
        margin-bottom: 35px;
        position: relative;
    }


    .estante-titulo {
        background: #343a40;
        color: white;
        font-size: 18px;
        font-weight: bold;
        padding: 12px 20px;
        width: 150px;
        text-align: center;
        border-radius: 8px 8px 0 0;
        margin-bottom: 5px;
    }


    .estante {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;

        background: linear-gradient(
            to bottom,
            #d6d8db,
            #adb5bd
        );

        border: 10px solid #495057;
        border-top-width: 8px;
        border-bottom-width: 15px;

        padding: 20px;

        min-height: 290px;

        border-radius: 5px;

        box-shadow:
            inset 0 0 20px rgba(0,0,0,0.20),
            0 5px 10px rgba(0,0,0,0.15);
    }


    /* TARJETAS */

    .tarjeta-inventario {

        background: white;

        border-radius: 8px;

        padding: 15px;

        min-height: 240px;

        box-shadow:
            0 3px 8px rgba(0,0,0,0.20);

        transition: all 0.25s ease;

        cursor: pointer;

        position: relative;

        overflow: hidden;
    }


    .tarjeta-inventario:hover {

        transform: translateY(-5px);

        box-shadow:
            0 8px 18px rgba(0,0,0,0.25);
    }


    .producto-icono {

        width: 85px;
        height: 85px;

        border-radius: 50%;

        background: #e9ecef;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 10px auto;

        font-size: 40px;

        color: #495057;
    }


    .producto-nombre {

        text-align: center;

        font-size: 17px;

        font-weight: bold;

        min-height: 42px;

        margin-bottom: 5px;
    }


    .producto-variante {

        text-align: center;

        font-size: 13px;

        color: #6c757d;

        margin-bottom: 10px;
    }


    .estado-badge {

        display: block;

        width: fit-content;

        margin: auto;

        padding: 5px 12px;

        border-radius: 20px;

        font-size: 12px;

        font-weight: bold;
    }


    .estado-ok {

        background: #d4edda;

        color: #155724;
    }


    .estado-bajo {

        background: #fff3cd;

        color: #856404;
    }


    .estado-critico {

        background: #f8d7da;

        color: #721c24;
    }


    .datos-stock {

        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 5px;

        margin-top: 12px;

        font-size: 13px;
    }


    .dato-stock {

        background: #f8f9fa;

        padding: 6px;

        border-radius: 4px;

        text-align: center;
    }


    .dato-stock strong {

        display: block;

        font-size: 16px;
    }


    /* TARJETA VACIA */

    .tarjeta-vacia {

        background: rgba(255,255,255,0.65);

        border: 2px dashed #adb5bd;

        border-radius: 8px;

        min-height: 240px;

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        color: #6c757d;

        text-align: center;
    }


    .vacio-icon {

        font-size: 45px;

        margin-bottom: 10px;

        color: #adb5bd;
    }


    .vacio-texto {

        margin-top: 10px;

        font-size: 13px;
    }


    /* CIRCULOS DE ESTADO */

    .estado-circulo {

        display: inline-block;

        width: 14px;

        height: 14px;

        border-radius: 50%;

        margin-right: 5px;
    }


    .estado-verde {
        background: #28a745;
    }


    .estado-amarillo {
        background: #ffc107;
    }


    .estado-rojo {
        background: #dc3545;
    }


    .estado-gris {
        background: #6c757d;
    }


    /* RESPONSIVE */

    @media(max-width: 992px) {

        .estante {

            grid-template-columns:
                repeat(2, 1fr);

        }

    }


    @media(max-width: 576px) {

        .estante {

            grid-template-columns:
                1fr;

        }

    }

</style>

@stop


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

@section('js')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const buscar =
            document.getElementById('buscarProducto');

        const filtro =
            document.getElementById('filtroEstado');

        const limpiar =
            document.getElementById('limpiarFiltros');

        const tarjetas =
            document.querySelectorAll('.tarjeta-inventario');


        function aplicarFiltros() {

            const texto =
                buscar.value.toLowerCase().trim();

            const estado =
                filtro.value;


            tarjetas.forEach(function (tarjeta) {

                const nombre =
                    tarjeta.dataset.nombre.toLowerCase();

                const estadoTarjeta =
                    tarjeta.dataset.estado;


                const coincideNombre =
                    nombre.includes(texto);


                const coincideEstado =
                    estado === 'todos'
                    ||
                    estadoTarjeta === estado;


                if (coincideNombre && coincideEstado) {

                    tarjeta.style.display = '';

                } else {

                    tarjeta.style.display = 'none';

                }

            });

        }


        buscar.addEventListener(
            'keyup',
            aplicarFiltros
        );


        filtro.addEventListener(
            'change',
            aplicarFiltros
        );


        limpiar.addEventListener(
            'click',
            function () {

                buscar.value = '';

                filtro.value = 'todos';

                tarjetas.forEach(function (tarjeta) {

                    tarjeta.style.display = '';

                });

            }
        );


        /* CLICK SOBRE PRODUCTO */

        tarjetas.forEach(function (tarjeta) {

            tarjeta.addEventListener(
                'click',
                function () {

                    const nombre =
                        tarjeta.dataset.nombre;

                    const disponible =
                        tarjeta.dataset.disponible;

                    const reservado =
                        tarjeta.dataset.reservado;

                    const minimo =
                        tarjeta.dataset.minimo;


                    alert(
                        'PRODUCTO: ' + nombre +
                        '\n\n' +
                        'Disponible: ' + disponible +
                        ' unidades\n' +
                        'Reservado: ' + reservado +
                        ' unidades\n' +
                        'Stock mínimo: ' + minimo +
                        ' unidades'
                    );

                }
            );

        });

    });

</script>

@stop