@extends('adminlte::page')

@section('title', 'Asignar Rol')

@section('content_header')
    <h1>Asignar rol a usuario</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Asignar rol
            </h3>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Hay errores:</strong>

                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('asignar.store') }}" method="POST">

                @csrf

                {{-- USUARIO --}}
                <div class="form-group">
                    <label for="user_id">Usuario</label>

                    <select
                        name="user_id"
                        id="user_id"
                        class="form-control"
                        required
                    >

                        <option value="">
                            -- Seleccione un usuario --
                        </option>

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old('user_id') == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->name }} - {{ $user->email }}
                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- ROL --}}
                <div class="form-group">
                    <label for="role_id">Rol</label>

                    <select
                        name="role_id"
                        id="role_id"
                        class="form-control"
                        required
                    >

                        <option value="">
                            -- Seleccione un rol --
                        </option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                {{ old('role_id') == $role->id ? 'selected' : '' }}
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mt-3">

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-tag"></i>
                        Asignar rol
                    </button>

                    <a
                        href="{{ route('asignar.index') }}"
                        class="btn btn-secondary"
                    >
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>

                </div>

            </form>

        </div>

    </div>

@stop