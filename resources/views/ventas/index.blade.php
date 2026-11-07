@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <div>
            <h1 class="mb-1">
                <i class="fas fa-cash-register text-primary"></i>
                Ventas
            </h1>

            <p class="text-muted mb-0">
                Gestión y registro de ventas realizadas
            </p>
        </div>

        <a href="{{ route('ventas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Nueva Venta
        </a>

    </div>

@stop


@section('content')

    {{-- ==========================================================
         MENSAJE DE ÉXITO
         ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

            <i class="fas fa-check-circle"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- ==========================================================
         TARJETAS DE RESUMEN
         ========================================================== --}}

    @php

        $cantidadVentas = $ventas->count();

        $montoTotal = $ventas->sum('total');

        $pedidosVendidos = $ventas
            ->pluck('id_pedido')
            ->unique()
            ->count();

    @endphp


    <div class="row">

        {{-- TOTAL DE VENTAS --}}

        <div class="col-lg-4 col-md-6">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>
                        {{ $cantidadVentas }}
                    </h3>

                    <p>
                        Ventas registradas
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>

                <span class="small-box-footer">
                    Registro de ventas
                </span>

            </div>

        </div>


        {{-- MONTO TOTAL --}}

        <div class="col-lg-4 col-md-6">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3 style="font-size: 30px;">
                        Bs. {{ number_format($montoTotal, 2) }}
                    </h3>

                    <p>
                        Monto total vendido
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>

                <span class="small-box-footer">
                    Total acumulado
                </span>

            </div>

        </div>


        {{-- PEDIDOS VENDIDOS --}}

        <div class="col-lg-4 col-md-6">

            <div class="small-box bg-secondary">

                <div class="inner">

                    <h3>
                        {{ $pedidosVendidos }}
                    </h3>

                    <p>
                        Pedidos vendidos
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-file-invoice"></i>
                </div>

                <span class="small-box-footer">
                    Pedidos asociados
                </span>

            </div>

        </div>

    </div>


    {{-- ==========================================================
         TABLA DE VENTAS
         ========================================================== --}}

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-list"></i>

                Ventas registradas

            </h3>

        </div>


        <div class="card-body">

            @if($ventas->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="bg-primary">

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Pedido
                                </th>

                                <th>
                                    Cliente
                                </th>

                                <th>
                                    Fecha de venta
                                </th>

                                <th class="text-right">
                                    Total
                                </th>

                                <th class="text-center">
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($ventas as $venta)

                                <tr>

                                    {{-- ID --}}

                                    <td>

                                        <span class="badge badge-secondary">

                                            #{{ $venta->id_venta }}

                                        </span>

                                    </td>


                                    {{-- PEDIDO --}}

                                    <td>

                                        <span class="badge badge-primary">

                                            Pedido #{{ $venta->id_pedido }}

                                        </span>

                                    </td>


                                    {{-- CLIENTE --}}

                                    <td>

                                        @if(
                                            $venta->pedido &&
                                            $venta->pedido->reserva &&
                                            $venta->pedido->reserva->cliente
                                        )

                                            <i class="fas fa-user text-primary mr-1"></i>

                                            {{ $venta->pedido->reserva->cliente->nombre }}

                                        @else

                                            <span class="text-muted">
                                                Cliente no registrado
                                            </span>

                                        @endif

                                    </td>


                                    {{-- FECHA --}}

                                    <td>

                                        <i class="far fa-calendar-alt text-primary mr-1"></i>

                                        {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}

                                    </td>


                                    {{-- TOTAL --}}

                                    <td class="text-right">

                                        <strong class="text-primary">

                                            Bs.
                                            {{ number_format($venta->total, 2) }}

                                        </strong>

                                    </td>


                                    {{-- ACCIONES --}}

                                    <td class="text-center">

                                        {{-- EDITAR --}}

                                        <a href="{{ route('ventas.edit', $venta->id_venta) }}"
                                           class="btn btn-warning btn-sm"
                                           title="Editar venta">

                                            <i class="fas fa-edit"></i>

                                        </a>


                                        {{-- ELIMINAR --}}

                                        <form action="{{ route('ventas.destroy', $venta->id_venta) }}"
                                              method="POST"
                                              style="display:inline"
                                              class="form-eliminar">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    title="Eliminar venta">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- ==================================================
                     SIN VENTAS
                     ================================================== --}}

                <div class="text-center py-5">

                    <i class="fas fa-cash-register fa-4x text-muted mb-3"></i>

                    <h4>
                        No existen ventas registradas
                    </h4>

                    <p class="text-muted">
                        Registra tu primera venta para comenzar.
                    </p>

                    <a href="{{ route('ventas.create') }}"
                       class="btn btn-primary">

                        <i class="fas fa-plus"></i>

                        Registrar primera venta

                    </a>

                </div>

            @endif

        </div>

    </div>


    {{-- ==========================================================
         JAVASCRIPT
         ========================================================== --}}

    <script>

        document.querySelectorAll('.form-eliminar').forEach(function(form) {

            form.addEventListener('submit', function(event) {

                const confirmar = confirm(
                    '¿Está seguro de eliminar esta venta?'
                );

                if (!confirmar) {

                    event.preventDefault();

                }

            });

        });

    </script>

@stop