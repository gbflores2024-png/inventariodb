@extends('welcome')

@section('contenido')

<h2>Nuevo Pedido</h2>

<form action="{{ route('pedidos.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>Reserva</label>

        <select name="id_reserva"
                class="form-control">

            @foreach($reservas as $reserva)

            <option value="{{ $reserva->id_reserva }}">
                {{ $reserva->id_reserva }}
            </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Fecha Pedido</label>

        <input type="date"
               name="fecha_pedido"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Estado</label>

        <input type="text"
               name="estado"
               class="form-control">

    </div>

    <button class="btn btn-success">
        Guardar
    </button>

</form>

@endsection