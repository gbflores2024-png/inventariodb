@extends('welcome')

@section('contenido')

<h2>Editar Producto</h2>

<form action="{{ route('productos.update',$producto->id_producto) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>

        <input type="text"
               name="nombre"
               class="form-control"
               value="{{ $producto->nombre }}">
    </div>

    <div class="mb-3">
        <label>Descripción</label>

        <input type="text"
               name="descripcion"
               class="form-control"
               value="{{ $producto->descripcion }}">
    </div>

    <div class="mb-3">
        <label>Talla</label>

        <input type="text"
               name="talla"
               class="form-control"
               value="{{ $producto->talla }}">
    </div>

    <div class="mb-3">
        <label>Color</label>

        <input type="text"
               name="color"
               class="form-control"
               value="{{ $producto->color }}">
    </div>

    <div class="mb-3">
        <label>Precio</label>

        <input type="number"
               step="0.01"
               name="precio"
               class="form-control"
               value="{{ $producto->precio }}">
    </div>

    <div class="mb-3">

        <label>Categoría</label>

        <select name="id_categoria"
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

    <button class="btn btn-primary">
        Actualizar
    </button>

</form>

@endsection