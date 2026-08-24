@extends('welcome')

@section('contenido')

<h2>Nueva Devolución</h2>

<form action="{{ route('devoluciones.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>Venta</label>

        <select name="id_venta"
                class="form-control">

            @foreach($ventas as $venta)

            <option value="{{ $venta->id_venta }}">
                {{ $venta->id_venta }}
            </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Producto</label>

        <select name="id_producto"
                class="form-control">

            @foreach($productos as $producto)

            <option value="{{ $producto->id_producto }}">
                {{ $producto->nombre }}
            </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">
        <label>Cantidad</label>
        <input type="number"
               name="cantidad"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Motivo</label>
        <input type="text"
               name="motivo"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <input type="text"
               name="estado"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Fecha</label>
        <input type="date"
               name="fecha_devolucion"
               class="form-control">
    </div>

    <button class="btn btn-success">
        Guardar
    </button>

</form>

@endsection