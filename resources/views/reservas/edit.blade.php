@extends('welcome')

@section('contenido')

<h2>Editar Reserva</h2>

<form action="{{ route('reservas.update',$reserva->id_reserva) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Cliente</label>

        <select name="id_cliente"
                class="form-control">

            @foreach($clientes as $cliente)

                <option
                    value="{{ $cliente->id_cliente }}"
                    {{ $reserva->id_cliente == $cliente->id_cliente ? 'selected' : '' }}>

                    {{ $cliente->nombre }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Fecha Reserva</label>

        <input type="date"
               name="fecha_reserva"
               class="form-control"
               value="{{ $reserva->fecha_reserva }}">

    </div>

    <div class="mb-3">

        <label>Estado</label>

        <input type="text"
               name="estado"
               class="form-control"
               value="{{ $reserva->estado }}">

    </div>

    <div class="mb-3">

        <label>Total</label>

        <input type="number"
               step="0.01"
               name="total"
               class="form-control"
               value="{{ $reserva->total }}">

    </div>

    <button class="btn btn-primary">
        Actualizar
    </button>

</form>

@endsection