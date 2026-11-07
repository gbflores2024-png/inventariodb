@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
<h1>Categorías</h1>
@stop

@section('content')

<div class="card">
<div class="card-header">
    <h3 class="card-title">
        Categorías registradas
    </h3>

    <div class="card-tools">
        <a href="{{ route('categorias.create') }}"
           class="btn btn-primary btn-sm">

            <i class="fas fa-plus"></i>
            Nueva Categoría

        </a>
    </div>
</div>

<div class="card-body">

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">

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

                    <td>
                        {{ $categoria->id_categoria }}
                    </td>

                    <td>
                        {{ $categoria->nombre }}
                    </td>

                    <td>

                        <a href="{{ route('categorias.edit', $categoria->id_categoria) }}"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>
                            Editar

                        </a>

                        <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}"
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