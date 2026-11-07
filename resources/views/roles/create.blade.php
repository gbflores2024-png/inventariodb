@extends('adminlte::page')

@section('title', 'Nuevo Rol')

@section('content_header')
    <h1>Nuevo Rol</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('roles.store') }}" method="POST">

            @csrf

            <div class="form-group">

                <label for="name">
                    Nombre del Rol
                </label>

                <input type="text"
                       name="name"
                       id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Ej. Administrador">

                @error('name')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Guardar
            </button>

            <a href="{{ route('roles.index') }}"
               class="btn btn-secondary">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop