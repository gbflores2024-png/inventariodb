@extends('adminlte::page')

@section('title', 'Nuevo Producto')

@section('content_header')
    <h1>Nuevo Producto</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Registrar Producto
        </h3>
    </div>

    <div class="card-body">

        <form action="{{ route('productos.store') }}"
              method="POST">

            @csrf
        @if ($errors->any())
    <div class="alert alert-danger">
        <strong>No se pudo registrar el producto.</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="form-group">

                <label for="nombre">
                    Nombre
                </label>

                <input type="text"
                       id="nombre"
                       name="nombre"
                       class="form-control">

            </div>

            <div class="form-group">

                <label for="descripcion">
                    Descripción
                </label>

                <input type="text"
                       id="descripcion"
                       name="descripcion"
                       class="form-control">

            </div>

            <div class="form-group">

                <label for="talla">
                    Talla
                </label>

                <input type="text"
                       id="talla"
                       name="talla"
                       class="form-control">

            </div>

            <div class="form-group">

                <label for="color">
                    Color
                </label>

                <input type="text"
                       id="color"
                       name="color"
                       class="form-control">

            </div>

            <div class="form-group">

                <label for="precio">
                    Precio
                </label>

                <input type="number"
                       id="precio"
                       step="0.01"
                       name="precio"
                       class="form-control">

            </div>

            <div class="form-group">

                <label for="id_categoria">
                    Categoría
                </label>

                <select name="id_categoria"
                        id="id_categoria"
                        class="form-control">

                    @foreach($categorias as $categoria)

                        <option value="{{ $categoria->id_categoria }}">

                            {{ $categoria->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <br>

            <button type="submit"
                    class="btn btn-primary">

                <i class="fas fa-save"></i>
                Guardar

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