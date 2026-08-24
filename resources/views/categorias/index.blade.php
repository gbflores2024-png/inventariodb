@extends('welcome')

@section('contenido')

<h2>Categorías</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<a href="{{ route('categorias.create') }}"
   class="btn btn-primary mb-3">
    Nueva Categoría
</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach($categorias as $categoria)

            <tr>

                <td>{{ $categoria->id_categoria }}</td>

                <td>{{ $categoria->nombre }}</td>

                <td>

                    <a href="{{ route('categorias.edit', $categoria->id_categoria) }}"
                       class="btn btn-warning">
                        Editar
                    </a>

                    <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}"
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