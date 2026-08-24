@extends('welcome')

@section('contenido')

<h2>Editar Pedido</h2>

<form action="{{ route('pedidos.update',$pedido->id_pedido) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Reserva</label>

        <select name="id_reserva"
                class="form-control">

            @foreach($reservas as $reserva)

            <option value="{{ $reserva->id_reserva }}"
                {{ $pedido->id_reserva == $reserva->id_reserva ? 'selected' : '' }}>

                {{ $reserva->id_reserva }}

            </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Fecha Pedido</label>

        <input type="date"
               name="fecha_pedido"
               class="form-control"
               value="{{ $pedido->fecha_pedido }}">

    </div>

    <div class="mb-3">

        <label>Estado</label>

        <input type="text"
               name="estado"
               class="form-control"
               value="{{ $pedido->estado }}">

    </div>

    <button class="btn btn-primary">
        Actualizar
    </button>

</form>

@endsection