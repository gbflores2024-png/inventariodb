@extends('welcome')

@section('contenido')

<h2>Editar Categoría</h2>

<form action="{{ route('categorias.update', $categoria->id_categoria) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nombre</label>

        <input type="text"
               name="nombre"
               class="form-control"
               value="{{ $categoria->nombre }}"
               required>
    </div>

    <button type="submit" class="btn btn-primary">
        Actualizar
    </button>

    <a href="{{ route('categorias.index') }}"
       class="btn btn-secondary">
        Cancelar
    </a>

</form>

@endsection