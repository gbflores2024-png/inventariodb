@extends('welcome')

@section('contenido')

<h2>Lista de Clientes</h2>

<a href="{{ route('clientes.create') }}"
   class="btn btn-success mb-3">
   Nuevo Cliente
</a>

<table class="table table-bordered">

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

            <td>{{ $cliente->id_cliente }}</td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->direccion }}</td>

            <td>

                <a href="{{ route('clientes.edit',$cliente->id_cliente) }}"
                   class="btn btn-warning">
                    Editar
                </a>

                <form action="{{ route('clientes.destroy',$cliente->id_cliente) }}"
                      method="POST"
                      style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        Eliminar
                    </button>

                </form>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection