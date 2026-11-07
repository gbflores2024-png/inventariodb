
@extends('adminlte::page')

@section('title', 'Nuevo Inventario')

@section('content_header')
    <h1>
        <i class="fas fa-boxes"></i>
        Nuevo Inventario
    </h1>
@stop

@section('content')

<div class="card card-primary card-outline">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-warehouse"></i>
            Registrar Inventario por Variante
        </h3>
    </div>

    <div class="card-body">

        {{-- EXISTENTE: mostrar errores --}}
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

        <form action="{{ route('inventarios.store') }}"
              method="POST">

            @csrf

            {{-- MODIFICADO: seleccionar producto --}}
            <div class="form-group">

                <label for="id_producto">
                    <i class="fas fa-tshirt"></i>
                    Producto
                </label>

                <select name="id_producto"
                        id="id_producto"
                        class="form-control"
                        required>

                    <option value="">
                        -- Seleccione un producto --
                    </option>

                    @foreach($productos as $producto)
                        <option value="{{ $producto->id_producto }}"
                            {{ old('id_producto') == $producto->id_producto ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach

                </select>

            </div>

            {{-- MODIFICADO: variantes con tallas y colores reales --}}
            <div class="form-group">

                <label for="id_variante">
                    <i class="fas fa-tags"></i>
                    Variante (talla y color)
                </label>

                <select name="id_variante"
                        id="id_variante"
                        class="form-control"
                        required
                        disabled>

                    <option value="">
                        -- Primero seleccione un producto --
                    </option>

                    @foreach($variantes as $variante)
                        <option
                            value="{{ $variante->id_variante }}"
                            data-producto="{{ $variante->id_producto }}"
                            data-valida="{{ $variante->tallaCatalogo && $variante->colorCatalogo ? '1' : '0' }}"
                            {{ old('id_variante') == $variante->id_variante ? 'selected' : '' }}>

                            {{ $variante->tallaCatalogo->grupo ?? 'Sin grupo' }}
                            |
                            Talla: {{ $variante->tallaCatalogo->nombre ?? 'Sin talla' }}
                            |
                            Color: {{ $variante->colorCatalogo->nombre ?? 'Sin color' }}
                            |
                            Bs. {{ number_format($variante->precio, 2) }}

                        </option>
                    @endforeach

                </select>

                <small class="form-text text-muted">
                    Solo se mostrarán las variantes del producto seleccionado.
                </small>

            </div>

            {{-- EXISTENTE: inventario físico --}}
            <div class="form-group">

                <label for="inventario_fisico">
                    <i class="fas fa-box"></i>
                    Inventario Físico
                </label>

                <input type="number"
                       name="inventario_fisico"
                       id="inventario_fisico"
                       class="form-control"
                       min="0"
                       step="1"
                       value="{{ old('inventario_fisico', 0) }}"
                       required>

                <small class="form-text text-muted">
                    Cantidad inicial de unidades de esta variante.
                </small>

            </div>

            {{-- MODIFICADO: stock disponible calculado --}}
            <div class="form-group">

                <label for="stock_disponible_vista">
                    <i class="fas fa-check-circle"></i>
                    Stock Disponible Inicial
                </label>

                <input type="number"
                       id="stock_disponible_vista"
                       class="form-control"
                       value="{{ old('inventario_fisico', 0) }}"
                       readonly>

                <small class="form-text text-muted">
                    Se calcula automáticamente a partir del inventario físico.
                </small>

            </div>

            {{-- MODIFICADO: stock reservado inicial --}}
            <div class="form-group">

                <label>
                    <i class="fas fa-bookmark"></i>
                    Stock Reservado Inicial
                </label>

                <input type="number"
                       class="form-control"
                       value="0"
                       readonly>

            </div>

            {{-- EXISTENTE: stock mínimo --}}
            <div class="form-group">

                <label for="stock_minimo">
                    <i class="fas fa-exclamation-triangle"></i>
                    Stock Mínimo
                </label>

                <input type="number"
                       name="stock_minimo"
                       id="stock_minimo"
                       class="form-control"
                       min="0"
                       step="1"
                       value="{{ old('stock_minimo', 5) }}"
                       required>

            </div>

            {{-- BOTONES --}}
            <div class="mt-4">

                <button type="submit"
                        class="btn btn-success">

                    <i class="fas fa-save"></i>
                    Guardar Inventario

                </button>

                <a href="{{ route('inventarios.index') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Cancelar

                </a>

            </div>

        </form>

    </div>
</div>

@stop

{{-- NUEVO: filtrar variantes por producto --}}
@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const productoSelect = document.getElementById('id_producto');
    const varianteSelect = document.getElementById('id_variante');
    const fisicoInput = document.getElementById('inventario_fisico');
    const disponibleInput = document.getElementById('stock_disponible_vista');

    // NUEVO: conservar las opciones originales.
    const opciones = Array.from(varianteSelect.options)
        .slice(1)
        .map(option => option.cloneNode(true));

    const varianteAnterior = @json(old('id_variante'));

    // NUEVO: filtrar por producto seleccionado.
    function filtrarVariantes(conservarAnterior = false) {

        const productoId = productoSelect.value;

        varianteSelect.innerHTML = '';

        const opcionInicial = document.createElement('option');
        opcionInicial.value = '';
        opcionInicial.textContent = productoId
            ? '-- Seleccione una variante --'
            : '-- Primero seleccione un producto --';

        varianteSelect.appendChild(opcionInicial);

        varianteSelect.disabled = !productoId;

        opciones.forEach(function (opcion) {

            if (
                opcion.dataset.producto === productoId &&
                opcion.dataset.valida === '1'
            ) {
                const copia = opcion.cloneNode(true);
                copia.selected = conservarAnterior &&
                    copia.value === String(varianteAnterior);

                varianteSelect.appendChild(copia);
            }

        });

        if (!conservarAnterior) {
            varianteSelect.value = '';
        }
    }

    // NUEVO: calcular visualmente stock disponible.
    function actualizarDisponible() {
        disponibleInput.value = fisicoInput.value;
    }

    productoSelect.addEventListener('change', function () {
        filtrarVariantes(false);
    });

    fisicoInput.addEventListener('input', actualizarDisponible);

    filtrarVariantes(true);
    actualizarDisponible();

});
</script>
@stop
