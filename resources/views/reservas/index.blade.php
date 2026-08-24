@extends('welcome')

@section('contenido')

<h2>Lista de Reservas</h2>

<a href="{{ route('reservas.create') }}"
   class="btn btn-success mb-3">
   Nueva Reserva
</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    @foreach($reservas as $reserva)

        <tr>

            <td>{{ $reserva->id_reserva }}</td>

            <td>{{ $reserva->cliente->nombre }}</td>

            <td>{{ $reserva->fecha_reserva }}</td>

            <td>{{ $reserva->estado }}</td>

            <td>{{ $reserva->total }}</td>

            <td>

                <a href="{{ route('reservas.edit',$reserva->id_reserva) }}"
                   class="btn btn-warning">
                    Editar
                </a>

                <form action="{{ route('reservas.destroy',$reserva->id_reserva) }}"
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