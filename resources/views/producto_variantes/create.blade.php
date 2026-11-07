
@extends('adminlte::page')

@section('title', 'Nueva Variante')

@section('content_header')
    <h1>
        <i class="fas fa-plus-circle"></i>
        Nueva Variante
    </h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Registrar variante de producto</h3>
    </div>

    <div class="card-body">

        {{-- EXISTENTE: mostrar errores de validación --}}
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

        <form action="{{ route('producto-variantes.store') }}"
              method="POST">
            @csrf

            {{-- EXISTENTE: seleccionar producto --}}
            <div class="form-group">
                <label for="id_producto">Producto</label>

                <select name="id_producto"
                        id="id_producto"
                        class="form-control"
                        required>
                    <option value="">-- Seleccione un producto --</option>

                    @foreach($productos as $producto)
                        <option value="{{ $producto->id_producto }}"
                            {{ old('id_producto') == $producto->id_producto ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- NUEVO: seleccionar grupo de tallas --}}
            <div class="form-group">
                <label for="grupo">Grupo de tallas</label>

                <select id="grupo" class="form-control" required>
                    <option value="">-- Seleccione un grupo --</option>
                    <option value="BEBE">Bebés</option>
                    <option value="NINO">Niños</option>
                    <option value="JUVENIL">Juveniles</option>
                </select>
            </div>

            {{-- MODIFICADO: seleccionar talla desde MySQL --}}
            <div class="form-group">
                <label for="id_talla">Talla</label>

                <select name="id_talla"
                        id="id_talla"
                        class="form-control"
                        data-selected="{{ old('id_talla') }}"
                        required>
                    <option value="">-- Seleccione una talla --</option>

                    @foreach($tallas as $talla)
                        <option value="{{ $talla->id_talla }}"
                                data-grupo="{{ $talla->grupo }}"
                            {{ old('id_talla') == $talla->id_talla ? 'selected' : '' }}>
                            {{ $talla->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MODIFICADO: seleccionar color desde MySQL --}}
            <div class="form-group">
                <label for="id_color">Color</label>

                <select name="id_color"
                        id="id_color"
                        class="form-control"
                        required>
                    <option value="">-- Seleccione un color --</option>

                    @foreach($colores as $color)
                        <option value="{{ $color->id_color }}"
                            {{ old('id_color') == $color->id_color ? 'selected' : '' }}>
                            {{ $color->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- EXISTENTE: precio de la variante --}}
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
                           value="{{ old('precio') }}"
                           placeholder="0.00"
                           required>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar
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

{{-- NUEVO: filtrar tallas según el grupo seleccionado --}}
@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const grupo = document.getElementById('grupo');
    const talla = document.getElementById('id_talla');
    const opciones = Array.from(talla.options);

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

    // NUEVO: recuperar la talla tras un error de validación.
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

    filtrarTallas(true);

    grupo.addEventListener('change', function () {
        filtrarTallas(false);
    });
});
</script>
@stop
