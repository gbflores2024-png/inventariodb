@extends('adminlte::page')

@section('title', 'Editar Devolución')

@section('content_header')
    <h1>Editar Devolución</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Modificar Devolución
        </h3>
    </div>

    <div class="card-body">

        <form action="{{ route('devoluciones.update', $devolucion->id_devolucion) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label for="id_venta">
                    Venta
                </label>

                <select name="id_venta"
                        id="id_venta"
                        class="form-control">

                    @foreach($ventas as $venta)

                        <option value="{{ $venta->id_venta }}"
                            {{ $devolucion->id_venta == $venta->id_venta ? 'selected' : '' }}>

                            {{ $venta->id_venta }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label for="id_producto">
                    Producto
                </label>

                <select name="id_producto"
                        id="id_producto"
                        class="form-control">

                    @foreach($productos as $producto)

                        <option value="{{ $producto->id_producto }}"
                            {{ $devolucion->id_producto == $producto->id_producto ? 'selected' : '' }}>

                            {{ $producto->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label for="cantidad">
                    Cantidad
                </label>

                <input type="number"
                       id="cantidad"
                       name="cantidad"
                       class="form-control"
                       value="{{ $devolucion->cantidad }}">

            </div>

            <div class="form-group">

                <label for="motivo">
                    Motivo
                </label>

                <input type="text"
                       id="motivo"
                       name="motivo"
                       class="form-control"
                       value="{{ $devolucion->motivo }}">

            </div>

            <div class="form-group">

                <label for="estado">
                    Estado
                </label>

                <input type="text"
                       id="estado"
                       name="estado"
                       class="form-control"
                       value="{{ $devolucion->estado }}">

            </div>

            <div class="form-group">

                <label for="fecha_devolucion">
                    Fecha
                </label>

                <input type="date"
                       id="fecha_devolucion"
                       name="fecha_devolucion"
                       class="form-control"
                       value="{{ $devolucion->fecha_devolucion }}">

            </div>

            <br>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save"></i>
                Actualizar

            </button>

            <a href="{{ route('devoluciones.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>
                Cancelar

            </a>

        </form>

    </div>

</div>

@stop