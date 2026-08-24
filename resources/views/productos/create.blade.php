@extends('welcome')

@section('contenido')

<h2>Nuevo Producto</h2>

<form action="{{ route('productos.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text"
               name="nombre"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <input type="text"
               name="descripcion"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Talla</label>
        <input type="text"
               name="talla"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Color</label>
        <input type="text"
               name="color"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Precio</label>
        <input type="number"
               step="0.01"
               name="precio"
               class="form-control">
    </div>

    <div class="mb-3">

        <label>Categoría</label>

        <select name="id_categoria"
                class="form-control">

            @foreach($categorias as $categoria)

                <option value="{{ $categoria->id_categoria }}">
                    {{ $categoria->nombre }}
                </option>

            @endforeach

        </select>

    </div>

    <button class="btn btn-primary">
        Guardar
    </button>

</form>

@endsection