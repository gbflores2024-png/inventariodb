@extends('adminlte::page')

@section('title', 'Nuevo Pedido')

@section('content_header')
    <h1>Nuevo Pedido</h1>
@stop

@section('content')

{{-- Mensajes de error --}}
@if ($errors->any())

    <div class="alert alert-danger">

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


<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-shopping-cart"></i>

            Registrar nuevo pedido

        </h3>

    </div>


    <div class="card-body">

        <form action="{{ route('pedidos.store') }}"
              method="POST">

            @csrf


            {{-- =====================================================
                 RESERVA
                 ===================================================== --}}

            <div class="form-group">

                <label for="id_reserva">

                    <i class="fas fa-calendar-check"></i>

                    Reserva <span class="text-danger">*</span>

                </label>

                <select name="id_reserva"
                        id="id_reserva"
                        class="form-control"
                        required>

                    <option value="">
                        -- Seleccione una reserva --
                    </option>


                    @foreach($reservas as $reserva)

                        <option value="{{ $reserva->id_reserva }}">

                            Reserva #{{ $reserva->id_reserva }}

                            -

                            {{ $reserva->cliente->nombre ?? 'Cliente no registrado' }}

                            -

                            Bs. {{ number_format($reserva->total, 2) }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- =====================================================
                 FECHA
                 ===================================================== --}}

            <div class="form-group">

                <label for="fecha_pedido">

                    <i class="fas fa-calendar"></i>

                    Fecha del pedido
                    <span class="text-danger">*</span>

                </label>

                <input type="date"
                       id="fecha_pedido"
                       name="fecha_pedido"
                       class="form-control"
                       value="{{ old('fecha_pedido', date('Y-m-d')) }}"
                       required>

            </div>


            {{-- =====================================================
                 ESTADO
                 ===================================================== --}}

            <div class="form-group">

                <label for="estado">

                    <i class="fas fa-tasks"></i>

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

                    <option value="PREPARANDO"
                        {{ old('estado') == 'PREPARANDO' ? 'selected' : '' }}>

                        PREPARANDO

                    </option>

                    <option value="LISTO_RECOJO"
                        {{ old('estado') == 'LISTO_RECOJO' ? 'selected' : '' }}>

                        LISTO PARA RECOJO

                    </option>

                    <option value="ENTREGADO"
                        {{ old('estado') == 'ENTREGADO' ? 'selected' : '' }}>

                        ENTREGADO

                    </option>

                    <option value="CANCELADO"
                        {{ old('estado') == 'CANCELADO' ? 'selected' : '' }}>

                        CANCELADO

                    </option>

                </select>

            </div>


            <hr>


            {{-- =====================================================
                 BOTONES
                 ===================================================== --}}

            <button type="submit"
                    class="btn btn-success">

                <i class="fas fa-save"></i>

                Guardar Pedido

            </button>


            <a href="{{ route('pedidos.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop