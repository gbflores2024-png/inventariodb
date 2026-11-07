
@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>
        <i class="fas fa-user-edit"></i>
        Editar Usuario
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
                Modificar usuario
            </h3>
        </div>

        <form action="{{ route('users.update', $user) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">

                    <label>
                        Nombre
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}"
                           required>

                </div>

                <div class="form-group">

                    <label>
                        Correo electrónico
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}"
                           required>

                </div>

            </div>

            <div class="card-footer">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Actualizar

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
