@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Producto</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Modificar Producto
        </h3>
    </div>

    <div class="card-body">

        <form action="{{ route('productos.update', $producto->id_producto) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label for="nombre">
                    Nombre
                </label>

                <input type="text"
                       id="nombre"
                       name="nombre"
                       class="form-control"
                       value="{{ $producto->nombre }}">

            </div>

            <div class="form-group">

                <label for="descripcion">
                    Descripción
                </label>

                <input type="text"
                       id="descripcion"
                       name="descripcion"
                       class="form-control"
                       value="{{ $producto->descripcion }}">

            </div>

            <div class="form-group">

                <label for="talla">
                    Talla
                </label>

                <input type="text"
                       id="talla"
                       name="talla"
                       class="form-control"
                       value="{{ $producto->talla }}">

            </div>

            <div class="form-group">

                <label for="color">
                    Color
                </label>

                <input type="text"
                       id="color"
                       name="color"
                       class="form-control"
                       value="{{ $producto->color }}">

            </div>

            <div class="form-group">

                <label for="precio">
                    Precio
                </label>

                <input type="number"
                       id="precio"
                       step="0.01"
                       name="precio"
                       class="form-control"
                       value="{{ $producto->precio }}">

            </div>

            <div class="form-group">

                <label for="id_categoria">
                    Categoría
                </label>

                <select name="id_categoria"
                        id="id_categoria"
                        class="form-control">

                    @foreach($categorias as $categoria)

                        <option
                            value="{{ $categoria->id_categoria }}"
                            {{ $producto->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>

                            {{ $categoria->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <br>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save"></i>
                Actualizar

            </button>

            <a href="{{ route('productos.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>
                Cancelar

            </a>

        </form>

    </div>

</div>

@stop