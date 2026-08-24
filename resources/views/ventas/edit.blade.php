@extends('welcome')

@section('contenido')

<h2>Editar Venta</h2>

<form action="{{ route('ventas.update',$venta->id_venta) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Pedido</label>

        <select name="id_pedido"
                class="form-control">

            @foreach($pedidos as $pedido)

            <option value="{{ $pedido->id_pedido }}"
                {{ $venta->id_pedido == $pedido->id_pedido ? 'selected' : '' }}>

                {{ $pedido->id_pedido }}

            </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Fecha Venta</label>

        <input type="date"
               name="fecha_venta"
               class="form-control"
               value="{{ $venta->fecha_venta }}">

    </div>

    <div class="mb-3">

        <label>Total</label>

        <input type="number"
               step="0.01"
               name="total"
               class="form-control"
               value="{{ $venta->total }}">

    </div>

    <button class="btn btn-primary">
        Actualizar
    </button>

</form>

@endsection