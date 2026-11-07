
@extends('adminlte::page')

@section('title', 'Variantes de Productos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-tags"></i>
            Variantes de Productos
        </h1>

        <a href="{{ route('producto-variantes.create') }}"
           class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Nueva Variante
        </a>
    </div>
@stop

@section('content')

    {{-- EXISTENTE: mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Cerrar">
                <span>&times;</span>
            </button>
        </div>
    @endif

    {{-- NUEVO: mostrar errores del controlador --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle"></i>
            {{ session('error') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Cerrar">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-primary card-outline">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list"></i>
                Lista de variantes
            </h3>
        </div>

        <div class="card-body">

            @if($variantes->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>

                                {{-- NUEVO: grupo de tallas --}}
                                <th>Grupo</th>

                                <th>Talla</th>
                                <th>Color</th>
                                <th>Precio</th>
                                <th>Inventario</th>
                                <th width="180">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($variantes as $variante)
                                <tr>

                                    <td>
                                        {{ $variante->id_variante }}
                                    </td>

                                    <td>
                                        {{ $variante->producto->nombre ?? 'Sin producto' }}
                                    </td>

                                    {{-- NUEVO: grupo desde tabla tallas --}}
                                    <td>
                                        @php
                                            $grupo = $variante->tallaCatalogo->grupo ?? null;
                                        @endphp

                                        @if($grupo === 'BEBE')
                                            <span class="badge badge-primary">
                                                Bebés
                                            </span>
                                        @elseif($grupo === 'NINO')
                                            <span class="badge badge-success">
                                                Niños
                                            </span>
                                        @elseif($grupo === 'JUVENIL')
                                            <span class="badge badge-info">
                                                Juveniles
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                Sin grupo
                                            </span>
                                        @endif
                                    </td>

                                    {{-- MODIFICADO: talla desde catálogo --}}
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $variante->tallaCatalogo->nombre ?? 'Sin asignar' }}
                                        </span>
                                    </td>

                                    {{-- MODIFICADO: color desde catálogo --}}
                                    <td>
                                        @if($variante->colorCatalogo)
                                            <span class="d-inline-flex align-items-center">

                                                @if($variante->colorCatalogo->codigo_hex)
                                                    <span
                                                        style="
                                                            display:inline-block;
                                                            width:16px;
                                                            height:16px;
                                                            border:1px solid #999;
                                                            border-radius:50%;
                                                            background-color:{{ $variante->colorCatalogo->codigo_hex }};
                                                            margin-right:8px;
                                                        ">
                                                    </span>
                                                @endif

                                                {{ $variante->colorCatalogo->nombre }}
                                            </span>
                                        @else
                                            <span class="text-muted">
                                                Sin asignar
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        Bs. {{ number_format($variante->precio, 2) }}
                                    </td>

                                    {{-- NUEVO: estado de inventario asociado --}}
                                    <td>
                                        @if($variante->inventario)
                                            <span class="badge badge-success">
                                                Con inventario
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                Sin inventario
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('producto-variantes.edit', $variante->id_variante) }}"
                                           class="btn btn-warning btn-sm mb-1">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>

                                        {{-- MODIFICADO: evitar ofrecer borrado
                                             si hay inventario asociado --}}
                                        @if(!$variante->inventario)
                                            <form
                                                action="{{ route('producto-variantes.destroy', $variante->id_variante) }}"
                                                method="POST"
                                                style="display:inline-block">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm mb-1"
                                                        onclick="return confirm('¿Está seguro de eliminar esta variante?')">
                                                    <i class="fas fa-trash"></i>
                                                    Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge badge-secondary">
                                                Eliminación restringida
                                            </span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="fas fa-box-open fa-4x text-muted mb-3"></i>

                    <h4>No hay variantes registradas</h4>

                    <p class="text-muted">
                        Todavía no existen variantes de productos.
                    </p>

                    <a href="{{ route('producto-variantes.create') }}"
                       class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Registrar primera variante
                    </a>

                </div>

            @endif

        </div>
    </div>

@stop
