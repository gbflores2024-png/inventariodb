 
@extends('adminlte::page')

@section('title', 'Editar Variante')

@section('content_header')
    <h1>
        <i class="fas fa-edit"></i>
        Editar Variante
    </h1>
@stop

@section('content')

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Modificar variante de producto</h3>
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

        {{-- NUEVO: formulario de actualización --}}
        <form action="{{ route('producto-variantes.update', $variante->id_variante) }}"
              method="POST">
            @csrf
            @method('PUT')

            @php
                // NUEVO: proteger la identidad si existe inventario.
                $tieneInventario = $variante->inventario()->exists();
            @endphp

            @if($tieneInventario)
                <div class="alert alert-info">
                    Esta variante tiene inventario asociado.
                    Solo puedes modificar su precio.
                </div>
            @endif

            {{-- MODIFICADO: seleccionar producto --}}
            <div class="form-group">
                <label for="id_producto">Producto</label>

                <select name="id_producto"
                        id="id_producto"
                        class="form-control"
                        required>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id_producto }}"
                            {{ old('id_producto', $variante->id_producto) == $producto->id_producto ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- NUEVO: grupo de tallas --}}
            <div class="form-group">
                <label for="grupo">Grupo de tallas</label>

                <select id="grupo" class="form-control" required>
                    <option value="">-- Seleccione un grupo --</option>
                    <option value="BEBE">Bebés</option>
                    <option value="NINO">Niños</option>
                    <option value="JUVENIL">Juveniles</option>
                </select>
            </div>

            {{-- MODIFICADO: talla desde el catálogo --}}
            <div class="form-group">
                <label for="id_talla">Talla</label>

                <select name="id_talla"
                        id="id_talla"
                        class="form-control"
                        data-selected="{{ old('id_talla', $variante->id_talla) }}"
                        required>
                    <option value="">-- Seleccione una talla --</option>

                    @foreach($tallas as $talla)
                        <option value="{{ $talla->id_talla }}"
                                data-grupo="{{ $talla->grupo }}"
                            {{ old('id_talla', $variante->id_talla) == $talla->id_talla ? 'selected' : '' }}>
                            {{ $talla->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MODIFICADO: color desde el catálogo --}}
            <div class="form-group">
                <label for="id_color">Color</label>

                <select name="id_color"
                        id="id_color"
                        class="form-control"
                        required>
                    <option value="">-- Seleccione un color --</option>

                    @foreach($colores as $color)
                        <option value="{{ $color->id_color }}"
                            {{ old('id_color', $variante->id_color) == $color->id_color ? 'selected' : '' }}>
                            {{ $color->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- EXISTENTE: precio --}}
            <div class="form-group">
                <label for="precio">Precio</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Bs.</span>
                    </div>

                    <input type="number"
                           name="precio"
                           id="precio"
                           class="form-control"
                           step="0.01"
                           min="0"
                           max="99999999.99"
                           value="{{ old('precio', $variante->precio) }}"
                           required>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Actualizar
                </button>

                <a href="{{ route('producto-variantes.index') }}"
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>

        </form>
    </div>
</div>

@stop

{{-- NUEVO: filtrar tallas por grupo --}}
@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const grupo = document.getElementById('grupo');
    const talla = document.getElementById('id_talla');
    const opciones = Array.from(talla.options);

    const seleccionAnterior = talla.dataset.selected;

    if (seleccionAnterior) {
        const opcionAnterior = opciones.find(
            opcion => opcion.value === seleccionAnterior
        );

        if (opcionAnterior) {
            grupo.value = opcionAnterior.dataset.grupo;
            talla.value = seleccionAnterior;
        }
    }

    function filtrarTallas(conservarSeleccion = false) {
        const seleccion = conservarSeleccion ? talla.value : '';

        opciones.forEach(function (opcion) {
            if (!opcion.value) return;

            const coincide = opcion.dataset.grupo === grupo.value;
            opcion.hidden = !coincide;
            opcion.disabled = !coincide;
        });

        talla.value = seleccion;

        if (!talla.selectedOptions.length ||
            talla.selectedOptions[0].disabled) {
            talla.value = '';
        }
    }

    filtrarTallas(true);

    grupo.addEventListener('change', function () {
        filtrarTallas(false);
    });
});
</script>
@stop
