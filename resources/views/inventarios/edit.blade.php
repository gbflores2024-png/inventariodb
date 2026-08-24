@extends('welcome')

@section('contenido')

<h2>Editar Inventario</h2>

<form action="{{ route('inventarios.update',$inventario->id_inventario) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Producto</label>

        <select name="id_producto"
                class="form-control">

            @foreach($productos as $producto)

                <option
                    value="{{ $producto->id_producto }}"
                    {{ $inventario->id_producto == $producto->id_producto ? 'selected' : '' }}>

                    {{ $producto->nombre }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">
        <label>Inventario Físico</label>

        <input type="number"
               name="inventario_fisico"
               value="{{ $inventario->inventario_fisico }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stock Disponible</label>

        <input type="number"
               name="stock_disponible"
               value="{{ $inventario->stock_disponible }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stock Reservado</label>

        <input type="number"
               name="stock_reservado"
               value="{{ $inventario->stock_reservado }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Stock Mínimo</label>

        <input type="number"
               name="stock_minimo"
               value="{{ $inventario->stock_minimo }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Fecha Actualización</label>

        <input type="date"
               name="fecha_actualizacion"
               value="{{ $inventario->fecha_actualizacion }}"
               class="form-control">
    </div>

    <button class="btn btn-primary">
        Actualizar
    </button>

</form>

@endsection