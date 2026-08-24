@extends('welcome')

@section('contenido')

<h2>Devoluciones</h2>

<a href="{{ route('devoluciones.create') }}"
   class="btn btn-primary mb-3">
   Nueva Devolución
</a>

<table class="table table-bordered">

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

        <td>{{ $devolucion->id_devolucion }}</td>

        <td>{{ $devolucion->id_venta }}</td>

        <td>{{ $devolucion->id_producto }}</td>

        <td>{{ $devolucion->cantidad }}</td>

        <td>{{ $devolucion->estado }}</td>

        <td>{{ $devolucion->fecha_devolucion }}</td>

        <td>

            <a href="{{ route('devoluciones.edit',$devolucion->id_devolucion) }}"
               class="btn btn-warning">
               Editar
            </a>

            <form action="{{ route('devoluciones.destroy',$devolucion->id_devolucion) }}"
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