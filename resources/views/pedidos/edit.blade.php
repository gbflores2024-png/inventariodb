@extends('adminlte::page')

@section('title', 'Editar Pedido')

@section('content_header')
    <h1>Editar Pedido</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Modificar Pedido
        </h3>
    </div>

    <div class="card-body">

        <form action="{{ route('pedidos.update', $pedido->id_pedido) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label for="id_reserva">
                    Reserva
                </label>

                <select name="id_reserva"
                        id="id_reserva"
                        class="form-control">

                    @foreach($reservas as $reserva)

                        <option value="{{ $reserva->id_reserva }}"
                            {{ $pedido->id_reserva == $reserva->id_reserva ? 'selected' : '' }}>

                            {{ $reserva->id_reserva }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label for="fecha_pedido">
                    Fecha Pedido
                </label>

                <input type="date"
                       id="fecha_pedido"
                       name="fecha_pedido"
                       class="form-control"
                       value="{{ $pedido->fecha_pedido }}">

            </div>

            <div class="form-group">

                <label for="estado">
                    Estado
                </label>

                <input type="text"
                       id="estado"
                       name="estado"
                       class="form-control"
                       value="{{ $pedido->estado }}">

            </div>

            <br>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save"></i>
                Actualizar

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