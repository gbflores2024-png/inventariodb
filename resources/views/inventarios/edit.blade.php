
@extends('adminlte::page')

@section('title', 'Editar Inventario')

@section('content_header')
    <h1>
        <i class="fas fa-edit"></i>
        Editar Inventario
    </h1>
@stop

@section('content')

<div class="card card-warning">

    <div class="card-header">
        <h3 class="card-title">
            Modificar Inventario
        </h3>
    </div>

    <div class="card-body">

        {{-- NUEVO: mostrar errores de validación --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Se encontraron errores:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- NUEVO: mostrar producto sin permitir cambiarlo --}}
        <div class="form-group">
            <label>Producto</label>
            <input type="text"
                   class="form-control"
                   value="{{ $inventario->producto->nombre ?? 'Sin producto' }}"
                   readonly>
        </div>

        {{-- NUEVO: mostrar variante relacionada --}}
        <div class="form-group">
            <label>Variante</label>

            @if($inventario->variante)
                <input type="text"
                       class="form-control"
                       value="Talla: {{ $inventario->variante->tallaCatalogo->nombre ?? $inventario->variante->talla }} | Color: {{ $inventario->variante->colorCatalogo->nombre ?? $inventario->variante->color }}"
                       readonly>
            @else
                <input type="text"
                       class="form-control"
                       value="Inventario antiguo sin variante asignada"
                       readonly>
            @endif
        </div>

        <form action="{{ route('inventarios.update', $inventario->id_inventario) }}"
              method="POST">

            @csrf
            @method('PUT')

            {{-- NUEVO: proteger inventarios con reservas --}}
            @if($inventario->stock_reservado > 0)
                <div class="alert alert-info">
                    Este inventario tiene unidades reservadas.
                    Por seguridad, no se modificará su cantidad física
                    hasta revisar las operaciones relacionadas.
                </div>
            @endif

            {{-- MODIFICADO: inventario físico --}}
            <div class="form-group">
                <label for="inventario_fisico">
                    Inventario Físico
                </label>

                <input type="number"
                       id="inventario_fisico"
                       name="inventario_fisico"
                       class="form-control"
                       min="0"
                       value="{{ old('inventario_fisico', $inventario->inventario_fisico) }}"
                       {{ $inventario->stock_reservado > 0 ? 'readonly' : '' }}
                       required>
            </div>

            {{-- NUEVO: stock disponible informativo --}}
            <div class="form-group">
                <label>Stock Disponible Actual</label>

                <input type="number"
                       class="form-control"
                       value="{{ $inventario->stock_disponible }}"
                       readonly>
            </div>

            {{-- NUEVO: stock reservado informativo --}}
            <div class="form-group">
                <label>Stock Reservado Actual</label>

                <input type="number"
                       class="form-control"
                       value="{{ $inventario->stock_reservado }}"
                       readonly>
            </div>

            {{-- EXISTENTE: stock mínimo --}}
            <div class="form-group">
                <label for="stock_minimo">
                    Stock Mínimo
                </label>

                <input type="number"
                       id="stock_minimo"
                       name="stock_minimo"
                       class="form-control"
                       min="0"
                       value="{{ old('stock_minimo', $inventario->stock_minimo) }}"
                       required>
            </div>

            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save"></i>
                Actualizar
            </button>

            <a href="{{ route('inventarios.index') }}"
               class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Cancelar
            </a>

        </form>

    </div>
</div>

@stop
