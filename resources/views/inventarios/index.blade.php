@extends('welcome')

@section('contenido')

<h2>Inventario</h2>

<a href="{{ route('inventarios.create') }}"
   class="btn btn-success mb-3">

    Nuevo Inventario

</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Inventario Físico</th>
            <th>Disponible</th>
            <th>Reservado</th>
            <th>Stock Mínimo</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    @foreach($inventarios as $inventario)

        <tr>

            <td>{{ $inventario->id_inventario }}</td>

            <td>{{ $inventario->producto->nombre }}</td>

            <td>{{ $inventario->inventario_fisico }}</td>

            <td>{{ $inventario->stock_disponible }}</td>

            <td>{{ $inventario->stock_reservado }}</td>

            <td>{{ $inventario->stock_minimo }}</td>

            <td>{{ $inventario->fecha_actualizacion }}</td>

            <td>

                <a href="{{ route('inventarios.edit',$inventario->id_inventario) }}"
                   class="btn btn-warning">

                    Editar

                </a>

                <form action="{{ route('inventarios.destroy',$inventario->id_inventario) }}"
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