@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header') <h1>Lista de Clientes</h1>
@stop

@section('content')

<div class="card">


<div class="card-header">
    <h3 class="card-title">
        Clientes registrados
    </h3>

    <div class="card-tools">
        <a href="{{ route('clientes.create') }}"
           class="btn btn-success btn-sm">
            <i class="fas fa-user-plus"></i>
            Nuevo Cliente
        </a>
    </div>
</div>

<div class="card-body">

    <table class="table table-bordered table-hover">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach($clientes as $cliente)

                <tr>

                    <td>
                        {{ $cliente->id_cliente }}
                    </td>

                    <td>
                        {{ $cliente->nombre }}
                    </td>

                    <td>
                        {{ $cliente->email }}
                    </td>

                    <td>
                        {{ $cliente->telefono }}
                    </td>

                    <td>
                        {{ $cliente->direccion }}
                    </td>

                    <td>

                        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>
                            Editar

                        </a>

                        <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm">

                                <i class="fas fa-trash"></i>
                                Eliminar

                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>


</div>

@stop
