@extends('welcome')

@section('contenido')

<h2>Nuevo Inventario</h2>

<form action="{{ route('inventarios.store') }}"
      method="POST">

    @csrf

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
        <label>Inventario Físico</label>
        <input type="number"
               name="inventario_fisico"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stock Disponible</label>
        <input type="number"
               name="stock_disponible"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stock Reservado</label>
        <input type="number"
               name="stock_reservado"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stock Mínimo</label>
        <input type="number"
               name="stock_minimo"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Fecha Actualización</label>
        <input type="date"
               name="fecha_actualizacion"
               class="form-control">
    </div>

    <button class="btn btn-primary">
        Guardar
    </button>

</form>

@endsection