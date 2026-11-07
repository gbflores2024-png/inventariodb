<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use App\Models\ProductoVariante;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTA DE INVENTARIO
    |--------------------------------------------------------------------------
    */

    
    /*
    |--------------------------------------------------------------------------
    | LISTA DE INVENTARIO
    |--------------------------------------------------------------------------
    */

    // MODIFICADO: permitir filtrar inventarios por variante
    // y registros antiguos sin modificar la base de datos.
    public function index(Request $request)
    {
        // NUEVO: validar el filtro recibido.
        $datos = $request->validate([
            'tipo' => [
                'nullable',
                'in:todos,variantes,antiguos'
            ],
        ]);

        // NUEVO: mostrar todos inicialmente.
        $tipo = $datos['tipo'] ?? 'todos';

        // MODIFICADO: cargar producto, variante,
        // talla y color del catálogo.
        $consulta = Inventario::with([
            'producto',
            'variante.tallaCatalogo',
            'variante.colorCatalogo',
        ]);

        // NUEVO: inventarios relacionados con variantes.
        if ($tipo === 'variantes') {
            $consulta->whereNotNull('id_variante');
        }

        // NUEVO: inventarios antiguos sin variante.
        if ($tipo === 'antiguos') {
            $consulta->whereNull('id_variante');
        }

        // MODIFICADO: ordenar por ID.
        $inventarios = $consulta
            ->orderBy('id_inventario')
            ->get();

        return view(
            'inventarios.index',
            compact('inventarios', 'tipo')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | INVENTARIO DINÁMICO
    |--------------------------------------------------------------------------
    */

  
    // MODIFICADO: Inventario dinámico por variantes.
    public function dinamico(Request $request)
    {
        // NUEVO: validar los filtros opcionales.
        $filtros = $request->validate([
            'id_producto' => ['nullable', 'integer', 'exists:productos,id_producto'],
            'id_talla' => ['nullable', 'integer', 'exists:tallas,id_talla'],
            'id_color' => ['nullable', 'integer', 'exists:colores,id_color'],
        ]);

        // NUEVO: cargar solo inventarios con variante.
        $consulta = Inventario::with([
            'producto',
            'variante.producto',
            'variante.tallaCatalogo',
            'variante.colorCatalogo',
        ])->whereNotNull('id_variante');

        // NUEVO: filtrar por producto.
        if (!empty($filtros['id_producto'])) {
            $consulta->whereHas('variante', function ($query) use ($filtros) {
                $query->where('id_producto', $filtros['id_producto']);
            });
        }

        // NUEVO: filtrar por talla.
        if (!empty($filtros['id_talla'])) {
            $consulta->whereHas('variante', function ($query) use ($filtros) {
                $query->where('id_talla', $filtros['id_talla']);
            });
        }

        // NUEVO: filtrar por color.
        if (!empty($filtros['id_color'])) {
            $consulta->whereHas('variante', function ($query) use ($filtros) {
                $query->where('id_color', $filtros['id_color']);
            });
        }

        // MODIFICADO: obtener los registros filtrados.
        $inventarios = $consulta
            ->orderBy('id_inventario')
            ->get();

        // MODIFICADO: calcular indicadores de las variantes filtradas.
        $totalProductos = $inventarios->count();

        $stockDisponible = $inventarios->sum('stock_disponible');

        $stockReservado = $inventarios->sum('stock_reservado');

        $stockMinimo = $inventarios->sum('stock_minimo');

        $stockBajo = $inventarios->filter(function ($inventario) {
            return $inventario->stock_disponible
                <= $inventario->stock_minimo;
        })->count();

        // NUEVO: catálogos para los filtros de la vista.
        $productos = \App\Models\Producto::orderBy('nombre')->get();

        $tallas = \App\Models\Talla::orderBy('id_talla')->get();

        $colores = \App\Models\Color::orderBy('nombre')->get();

        return view(
            'inventarios.dinamico',
            compact(
                'inventarios',
                'totalProductos',
                'stockDisponible',
                'stockReservado',
                'stockMinimo',
                'stockBajo',
                'productos',
                'tallas',
                'colores'
            )
        );
    }



    /*
    |--------------------------------------------------------------------------
    | CREAR INVENTARIO
    |--------------------------------------------------------------------------
    */
// MODIFICADO: cargar variantes con sus tallas y colores.
public function create()
{
    $productos = Producto::orderBy('nombre')->get();

    $variantes = ProductoVariante::with([
        'producto',
        'tallaCatalogo',
        'colorCatalogo'
    ])
    ->orderBy('id_producto')
    ->get();

    return view(
        'inventarios.create',
        compact('productos', 'variantes')
    );
}


    /*
    |--------------------------------------------------------------------------
    | GUARDAR INVENTARIO
    |--------------------------------------------------------------------------
    */

    // MODIFICADO: registrar inventario por variante.
public function store(Request $request)
{
    // NUEVO: validar únicamente los datos necesarios.
    $datos = $request->validate([
        'id_variante' => [
            'required',
            'integer',
            'exists:producto_variantes,id_variante',
        ],
        'inventario_fisico' => [
            'required',
            'integer',
            'min:0',
        ],
        'stock_minimo' => [
            'required',
            'integer',
            'min:0',
        ],
    ]);

    // NUEVO: recuperar la variante seleccionada.
    $variante = ProductoVariante::findOrFail(
        $datos['id_variante']
    );

    // NUEVO: impedir inventarios duplicados.
    $existe = Inventario::where(
        'id_variante',
        $variante->id_variante
    )->exists();

    if ($existe) {
        return back()
            ->withErrors([
                'id_variante' =>
                    'Esta variante ya tiene inventario registrado.'
            ])
            ->withInput();
    }

    // NUEVO: registrar inventario inicial.
    Inventario::create([
        'id_producto' => $variante->id_producto,
        'id_variante' => $variante->id_variante,
        'inventario_fisico' => $datos['inventario_fisico'],
        'stock_disponible' => $datos['inventario_fisico'],
        'stock_reservado' => 0,
        'stock_minimo' => $datos['stock_minimo'],
        'fecha_actualizacion' => now(),
    ]);

    return redirect()
        ->route('inventarios.index')
        ->with(
            'success',
            'Inventario registrado correctamente.'
        );
}

    /*
    |--------------------------------------------------------------------------
    | EDITAR INVENTARIO
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);

        // Productos
        $productos = Producto::all();

        // Variantes
        $variantes = ProductoVariante::with('producto')->get();

        return view(
            'inventarios.edit',
            compact(
                'inventario',
                'productos',
                'variantes'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR INVENTARIO
    |--------------------------------------------------------------------------
    */

    
    // MODIFICADO: actualización segura del inventario.
    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'inventario_fisico' => [
                'required',
                'integer',
                'min:0',
            ],
            'stock_minimo' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        // NUEVO: bloquear el registro durante la actualización.
        return \Illuminate\Support\Facades\DB::transaction(
            function () use ($id, $datos) {

                $inventario = Inventario::where(
                    'id_inventario', $id
                )->lockForUpdate()->firstOrFail();

                $fisicoNuevo = (int) $datos['inventario_fisico'];

                // NUEVO: no modificar cantidad física si hay reservas.
                if (
                    $inventario->stock_reservado > 0 &&
                    $fisicoNuevo !== (int) $inventario->inventario_fisico
                ) {
                    return back()->withErrors([
                        'inventario_fisico' =>
                            'No puedes modificar el inventario físico mientras existan unidades reservadas.'
                    ])->withInput();
                }

                // NUEVO: proteger inventarios antiguos inconsistentes.
                if (
                    (int) $inventario->inventario_fisico !==
                    (int) $inventario->stock_disponible +
                    (int) $inventario->stock_reservado
                ) {
                    // Solo permitimos modificar el stock mínimo.
                    if (
                        $fisicoNuevo !==
                        (int) $inventario->inventario_fisico
                    ) {
                        return back()->withErrors([
                            'inventario_fisico' =>
                                'Este inventario tiene cantidades inconsistentes. Primero debemos revisar sus movimientos.'
                        ])->withInput();
                    }

                    $inventario->stock_minimo = $datos['stock_minimo'];
                    $inventario->save();

                    return redirect()
                        ->route('inventarios.index')
                        ->with(
                            'success',
                            'Stock mínimo actualizado. Las cantidades anteriores se conservaron.'
                        );
                }

                // MODIFICADO: recalcular stock disponible.
                $inventario->inventario_fisico = $fisicoNuevo;
                $inventario->stock_disponible =
                    $fisicoNuevo - $inventario->stock_reservado;

                $inventario->stock_minimo = $datos['stock_minimo'];

                $inventario->save();

                return redirect()
                    ->route('inventarios.index')
                    ->with(
                        'success',
                        'Inventario actualizado correctamente.'
                    );
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR INVENTARIO
    |--------------------------------------------------------------------------
    */

    
    /*
    |--------------------------------------------------------------------------
    | ELIMINAR INVENTARIO
    |--------------------------------------------------------------------------
    */

    // MODIFICADO: proteger la eliminación de inventarios.
    public function destroy($id)
    {
        // NUEVO: bloquear el registro durante la comprobación.
        return \Illuminate\Support\Facades\DB::transaction(
            function () use ($id) {

                $inventario = Inventario::where(
                    'id_inventario', $id
                )->lockForUpdate()->firstOrFail();

                // NUEVO: no eliminar inventarios antiguos
                // que todavía no tienen variante.
                if ($inventario->id_variante === null) {
                    return redirect()
                        ->route('inventarios.index')
                        ->with(
                            'error',
                            'Este inventario antiguo debe revisarse antes de eliminarlo.'
                        );
                }

                // NUEVO: impedir eliminar existencias.
                if (
                    $inventario->inventario_fisico > 0 ||
                    $inventario->stock_disponible > 0 ||
                    $inventario->stock_reservado > 0
                ) {
                    return redirect()
                        ->route('inventarios.index')
                        ->with(
                            'error',
                            'No se puede eliminar un inventario que tiene existencias o unidades reservadas.'
                        );
                }

                // NUEVO: por ahora, no eliminar registros
                // sin revisar previamente sus movimientos.
                return redirect()
                    ->route('inventarios.index')
                    ->with(
                        'error',
                        'La eliminación de inventarios está deshabilitada hasta implementar el historial de movimientos.'
                    );
            }
        );
    }

}