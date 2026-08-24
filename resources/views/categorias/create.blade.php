@extends('welcome')

@section('contenido')

<h2>Nueva Categoría</h2>

<form action="{{ route('categorias.store') }}" method="POST">

    @csrf

    <div class="mb-3">

        <label class="form-label">
            Nombre
        </label>

        <input type="text"
               name="nombre"
               class="form-control">

    </div>

    <button type="submit"
            class="btn btn-success">

        Guardar

    </button>

    <a href="{{ route('categorias.index') }}"
       class="btn btn-secondary">

       Cancelar

    </a>

</form>

@endsection