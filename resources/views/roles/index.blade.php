@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Nuevo Rol
        </a>
    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th width="200">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($roles as $role)

                    <tr>

                        <td>{{ $role->id }}</td>

                        <td>{{ $role->name }}</td>

                        <td>

                            <a href="{{ route('roles.edit', $role) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>
                                Editar

                            </a>

                            <form action="{{ route('roles.destroy', $role) }}"
                                  method="POST"
                                  style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Deseas eliminar este rol?')">

                                    <i class="fas fa-trash"></i>
                                    Eliminar

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center">
                            No existen roles registrados.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop