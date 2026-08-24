@extends('welcome')

@section('contenido')

<h2>Ventas</h2> 

<a href="{{ route('ventas.create') }}"
   class="btn btn-primary mb-3">
   Nueva Venta
</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Pedido</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    @foreach($ventas as $venta)

    <tr>

        <td>{{ $venta->id_venta }}</td>

        <td>{{ $venta->id_pedido }}</td>

        <td>{{ $venta->fecha_venta }}</td>

        <td>{{ $venta->total }}</td>

        <td>

            <a href="{{ route('ventas.edit',$venta->id_venta) }}"
               class="btn btn-warning">
               Editar
            </a>

            <form action="{{ route('ventas.destroy',$venta->id_venta) }}"
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