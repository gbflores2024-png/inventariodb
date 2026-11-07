@extends('adminlte::page')

@section('title', 'Editar Venta')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h1 class="mb-1">
                <i class="fas fa-edit text-primary"></i>
                Editar Venta
            </h1>

            <p class="text-muted mb-0">
                Modificar los datos de una venta registrada
            </p>

        </div>

        <a href="{{ route('ventas.index') }}"
           class="btn btn-outline-secondary">

            <i class="fas fa-arrow-left"></i>
            Volver a ventas

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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ==========================================================
         IDENTIFICACIÓN DE LA VENTA
         ========================================================== --}}

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-receipt"></i>

                Información de la venta

            </h3>

        </div>


        <div class="card-body">

            <div class="row">

                {{-- ID DE VENTA --}}

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            ID de venta
                        </label>

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text">
                                    <i class="fas fa-hashtag"></i>
                                </span>

                            </div>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $venta->id_venta }}"
                                   readonly>

                        </div>

                        <small class="text-muted">
                            Identificador automático de la venta.
                        </small>

                    </div>

                </div>


                {{-- PEDIDO --}}

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            Pedido asociado
                        </label>

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text">
                                    <i class="fas fa-file-invoice"></i>
                                </span>

                            </div>

                            <input type="text"
                                   class="form-control"
                                   value="Pedido #{{ $venta->id_pedido }}"
                                   readonly>

                        </div>

                        <small class="text-muted">
                            El pedido no se modifica desde una venta.
                        </small>

                    </div>

                </div>


                {{-- CLIENTE --}}

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            Cliente
                        </label>

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>

                            </div>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $venta->pedido->reserva->cliente->nombre ?? 'Cliente no registrado' }}"
                                   readonly>

                        </div>

                        <small class="text-muted">
                            El cliente pertenece al pedido asociado.
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================================
         INFORMACIÓN DEL PEDIDO
         ========================================================== --}}

    @if($venta->pedido)

        <div class="card card-info">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-shopping-cart"></i>

                    Información del pedido

                </h3>

            </div>


            <div class="card-body">

                <div class="row">

                    {{-- NÚMERO DE PEDIDO --}}

                    <div class="col-md-3">

                        <div class="description-block">

                            <span class="description-percentage text-primary">
                                <i class="fas fa-file-invoice"></i>
                            </span>

                            <h5 class="description-header">

                                #{{ $venta->pedido->id_pedido }}

                            </h5>

                            <span class="description-text">
                                PEDIDO
                            </span>

                        </div>

                    </div>


                    {{-- FECHA DEL PEDIDO --}}

                    <div class="col-md-3">

                        <div class="description-block">

                            <span class="description-percentage text-info">
                                <i class="far fa-calendar-alt"></i>
                            </span>

                            <h5 class="description-header">

                                {{ \Carbon\Carbon::parse($venta->pedido->fecha_pedido)->format('d/m/Y') }}

                            </h5>

                            <span class="description-text">
                                FECHA PEDIDO
                            </span>

                        </div>

                    </div>


                    {{-- ESTADO --}}

                    <div class="col-md-3">

                        <div class="description-block">

                            <span class="description-percentage text-success">
                                <i class="fas fa-check-circle"></i>
                            </span>

                            <h5 class="description-header">

                                {{ $venta->pedido->estado }}

                            </h5>

                            <span class="description-text">
                                ESTADO
                            </span>

                        </div>

                    </div>


                    {{-- TOTAL PEDIDO --}}

                    <div class="col-md-3">

                        <div class="description-block">

                            <span class="description-percentage text-primary">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>

                            <h5 class="description-header">

                                @if($venta->pedido->reserva)

                                    Bs.
                                    {{ number_format($venta->pedido->reserva->total, 2) }}

                                @else

                                    Bs. 0.00

                                @endif

                            </h5>

                            <span class="description-text">
                                TOTAL PEDIDO
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @endif


    {{-- ==========================================================
         INFORMACIÓN DEL CLIENTE
         ========================================================== --}}

    @if(
        $venta->pedido &&
        $venta->pedido->reserva &&
        $venta->pedido->reserva->cliente
    )

        @php

            $cliente = $venta->pedido->reserva->cliente;

        @endphp


        <div class="card card-secondary">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-user"></i>

                    Datos del cliente

                </h3>

            </div>


            <div class="card-body">

                <div class="row">

                    <div class="col-md-3">

                        <strong>
                            <i class="fas fa-user text-primary"></i>
                            Nombre
                        </strong>

                        <p class="mb-0">
                            {{ $cliente->nombre }}
                        </p>

                    </div>


                    <div class="col-md-3">

                        <strong>
                            <i class="fas fa-envelope text-primary"></i>
                            Email
                        </strong>

                        <p class="mb-0">

                            {{ $cliente->email ?? 'No registrado' }}

                        </p>

                    </div>


                    <div class="col-md-3">

                        <strong>
                            <i class="fas fa-phone text-primary"></i>
                            Teléfono
                        </strong>

                        <p class="mb-0">

                            {{ $cliente->telefono ?? 'No registrado' }}

                        </p>

                    </div>


                    <div class="col-md-3">

                        <strong>
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            Dirección
                        </strong>

                        <p class="mb-0">

                            {{ $cliente->direccion ?? 'No registrada' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

    @endif


    {{-- ==========================================================
         FORMULARIO DE EDICIÓN
         ========================================================== --}}

    <form action="{{ route('ventas.update', $venta->id_venta) }}"
      method="POST">

    @csrf

    @method('PUT')

    {{-- El pedido no se modifica, pero su ID debe enviarse al controlador --}}
    <input type="hidden"
           name="id_pedido"
           value="{{ $venta->id_pedido }}">


        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-edit"></i>

                    Datos que se pueden modificar

                </h3>

            </div>


            <div class="card-body">

                <div class="alert alert-info">

                    <i class="fas fa-info-circle"></i>

                    <strong>Importante:</strong>

                    El pedido y el cliente están asociados a esta venta
                    y no se modifican desde esta pantalla.

                    Solo puede modificar la fecha y el total de la venta.

                </div>


                <div class="row">

                    {{-- ==================================================
                         FECHA DE VENTA
                         ================================================== --}}

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
                                       value="{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('Y-m-d') }}"
                                       required>

                            </div>

                            <small class="form-text text-muted">

                                Puede corregir la fecha en caso de que
                                haya sido registrada incorrectamente.

                            </small>

                        </div>

                    </div>


                    {{-- ==================================================
                         TOTAL
                         ================================================== --}}

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="total">

                                Total de la venta

                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group input-group-lg">

                                <div class="input-group-prepend">

                                    <span class="input-group-text">
                                        Bs.
                                    </span>

                                </div>


                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="total"
                                       id="total"
                                       class="form-control text-right font-weight-bold"
                                       value="{{ number_format($venta->total, 2, '.', '') }}"
                                       required>

                            </div>

                            <small class="form-text text-muted">

                                Puede corregir el monto total de la venta
                                si fue registrado incorrectamente.

                            </small>

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                     RESUMEN DEL CAMBIO
                     ================================================== --}}

                <div class="row mt-3">

                    <div class="col-md-12">

                        <div class="card bg-light">

                            <div class="card-body">

                                <div class="row align-items-center">

                                    <div class="col-md-8">

                                        <h5 class="mb-1">

                                            <i class="fas fa-info-circle text-primary"></i>

                                            Venta #{{ $venta->id_venta }}

                                        </h5>

                                        <p class="text-muted mb-0">

                                            Pedido #{{ $venta->id_pedido }}

                                            @if(
                                                $venta->pedido &&
                                                $venta->pedido->reserva &&
                                                $venta->pedido->reserva->cliente
                                            )

                                                -

                                                {{ $venta->pedido->reserva->cliente->nombre }}

                                            @endif

                                        </p>

                                    </div>


                                    <div class="col-md-4 text-md-right">

                                        <small class="text-muted">
                                            Total actual
                                        </small>

                                        <h3 class="text-primary mb-0">

                                            Bs.
                                            {{ number_format($venta->total, 2) }}

                                        </h3>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ======================================================
                 BOTONES
                 ====================================================== --}}

            <div class="card-footer text-right">

                <a href="{{ route('ventas.index') }}"
                   class="btn btn-secondary btn-lg mr-2">

                    <i class="fas fa-times"></i>

                    Cancelar

                </a>


                <button type="submit"
                        class="btn btn-primary btn-lg">

                    <i class="fas fa-save"></i>

                    Actualizar Venta

                </button>

            </div>

        </div>

    </form>

@stop