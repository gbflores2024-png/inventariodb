@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Pedidos registrados
        </h3>

        <div class="card-tools">
            <a href="{{ route('pedidos.create') }}"
               class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>
                Nuevo Pedido

            </a>
        </div>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

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

                        <td>
                            {{ $pedido->id_pedido }}
                        </td>

                        <td>
                            {{ $pedido->id_reserva }}
                        </td>

                        <td>
                            {{ $pedido->fecha_pedido }}
                        </td>

                        <td>
                            {{ $pedido->estado }}
                        </td>

                        <td>

                            <a href="{{ route('pedidos.edit', $pedido->id_pedido) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>
                                Editar

                            </a>

                            <form action="{{ route('pedidos.destroy', $pedido->id_pedido) }}"
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