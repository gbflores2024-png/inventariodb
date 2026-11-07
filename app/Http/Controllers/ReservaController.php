<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTA DE RESERVAS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $reservas = Reserva::with([
            'cliente',
            'detalleReservas.producto'
        ])
        ->orderBy('id_reserva', 'desc')
        ->get();

        return view('reservas.index', compact('reservas'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREAR RESERVA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();

        $productos = Producto::orderBy('nombre')->get();

        return view(
            'reservas.create',
            compact('clientes', 'productos')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR RESERVA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'fecha_reserva' => 'required|date',
            'estado' => 'required|string',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);


        DB::transaction(function () use ($request) {

            /*
            |--------------------------------------------------------------------------
            | CALCULAR TOTAL
            |--------------------------------------------------------------------------
            */

            $total = 0;

            foreach ($request->productos as $item) {

                $producto = Producto::findOrFail(
                    $item['id_producto']
                );

                $cantidad = (int) $item['cantidad'];

                $subtotal = $producto->precio * $cantidad;

                $total += $subtotal;
            }


            /*
            |--------------------------------------------------------------------------
            | CREAR RESERVA
            |--------------------------------------------------------------------------
            */

            $reserva = Reserva::create([
                'id_cliente' => $request->id_cliente,
                'fecha_reserva' => $request->fecha_reserva,
                'estado' => $request->estado,
                'total' => $total,
            ]);


            /*
            |--------------------------------------------------------------------------
            | GUARDAR DETALLE DE RESERVA
            |--------------------------------------------------------------------------
            */

            foreach ($request->productos as $item) {

                $producto = Producto::findOrFail(
                    $item['id_producto']
                );

                $cantidad = (int) $item['cantidad'];

                $precio = $producto->precio;

                $subtotal = $precio * $cantidad;


                $reserva->detalleReservas()->create([
                    'id_producto' => $producto->id_producto,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                    'subtotal' => $subtotal,
                ]);
            }
        });


        return redirect()
            ->route('reservas.index')
            ->with(
                'success',
                'Reserva registrada correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR RESERVA
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $reserva = Reserva::with([
            'cliente',
            'detalleReservas.producto'
        ])->findOrFail($id);

        $clientes = Cliente::orderBy('nombre')->get();

        $productos = Producto::orderBy('nombre')->get();

        return view(
            'reservas.edit',
            compact(
                'reserva',
                'clientes',
                'productos'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR RESERVA
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'fecha_reserva' => 'required|date',
            'estado' => 'required|string',
            'total' => 'required|numeric|min:0',
        ]);


        $reserva = Reserva::findOrFail($id);


        $reserva->update([
            'id_cliente' => $request->id_cliente,
            'fecha_reserva' => $request->fecha_reserva,
            'estado' => $request->estado,
            'total' => $request->total,
        ]);


        return redirect()
            ->route('reservas.index')
            ->with(
                'success',
                'Reserva actualizada correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR RESERVA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
{
    $reserva = Reserva::findOrFail($id);

    // Eliminar primero los detalles de la reserva
    $reserva->detalleReservas()->delete();

    // Luego eliminar la reserva
    $reserva->delete();

    return redirect()
        ->route('reservas.index')
        ->with(
            'success',
            'Reserva eliminada correctamente.'
        );
}
}