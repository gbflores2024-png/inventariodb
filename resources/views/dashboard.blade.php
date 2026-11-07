@extends('adminlte::page')

@section('title', 'Panel Principal')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

<div>
    <h1 class="mb-1">
        <i class="fas fa-store text-primary"></i>
        Panel Principal
    </h1>

    <p class="text-muted mb-0">
        Sistema Web de Ventas y Devoluciones
    </p>
</div>

</div>

@stop

@section('content')

<div class="container-fluid">

{{-- ========================================================= --}}
{{-- BIENVENIDA --}}
{{-- ========================================================= --}}

<div class="card bienvenida-card">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    <i class="fas fa-hand-sparkles text-primary"></i>
                    ¡Bienvenido al sistema!
                </h2>

                <p class="text-muted mb-2">
                    Desde este panel puedes administrar la información
                    de la tienda, controlar el inventario y gestionar
                    las operaciones de ventas.
                </p>

                <p class="mb-0">
                    <strong>Sistema Web de Ventas y Devoluciones</strong>
                </p>

            </div>

            <div class="col-md-4 text-center">

                <i class="fas fa-store-alt icon-bienvenida"></i>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- RESUMEN GENERAL --}}
{{-- ========================================================= --}}

<div class="row">

    {{-- CATEGORÍAS --}}
    <div class="col-xl-3 col-md-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>{{ $categorias }}</h3>

                <p>Categorías</p>

            </div>

            <div class="icon">

                <i class="fas fa-tags"></i>

            </div>

            <a href="{{ route('categorias.index') }}"
               class="small-box-footer">

                Administrar categorías

                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>


    {{-- PRODUCTOS --}}
    <div class="col-xl-3 col-md-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>{{ $productos }}</h3>

                <p>Productos</p>

            </div>

            <div class="icon">

                <i class="fas fa-box"></i>

            </div>

            <a href="{{ route('productos.index') }}"
               class="small-box-footer">

                Administrar productos

                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>


    {{-- CLIENTES --}}
    <div class="col-xl-3 col-md-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>{{ $clientes }}</h3>

                <p>Clientes</p>

            </div>

            <div class="icon">

                <i class="fas fa-users"></i>

            </div>

            <a href="{{ route('clientes.index') }}"
               class="small-box-footer">

                Administrar clientes

                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>


    {{-- INVENTARIO --}}
    <div class="col-xl-3 col-md-6">

        <div class="small-box bg-primary">

            <div class="inner">

                <h3>{{ $inventarios }}</h3>

                <p>Registros de Inventario</p>

            </div>

            <div class="icon">

                <i class="fas fa-warehouse"></i>

            </div>

            <a href="{{ route('inventarios.index') }}"
               class="small-box-footer">

                Administrar inventario

                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- INCREMENTO 5: ESTADÍSTICAS Y KPIs --}}
{{-- ========================================================= --}}
<div class="card card-outline card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chart-line mr-2"></i>Estadísticas y KPIs</h3>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ([
                ['Ingresos por ventas', 'Bs ' . number_format($ingresosVentas, 2, ',', '.'), 'fa-coins', 'primary'],
                ['Ventas registradas', number_format($ventas), 'fa-cash-register', 'success'],
                ['Productos registrados', number_format($productos), 'fa-box', 'info'],
                ['Stock disponible (unidades)', number_format($stockDisponible), 'fa-boxes', 'success'],
                ['Stock reservado (unidades)', number_format($stockReservado), 'fa-bookmark', 'secondary'],
                ['Registros con stock bajo', number_format($stockBajo), 'fa-exclamation-triangle', 'warning'],
                ['Pedidos registrados', number_format($pedidos), 'fa-shopping-cart', 'info'],
                ['Devoluciones registradas', number_format($devoluciones), 'fa-undo', 'danger']
            ] as $kpi)
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border-left border-{{ $kpi[3] }} shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted small mb-2"><i class="fas {{ $kpi[2] }} mr-1"></i>{{ $kpi[0] }}</div>
                            <h4 class="mb-0 font-weight-bold">{{ $kpi[1] }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card card-outline card-info mb-0">
            <div class="card-header"><h3 class="card-title">Ventas mensuales (últimos 12 meses)</h3></div>
            <div class="card-body">
                <div style="height:300px"><canvas id="graficoVentasKpi" aria-label="Gráfico de ingresos por ventas mensuales"></canvas></div>
                <small class="text-muted">Importes brutos registrados en ventas; no se descuentan devoluciones.</small>
            </div>
        </div>
    </div>
</div>

{{-- ========================================================= --}}
{{-- INVENTARIO DINÁMICO --}}
{{-- ========================================================= --}}

<div class="row">

    <div class="col-12">

        <div class="card card-inventario">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-warehouse"></i>

                    Inventario Dinámico

                </h3>

            </div>


            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h3>
                            Control visual del inventario
                        </h3>

                        <p class="text-muted">

                            Consulta los productos mediante una vista
                            visual organizada por estantes y verifica
                            rápidamente el estado de su stock.

                        </p>


                        <div class="mt-3">

                            <span class="badge badge-success mr-2">
                                <i class="fas fa-check-circle"></i>
                                Stock OK
                            </span>

                            <span class="badge badge-warning mr-2">
                                <i class="fas fa-exclamation-triangle"></i>
                                Stock Bajo
                            </span>

                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle"></i>
                                Stock Crítico
                            </span>

                        </div>

                    </div>


                    <div class="col-md-4 text-center">

                        <i class="fas fa-th-large inventario-icon"></i>

                        <br>

                        <a href="{{ route('inventarios.dinamico') }}"
                           class="btn btn-primary btn-lg mt-3">

                            <i class="fas fa-eye"></i>

                            Ver Inventario Dinámico

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- MÓDULOS DEL SISTEMA --}}
{{-- ========================================================= --}}

