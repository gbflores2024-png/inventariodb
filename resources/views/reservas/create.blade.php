@extends('welcome')

@section('contenido')

<h2>Nueva Reserva</h2>

<form action="{{ route('reservas.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>Cliente</label>

        <select name="id_cliente"
                class="form-control">

            @foreach($clientes as $cliente)

                <option value="{{ $cliente->id_cliente }}">
                    {{ $cliente->nombre }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">
        <label>Fecha Reserva</label>

        <input type="date"
               name="fecha_reserva"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Estado</label>

        <input type="text"
               name="estado"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Total</label>

        <input type="number"
               step="0.01"
               name="total"
               class="form-control">
    </div>

    <button class="btn btn-primary">
        Guardar
    </button>

</form>

@endsection