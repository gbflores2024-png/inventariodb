@extends('adminlte::page')

@section('title', 'Reservas')

@section('content_header') <h1>Lista de Reservas</h1>
@stop

@section('content')

<div class="card">

```
<div class="card-header">
    <h3 class="card-title">
        Reservas registradas
    </h3>

    <div class="card-tools">
        <a href="{{ route('reservas.create') }}"
           class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i>
            Nueva Reserva
        </a>
    </div>
</div>

<div class="card-body">

    <table class="table table-bordered table-hover">

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

                    <td>
                        {{ $reserva->id_reserva }}
                    </td>

                    <td>
                        {{ $reserva->cliente->nombre }}
                    </td>

                    <td>
                        {{ $reserva->fecha_reserva }}
                    </td>

                    <td>
                        {{ $reserva->estado }}
                    </td>

                    <td>
                        {{ $reserva->total }}
                    </td>

                    <td>

                        <a href="{{ route('reservas.edit', $reserva->id_reserva) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>
                            Editar

                        </a>

                        <form action="{{ route('reservas.destroy', $reserva->id_reserva) }}"
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
```

</div>

@stop
