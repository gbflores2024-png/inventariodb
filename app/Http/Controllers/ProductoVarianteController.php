<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoVariante;
use App\Models\Talla; // NUEVO
use App\Models\Color; // NUEVO
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // NUEVO
use Illuminate\Validation\ValidationException; // NUEVO

class ProductoVarianteController extends Controller
{
    // MODIFICADO: cargar relaciones con los catálogos.
    public function index()
    {
        $variantes = ProductoVariante::with([
            'producto',
            'inventario',
            'tallaCatalogo',
            'colorCatalogo'
        ])->get();

        return view(
            'producto_variantes.index',
            compact('variantes')
        );
    }

    // MODIFICADO: enviar tallas y colores al formulario.
    public function create()
    {
        $productos = Producto::orderBy('nombre')->get();
        $tallas = Talla::orderBy('grupo')
            ->orderBy('id_talla')->get();
        $colores = Color::orderBy('nombre')->get();

        return view(
            'producto_variantes.create',
            compact('productos', 'tallas', 'colores')
        );
    }

    public function store(Request $request)
    {
        // MODIFICADO: validar identificadores de catálogos.
        $datos = $request->validate([
            'id_producto' => [
                'required', 'integer',
                'exists:productos,id_producto'
            ],
            'id_talla' => [
                'required', 'integer',
                'exists:tallas,id_talla'
            ],
            'id_color' => [
                'required', 'integer',
                'exists:colores,id_color'
            ],
            'precio' => [
                'required', 'numeric',
                'min:0', 'max:99999999.99'
            ],
        ]);

        // NUEVO: comprobar combinaciones repetidas.
        $existe = ProductoVariante::where(
            'id_producto', $datos['id_producto']
        )
        ->where('id_talla', $datos['id_talla'])
        ->where('id_color', $datos['id_color'])
        ->exists();

        if ($existe) {
            throw ValidationException::withMessages([
                'id_talla' =>
                    'Esta combinación de producto, talla y color ya existe.'
            ]);
        }

        // NUEVO: recuperar nombres desde los catálogos.
        $talla = Talla::findOrFail($datos['id_talla']);
        $color = Color::findOrFail($datos['id_color']);

        // NUEVO: transacción para guardar consistentemente.
        DB::transaction(function () use ($datos, $talla, $color) {
            ProductoVariante::create([
                'id_producto' => $datos['id_producto'],
                'id_talla' => $talla->id_talla,
                'id_color' => $color->id_color,
                'precio' => $datos['precio'],

                // TEMPORAL: compatibilidad con MySQL.
                'talla' => $talla->nombre,
                'color' => $color->nombre,
            ]);
        });

        return redirect()
            ->route('producto-variantes.index')
            ->with('success', 'Variante registrada correctamente.');
    }

    // MODIFICADO: cargar catálogos al editar.
    public function edit($id)
    {
        $variante = ProductoVariante::findOrFail($id);
        $productos = Producto::orderBy('nombre')->get();
        $tallas = Talla::orderBy('grupo')
            ->orderBy('id_talla')->get();
        $colores = Color::orderBy('nombre')->get();

        return view(
            'producto_variantes.edit',
            compact('variante', 'productos', 'tallas', 'colores')
        );
    }

    public function update(Request $request, $id)
    {
        $variante = ProductoVariante::findOrFail($id);

        // MODIFICADO: validar claves foráneas.
        $datos = $request->validate([
            'id_producto' => [
                'required', 'integer',
                'exists:productos,id_producto'
            ],
            'id_talla' => [
                'required', 'integer',
                'exists:tallas,id_talla'
            ],
            'id_color' => [
                'required', 'integer',
                'exists:colores,id_color'
            ],
            'precio' => [
                'required', 'numeric',
                'min:0', 'max:99999999.99'
            ],
        ]);

        // NUEVO: evitar duplicados, excluyendo el actual.
        $existe = ProductoVariante::where(
            'id_producto', $datos['id_producto']
        )
        ->where('id_talla', $datos['id_talla'])
        ->where('id_color', $datos['id_color'])
        ->where('id_variante', '!=', $id)
        ->exists();

        if ($existe) {
            throw ValidationException::withMessages([
                'id_talla' =>
                    'Ya existe esta combinación de producto, talla y color.'
            ]);
        }

        $talla = Talla::findOrFail($datos['id_talla']);
        $color = Color::findOrFail($datos['id_color']);

        // NUEVO: proteger variantes con inventario asociado.
        if ($variante->inventario()->exists()) {
            $cambioIdentidad =
                (int) $variante->id_producto !==
                    (int) $datos['id_producto']
                || (int) $variante->id_talla !==
                    (int) $datos['id_talla']
                || (int) $variante->id_color !==
                    (int) $datos['id_color'];

            if ($cambioIdentidad) {
                throw ValidationException::withMessages([
                    'id_talla' =>
                        'La variante tiene inventario asociado. Solo puedes modificar su precio.'
                ]);
            }
        }

        // MODIFICADO: actualizar ambas representaciones.
        $variante->update([
            'id_producto' => $datos['id_producto'],
            'id_talla' => $datos['id_talla'],
            'id_color' => $datos['id_color'],
            'precio' => $datos['precio'],

            // TEMPORAL: columnas antiguas.
            'talla' => $talla->nombre,
            'color' => $color->nombre,
        ]);

        return redirect()
            ->route('producto-variantes.index')
            ->with('success', 'Variante actualizada correctamente.');
    }

    public function destroy($id)
    {
        $variante = ProductoVariante::findOrFail($id);

        // MODIFICADO: evitar eliminar inventario asociado.
        if ($variante->inventario()->exists()) {
            return redirect()
                ->route('producto-variantes.index')
                ->with(
                    'error',
                    'No se puede eliminar una variante con inventario asociado.'
                );
        }

        // IMPORTANTE: revisar también otras referencias
        // transaccionales antes de permitir el borrado.
        $variante->delete();

        return redirect()
            ->route('producto-variantes.index')
            ->with('success', 'Variante eliminada correctamente.');
    }
}
