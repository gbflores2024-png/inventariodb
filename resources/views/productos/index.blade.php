@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Lista de Productos</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Productos registrados
        </h3>

        <div class="card-tools">
            <a href="{{ route('productos.create') }}"
               class="btn btn-success btn-sm">

                <i class="fas fa-plus"></i>
                Nuevo Producto

            </a>
        </div>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

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

                        <td>
                            {{ $producto->id_producto }}
                        </td>

                        <td>
                            {{ $producto->nombre }}
                        </td>

                        <td>
                            {{ $producto->talla }}
                        </td>

                        <td>
                            {{ $producto->color }}
                        </td>

                        <td>
                            {{ $producto->precio }}
                        </td>

                        <td>
                            {{ $producto->categoria->nombre }}
                        </td>

                        <td>

                            <a href="{{ route('productos.edit', $producto->id_producto) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>
                                Editar

                            </a>

                            <form action="{{ route('productos.destroy', $producto->id_producto) }}"
                                  method="POST"
                                  style="display:inline;">

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