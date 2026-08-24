@extends('welcome')

@section('contenido')

<h2>Nueva Venta</h2>

<form action="{{ route('ventas.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>Pedido</label>

        <select name="id_pedido"
                class="form-control">

            @foreach($pedidos as $pedido)

            <option value="{{ $pedido->id_pedido }}">
                {{ $pedido->id_pedido }}
            </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Fecha Venta</label>

        <input type="date"
               name="fecha_venta"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Total</label>

        <input type="number"
               step="0.01"
               name="total"
               class="form-control">

    </div>

    <button class="btn btn-success">
        Guardar
    </button>

</form>

@endsection