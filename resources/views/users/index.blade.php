
@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>
        <i class="fas fa-users"></i>
        Usuarios
    </h1>
@stop

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Lista de usuarios
            </h3>

            <div class="card-tools">
                <a href="{{ route('users.create') }}"
                   class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    Nuevo usuario
                </a>
            </div>
        </div>

        <div class="card-body">

            <!-- BUSCAR USUARIO -->
            <form action="{{ route('users.index') }}"
                  method="GET"
                  class="mb-3">

                <div class="input-group">

                    <input type="text"
                           name="buscar"
                           class="form-control"
                           placeholder="Buscar por nombre o correo"
                           value="{{ $buscar ?? '' }}">

                    <div class="input-group-append">

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Buscar
                        </button>

                        <a href="{{ route('users.index') }}"
                           class="btn btn-secondary">
                            Limpiar
                        </a>

                    </div>

                </div>

            </form>

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th width="180">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>
                                {{ $user->id }}
                            </td>

                            <td>
                                {{ $user->name }}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>

                                @forelse($user->roles as $role)

                                    <span class="badge badge-info">
                                        {{ $role->name }}
                                    </span>

                                @empty

                                    <span class="badge badge-secondary">
                                        Sin rol
                                    </span>

                                @endforelse

                            </td>

                            <td>

                                <a href="{{ route('users.edit', $user) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('users.destroy', $user) }}"
                                      method="POST"
                                      style="display:inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Desea eliminar este usuario?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center">

                                No existen usuarios registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@stop
