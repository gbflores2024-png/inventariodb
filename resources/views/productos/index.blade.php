@extends('welcome')

@section('contenido')

<h2>Lista de Productos</h2>

<a href="{{ route('productos.create') }}"
   class="btn btn-success mb-3">
    Nuevo Producto
</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Talla</th>
            <th>Color</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    @foreach($productos as $producto)

        <tr>

            <td>{{ $producto->id_producto }}</td>

            <td>{{ $producto->nombre }}</td>

            <td>{{ $producto->talla }}</td>

            <td>{{ $producto->color }}</td>

            <td>{{ $producto->precio }}</td>

            <td>{{ $producto->categoria->nombre }}</td>

            <td>

                <a href="{{ route('productos.edit',$producto->id_producto) }}"
                   class="btn btn-warning">
                    Editar
                </a>

                <form
                    action="{{ route('productos.destroy',$producto->id_producto) }}"
                    method="POST"
                    style="display:inline;">

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