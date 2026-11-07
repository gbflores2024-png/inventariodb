
@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content_header')
    <h1>
        <i class="fas fa-user-plus"></i>
        Nuevo Usuario
    </h1>
@stop

@section('content')

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Se encontraron errores:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Registrar usuario
            </h3>
        </div>

        <form action="{{ route('users.store') }}"
              method="POST">

            @csrf

            <div class="card-body">

                <div class="form-group">

                    <label for="name">
                        Nombre
                    </label>

                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           required>

                </div>

                <div class="form-group">

                    <label for="email">
                        Correo electrónico
                    </label>

                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required>

                </div>

                <div class="form-group">

                    <label for="password">
                        Contraseña
                    </label>

                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           required>

                </div>

                <div class="form-group">

                    <label for="password_confirmation">
                        Confirmar contraseña
                    </label>

                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="form-control"
                           required>

                </div>

            </div>

            <div class="card-footer">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Guardar usuario

                </button>

                <a href="{{ route('users.index') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Cancelar

                </a>

            </div>

        </form>

    </div>

@stop
