@extends('adminlte::page')

@section('title', 'Nueva Categoría')

@section('content_header')
    <h1>Nueva Categoría</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Registrar Categoría
        </h3>
    </div>

    <div class="card-body">

        <form action="{{ route('categorias.store') }}"
              method="POST">

            @csrf

            <div class="form-group">

                <label for="nombre">
                    Nombre
                </label>

                <input type="text"
                       id="nombre"
                       name="nombre"
                       class="form-control"
                       required>

            </div>

            <br>

            <button type="submit"
                    class="btn btn-success">

                <i class="fas fa-save"></i>
                Guardar

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