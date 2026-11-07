@extends('adminlte::page')

@section('title', 'Devoluciones')

@section('content_header')
    <h1>Devoluciones</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Devoluciones registradas
        </h3>

        <div class="card-tools">
            <a href="{{ route('devoluciones.create') }}"
               class="btn btn-primary btn-sm">

                <i class="fas fa-undo"></i>
                Nueva Devolución

            </a>
        </div>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Venta</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($devoluciones as $devolucion)

                    <tr>

                        <td>
                            {{ $devolucion->id_devolucion }}
                        </td>

                        <td>
                            {{ $devolucion->id_venta }}
                        </td>

                        <td>
                            {{ $devolucion->id_producto }}
                        </td>

                        <td>
                            {{ $devolucion->cantidad }}
                        </td>

                        <td>
                            {{ $devolucion->estado }}
                        </td>

                        <td>
                            {{ $devolucion->fecha_devolucion }}
                        </td>

                        <td>

                            <a href="{{ route('devoluciones.edit', $devolucion->id_devolucion) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>
                                Editar

                            </a>

                            <form action="{{ route('devoluciones.destroy', $devolucion->id_devolucion) }}"
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