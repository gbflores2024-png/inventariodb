@extends('adminlte::page')

@section('title', 'Editar Categoría')

@section('content_header')
    <h1>Editar Categoría</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Modificar Categoría
        </h3>
    </div>

    <div class="card-body">

        <form action="{{ route('categorias.update', $categoria->id_categoria) }}"
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
                       value="{{ $categoria->nombre }}"
                       required>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Actualizar
            </button>

            <a href="{{ route('categorias.index') }}"
               class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Cancelar
            </a>

        </form>

    </div>

</div>

@stop