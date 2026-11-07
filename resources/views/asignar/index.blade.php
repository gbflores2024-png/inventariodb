@extends('adminlte::page')

@section('title', 'Asignar Roles')

@section('content_header')
    <h1>Asignar roles a usuarios</h1>
@stop

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Usuarios y roles</h3>

            <div class="card-tools">
                <a href="{{ route('asignar.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-tag"></i>
                    Asignar rol
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Rol</th>
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

                                @if($user->roles->count() > 0)

                                    @foreach($user->roles as $role)

                                        <span class="badge badge-info">
                                            {{ $role->name }}
                                        </span>

                                    @endforeach

                                @else

                                    <span class="badge badge-secondary">
                                        Sin rol
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center">
                                No hay usuarios registrados.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@stop