<div class="row">


    {{-- PARAMETRIZACIÓN --}}
    <div class="col-lg-4">

        <div class="card card-modulo">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-cogs text-info"></i>

                    Parametrización

                </h3>

            </div>

            <div class="card-body">

                <p class="text-muted">
                    Administración de la información base del sistema.
                </p>


                <a href="{{ route('categorias.index') }}"
                   class="btn btn-outline-info btn-block">

                    <i class="fas fa-tags"></i>

                    Categorías

                </a>


                <a href="{{ route('productos.index') }}"
                   class="btn btn-outline-success btn-block">

                    <i class="fas fa-box"></i>

                    Productos

                </a>


                <a href="{{ route('clientes.index') }}"
                   class="btn btn-outline-warning btn-block">

                    <i class="fas fa-users"></i>

                    Clientes

                </a>

            </div>

        </div>

    </div>


    {{-- TRANSACCIONES --}}
    <div class="col-lg-4">

        <div class="card card-modulo">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-exchange-alt text-primary"></i>

                    Transacciones

                </h3>

            </div>

            <div class="card-body">

                <p class="text-muted">
                    Gestión de las operaciones realizadas en el sistema.
                </p>


                <a href="{{ route('ventas.index') }}"
                   class="btn btn-outline-primary btn-block">

                    <i class="fas fa-cash-register"></i>

                    Ventas

                </a>


                <a href="{{ route('pedidos.index') }}"
                   class="btn btn-outline-primary btn-block">

                    <i class="fas fa-shopping-cart"></i>

                    Pedidos

                </a>


                <a href="{{ route('reservas.index') }}"
                   class="btn btn-outline-primary btn-block">

                    <i class="fas fa-calendar-alt"></i>

                    Reservas

                </a>


                <a href="{{ route('devoluciones.index') }}"
                   class="btn btn-outline-danger btn-block">

                    <i class="fas fa-undo"></i>

                    Devoluciones

                </a>

            </div>

        </div>

    </div>


    {{-- ACCESO RÁPIDO --}}
    <div class="col-lg-4">

        <div class="card card-modulo">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-bolt text-warning"></i>

                    Accesos rápidos

                </h3>

            </div>

            <div class="card-body">


                <a href="{{ route('productos.create') }}"
                   class="btn btn-success btn-block">

                    <i class="fas fa-plus-circle"></i>

                    Registrar producto

                </a>


                <a href="{{ route('clientes.create') }}"
                   class="btn btn-warning btn-block">

                    <i class="fas fa-user-plus"></i>

                    Registrar cliente

                </a>


                <a href="{{ route('inventarios.create') }}"
                   class="btn btn-primary btn-block">

                    <i class="fas fa-boxes"></i>

                    Registrar inventario

                </a>


                <a href="{{ route('inventarios.dinamico') }}"
                   class="btn btn-dark btn-block">

                    <i class="fas fa-th-large"></i>

                    Ver estantes

                </a>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- INFORMACIÓN DEL SISTEMA --}}
{{-- ========================================================= --}}

