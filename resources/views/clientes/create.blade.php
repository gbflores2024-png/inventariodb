@extends('adminlte::page')

@section('title', 'Nuevo Cliente')

@section('content_header')
    <h1>Nuevo Cliente</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Registrar Cliente
        </h3>
    </div>

    <div class="card-body">

        <form action="{{ route('clientes.store') }}"
              method="POST">

            @csrf

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

                <label for="email">
                    Email
                </label>

                <input type="email"
                       id="email"
                       name="email"
                       class="form-control">

            </div>

            <div class="form-group">

                <label for="telefono">
                    Teléfono
                </label>

                <input type="text"
                       id="telefono"
                       name="telefono"
                       class="form-control">

            </div>

            <div class="form-group">

                <label for="direccion">
                    Dirección
                </label>

                <input type="text"
                       id="direccion"
                       name="direccion"
                       class="form-control">

            </div>

            <br>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save"></i>
                Guardar

            </button>

            <a href="{{ route('clientes.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>
                Cancelar

            </a>

        </form>

    </div>

</div>

@stop