<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Pedido;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTA DE VENTAS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $ventas = Venta::with([
            'pedido.reserva.cliente'
        ])
        ->orderBy('id_venta', 'desc')
        ->get();

        return view('ventas.index', compact('ventas'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREAR VENTA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $pedidos = Pedido::with([
            'reserva.cliente',
            'reserva.detalleReservas.producto'
        ])
        ->orderBy('id_pedido', 'desc')
        ->get();

        return view('ventas.create', compact('pedidos'));
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR VENTA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id_pedido',
            'fecha_venta' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);


        Venta::create([
            'id_pedido' => $request->id_pedido,
            'fecha_venta' => $request->fecha_venta,
            'total' => $request->total,
        ]);


        return redirect()
            ->route('ventas.index')
            ->with(
                'success',
                'Venta registrada correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR VENTA
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $venta = Venta::with([
            'pedido.reserva.cliente'
        ])->findOrFail($id);


        $pedidos = Pedido::with([
            'reserva.cliente'
        ])
        ->orderBy('id_pedido', 'desc')
        ->get();


        return view(
            'ventas.edit',
            compact(
                'venta',
                'pedidos'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR VENTA
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {

        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id_pedido',
            'fecha_venta' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);


        $venta = Venta::findOrFail($id);


        $venta->update([
            'id_pedido' => $request->id_pedido,
            'fecha_venta' => $request->fecha_venta,
            'total' => $request->total,
        ]);


        return redirect()
            ->route('ventas.index')
            ->with(
                'success',
                'Venta actualizada correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR VENTA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        $venta->delete();


        return redirect()
            ->route('ventas.index')
            ->with(
                'success',
                'Venta eliminada correctamente.'
            );
    }
}