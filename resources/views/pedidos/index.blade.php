@extends('welcome')

@section('contenido')

<h2>Pedidos</h2>

<a href="{{ route('pedidos.create') }}"
   class="btn btn-primary mb-3">
   Nuevo Pedido
</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Reserva</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    @foreach($pedidos as $pedido)

    <tr>

        <td>{{ $pedido->id_pedido }}</td>

        <td>{{ $pedido->id_reserva }}</td>

        <td>{{ $pedido->fecha_pedido }}</td>

        <td>{{ $pedido->estado }}</td>

        <td>

            <a href="{{ route('pedidos.edit',$pedido->id_pedido) }}"
               class="btn btn-warning">
               Editar
            </a>

            <form action="{{ route('pedidos.destroy',$pedido->id_pedido) }}"
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