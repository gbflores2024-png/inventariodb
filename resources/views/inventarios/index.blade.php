@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <h1>
            <i class="fas fa-boxes"></i>
            Inventario
        </h1>

    </div>

@stop


@section('content')


{{-- MENSAJE DE ÉXITO --}}

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="fas fa-check-circle"></i>

        {{ session('success') }}

        <button type="button"
                class="close"
                data-dismiss="alert">

            <span>&times;</span>

        </button>

    </div>

@endif


{{-- NUEVO: mostrar errores al intentar eliminar inventario --}}
@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show"
         role="alert">

        <i class="fas fa-exclamation-triangle"></i>

        {{ session('error') }}

        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Cerrar">

            <span aria-hidden="true">&times;</span>

        </button>

    </div>

@endif



{{-- TARJETAS DE RESUMEN --}}

<div class="row">


    {{-- TOTAL DE REGISTROS --}}

    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>
                    {{ $inventarios->count() }}
                </h3>

                <p>
                    Registros de Inventario
                </p>

            </div>

            <div class="icon">

                <i class="fas fa-boxes"></i>

            </div>

        </div>

    </div>



    {{-- STOCK DISPONIBLE --}}

    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>
                    {{ $inventarios->sum('stock_disponible') }}
                </h3>

                <p>
                    Unidades Disponibles
                </p>

            </div>

            <div class="icon">

                <i class="fas fa-check-circle"></i>

            </div>

        </div>

    </div>



    {{-- STOCK RESERVADO --}}

    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>
                    {{ $inventarios->sum('stock_reservado') }}
                </h3>

                <p>
                    Unidades Reservadas
                </p>

            </div>

            <div class="icon">

                <i class="fas fa-bookmark"></i>

            </div>

        </div>

    </div>



    {{-- STOCK BAJO --}}

    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>

                    {{ $inventarios->filter(function ($inventario) {

                        return $inventario->stock_disponible
                            <= $inventario->stock_minimo;

                    })->count() }}

                </h3>

                <p>
                    Stock Bajo / Crítico
                </p>

            </div>

            <div class="icon">

                <i class="fas fa-exclamation-triangle"></i>

            </div>

        </div>

    </div>

</div>



{{-- TABLA DE INVENTARIO --}}

<div class="card">


    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-warehouse"></i>

            Inventario registrado

        </h3>


        <div class="card-tools">

            <a href="{{ route('inventarios.create') }}"
               class="btn btn-success btn-sm">

                <i class="fas fa-plus"></i>

                Nuevo Inventario

            </a>

        </div>

    </div>



    <div class="card-body">
        
{{-- NUEVO: FILTROS DE INVENTARIO --}}
<div class="mb-3">

    <h5>
        <i class="fas fa-filter"></i>
        Filtrar inventarios
    </h5>

    <div class="btn-group" role="group">

        {{-- NUEVO: mostrar todos --}}
        <a href="{{ route('inventarios.index', ['tipo' => 'todos']) }}"
           class="btn {{ ($tipo ?? 'todos') === 'todos'
               ? 'btn-primary'
               : 'btn-outline-primary' }}">

            <i class="fas fa-list"></i>
            Todos

        </a>

        {{-- NUEVO: mostrar inventarios por variante --}}
        <a href="{{ route('inventarios.index', ['tipo' => 'variantes']) }}"
           class="btn {{ ($tipo ?? 'todos') === 'variantes'
               ? 'btn-success'
               : 'btn-outline-success' }}">

            <i class="fas fa-tags"></i>
            Por variantes

        </a>

        {{-- NUEVO: mostrar inventarios antiguos --}}
        <a href="{{ route('inventarios.index', ['tipo' => 'antiguos']) }}"
           class="btn {{ ($tipo ?? 'todos') === 'antiguos'
               ? 'btn-warning'
               : 'btn-outline-warning' }}">

            <i class="fas fa-history"></i>
            Antiguos

        </a>

    </div>