<div class="card mt-3">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-info-circle"></i>

            Acerca del sistema

        </h3>

    </div>

    <div class="card-body">

        <p class="mb-2">

            <strong>Sistema Web de Ventas y Devoluciones</strong>

            está orientado a la administración de productos,
            inventario, clientes y operaciones comerciales.

        </p>

        <p class="mb-0 text-muted">

            Utilice el menú lateral o los accesos rápidos
            para navegar entre los diferentes módulos.

        </p>

    </div>

</div>


</div>

@stop

{{-- ============================================================= --}}
{{-- CSS --}}
{{-- ============================================================= --}}

@section('css')

<style>

    /*
    |--------------------------------------------------------------------------
    | BIENVENIDA
    |--------------------------------------------------------------------------
    */

    .bienvenida-card {

        border: none;

        border-radius: 12px;

        overflow: hidden;

        box-shadow: 0 4px 15px rgba(0,0,0,0.08);

    }


    .bienvenida-card h2 {

        font-weight: 600;

    }


    .icon-bienvenida {

        font-size: 100px;

        opacity: 0.15;

    }


    /*
    |--------------------------------------------------------------------------
    | INVENTARIO
    |--------------------------------------------------------------------------
    */

    .card-inventario {

        border-radius: 12px;

        border-top: 4px solid #007bff;

        box-shadow: 0 4px 15px rgba(0,0,0,0.08);

    }


    .inventario-icon {

        font-size: 85px;

        opacity: 0.20;

    }


    /*
    |--------------------------------------------------------------------------
    | MÓDULOS
    |--------------------------------------------------------------------------
    */

    .card-modulo {

        height: 100%;

        border-radius: 10px;

        box-shadow: 0 3px 12px rgba(0,0,0,0.08);

    }


    .card-modulo .card-header {

        background: white;

        border-bottom: 1px solid #eee;

    }


    .card-modulo .btn {

        margin-bottom: 8px;

    }


    /*
    |--------------------------------------------------------------------------
    | SMALL BOX
    |--------------------------------------------------------------------------
    */

    .small-box {

        border-radius: 10px;

        overflow: hidden;

        box-shadow: 0 3px 10px rgba(0,0,0,0.10);

        transition: all 0.2s ease;

    }


    .small-box:hover {

        transform: translateY(-3px);

        box-shadow: 0 6px 15px rgba(0,0,0,0.15);

    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media(max-width: 768px) {

        .icon-bienvenida {

            font-size: 60px;

            margin-top: 20px;

        }


        .inventario-icon {

            font-size: 60px;

        }

    }

</style>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.8/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('graficoVentasKpi');
    if (!canvas || typeof Chart === 'undefined') return;
    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: @json($mesesKpi),
            datasets: [{
                label: 'Ventas (Bs)',
                data: @json($importesKpi),
                backgroundColor: 'rgba(30, 64, 112, 0.75)',
                borderColor: '#1e4070',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } },
            plugins: { tooltip: { callbacks: { label: function(ctx) {
                return 'Bs ' + Number(ctx.parsed.y).toLocaleString('es-BO', {minimumFractionDigits:2, maximumFractionDigits:2});
            } } } }
        }
    });
});
</script>
@stop
