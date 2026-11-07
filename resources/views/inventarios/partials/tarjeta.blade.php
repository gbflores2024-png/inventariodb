@php

    $disponible = $inventario->stock_disponible;

    $minimo = $inventario->stock_minimo;

    /*
    |----------------------------------------------------------
    | Determinar estado
    |----------------------------------------------------------
    */

    if ($disponible <= 0) {

        $estado = 'critico';

        $estadoTexto = 'SIN STOCK';

        $estadoClase = 'estado-critico';

    } elseif ($disponible <= $minimo) {

        $estado = 'bajo';

        $estadoTexto = 'STOCK BAJO';

        $estadoClase = 'estado-bajo';

    } else {

        $estado = 'ok';

        $estadoTexto = 'STOCK OK';

        $estadoClase = 'estado-ok';

    }


    /*
    |----------------------------------------------------------
    | Datos del producto
    |----------------------------------------------------------
    */

    $nombreProducto =
        $inventario->producto->nombre
        ?? 'Producto sin nombre';


    $talla =
        $inventario->variante->talla
        ?? null;


    $color =
        $inventario->variante->color
        ?? null;


    $precio =
        $inventario->variante->precio
        ?? null;

@endphp


<div class="tarjeta-inventario"

     data-nombre="{{ strtolower($nombreProducto) }}"

     data-estado="{{ $estado }}"

     data-disponible="{{ $disponible }}"

     data-reservado="{{ $inventario->stock_reservado }}"

     data-minimo="{{ $minimo }}">


    {{-- ESTADO --}}

    <span class="estado-badge {{ $estadoClase }}">

        @if($estado === 'ok')

            <i class="fas fa-check-circle"></i>

        @elseif($estado === 'bajo')

            <i class="fas fa-exclamation-triangle"></i>

        @else

            <i class="fas fa-times-circle"></i>

        @endif

        {{ $estadoTexto }}

    </span>


    {{-- ICONO PRODUCTO --}}

    <div class="producto-icono">

        @if(str_contains(strtolower($nombreProducto), 'chaqueta'))

            <i class="fas fa-tshirt"></i>

        @elseif(str_contains(strtolower($nombreProducto), 'jean'))

            <i class="fas fa-user"></i>

        @elseif(str_contains(strtolower($nombreProducto), 'pantalon'))

            <i class="fas fa-user"></i>

        @else

            <i class="fas fa-tshirt"></i>

        @endif

    </div>


    {{-- NOMBRE --}}

    <div class="producto-nombre">

        {{ $nombreProducto }}

    </div>


    {{-- VARIANTE --}}

    @if($talla || $color)

        <div class="producto-variante">

            @if($talla)

                <strong>Talla:</strong>
                {{ $talla }}

            @endif

            @if($color)

                <br>

                <strong>Color:</strong>
                {{ $color }}

            @endif

        </div>

    @else

        <div class="producto-variante">

            Sin variante registrada

        </div>

    @endif


    {{-- STOCK --}}

    <div class="datos-stock">

        <div class="dato-stock">

            <small>Disponible</small>

            <strong class="text-success">

                {{ $inventario->stock_disponible }}

            </strong>

        </div>


        <div class="dato-stock">

            <small>Reservado</small>

            <strong class="text-warning">

                {{ $inventario->stock_reservado }}

            </strong>

        </div>


        <div class="dato-stock">

            <small>Físico</small>

            <strong>

                {{ $inventario->inventario_fisico }}

            </strong>

        </div>


        <div class="dato-stock">

            <small>Mínimo</small>

            <strong class="text-danger">

                {{ $inventario->stock_minimo }}

            </strong>

        </div>

    </div>


    {{-- PRECIO --}}

    @if($precio)

        <div class="text-center mt-2">

            <strong>

                Bs. {{ number_format($precio, 2) }}

            </strong>

        </div>

    @endif


    {{-- EDITAR --}}

    <div class="text-center mt-2">

        <a href="{{ route(
                'inventarios.edit',
                $inventario->id_inventario
            ) }}"

           class="btn btn-sm btn-outline-primary"

           onclick="event.stopPropagation();">

            <i class="fas fa-edit"></i>

            Editar

        </a>

    </div>

</div>