</div>
{{-- FIN DE FILTROS --}}


        @if($inventarios->count() > 0)


            <div class="table-responsive">


                <table class="table table-bordered table-hover">


                    <thead class="thead-dark">

                        <tr>

                            <th>ID</th>

                            <th>Producto</th>

                            <th>Talla</th>

                            <th>Color</th>

                            <th>Precio</th>

                            <th>Físico</th>

                            <th>Disponible</th>

                            <th>Reservado</th>

                            <th>Mínimo</th>

                            <th>Estado</th>

                            <th>Fecha</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>



                    <tbody>


                        @foreach($inventarios as $inventario)


                            <tr>


                                {{-- ID --}}

                                <td>

                                    {{ $inventario->id_inventario }}

                                </td>



                                {{-- PRODUCTO --}}

                                <td>

                                    <strong>

                                        {{ $inventario->producto->nombre ?? 'Sin producto' }}

                                    </strong>

                                </td>



                                {{-- TALLA --}}

                                <td>

                                    @if($inventario->variante)

                                        <span class="badge badge-info">

                                            {{ $inventario->variante->talla }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>



                                {{-- COLOR --}}

                                <td>

                                    @if($inventario->variante)

                                        {{ $inventario->variante->color }}

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>



                                {{-- PRECIO --}}

                                <td>

                                    @if($inventario->variante)

                                        Bs.
                                        {{ number_format($inventario->variante->precio, 2) }}

                                    @else

                                        —

                                    @endif

                                </td>



                                {{-- FÍSICO --}}

                                <td>

                                    {{ $inventario->inventario_fisico }}

                                </td>



                                {{-- DISPONIBLE --}}

                                <td>

                                    <strong>

                                        {{ $inventario->stock_disponible }}

                                    </strong>

                                </td>



                                {{-- RESERVADO --}}

                                <td>

                                    {{ $inventario->stock_reservado }}

                                </td>



                                {{-- MÍNIMO --}}

                                <td>

                                    {{ $inventario->stock_minimo }}

                                </td>



                                {{-- ESTADO --}}

                                <td>


                                    @if($inventario->stock_disponible == 0)

                                        <span class="badge badge-danger">

                                            <i class="fas fa-times-circle"></i>

                                            SIN STOCK

                                        </span>


                                    @elseif($inventario->stock_disponible <= $inventario->stock_minimo)

                                        <span class="badge badge-warning">

                                            <i class="fas fa-exclamation-triangle"></i>

                                            STOCK BAJO

                                        </span>


                                    @else

                                        <span class="badge badge-success">

                                            <i class="fas fa-check-circle"></i>

                                            STOCK OK

                                        </span>

                                    @endif


                                </td>



                                {{-- FECHA --}}

                                <td>

                                    {{ $inventario->fecha_actualizacion }}

                                </td>



                                {{-- ACCIONES --}}

                                <td>

                                    <a href="{{ route('inventarios.edit', $inventario->id_inventario) }}"
                                       class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                        Editar

                                    </a>


                                   
                                {{-- MODIFICADO: impedir eliminación desde la interfaz --}}
                                <button type="button"
                                        class="btn btn-secondary btn-sm mt-1"
                                        disabled
                                        title="Eliminación temporalmente restringida">

                                    <i class="fas fa-lock"></i>
                                    Eliminación restringida

                                </button>

                                </td>

                            </tr>


                        @endforeach


                    </tbody>


                </table>

            </div>


        @else


            <div class="text-center py-5">

                <i class="fas fa-box-open fa-4x text-muted mb-3"></i>

                <h4>

                    No hay inventarios registrados

                </h4>

                <p class="text-muted">

                    Todavía no existen registros de inventario.

                </p>


                <a href="{{ route('inventarios.create') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus"></i>

                    Registrar inventario

                </a>

            </div>


        @endif


    </div>

</div>


@stop