<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Venta;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTA DE DEVOLUCIONES
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $devoluciones = Devolucion::with([
            'venta.pedido.reserva.cliente',
            'producto'
        ])
        ->orderBy('id_devolucion', 'desc')
        ->get();

        return view(
            'devoluciones.index',
            compact('devoluciones')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREAR DEVOLUCIÓN
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $ventas = Venta::with([
            'pedido.reserva.cliente',
            'pedido.reserva.detalleReservas.producto'
        ])
        ->orderBy('id_venta', 'desc')
        ->get();

        return view(
            'devoluciones.create',
            compact('ventas')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR DEVOLUCIÓN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
            'fecha_devolucion' => 'required|date',
        ]);


        Devolucion::create([
            'id_venta' => $request->id_venta,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'motivo' => $request->motivo,
            'estado' => $request->estado,
            'fecha_devolucion' => $request->fecha_devolucion,
        ]);


        return redirect()
            ->route('devoluciones.index')
            ->with(
                'success',
                'Devolución registrada correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR DEVOLUCIÓN
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $devolucion = Devolucion::with([
            'venta.pedido.reserva.cliente',
            'producto'
        ])
        ->findOrFail($id);


        $ventas = Venta::with([
            'pedido.reserva.cliente',
            'pedido.reserva.detalleReservas.producto'
        ])
        ->orderBy('id_venta', 'desc')
        ->get();


        return view(
            'devoluciones.edit',
            compact(
                'devolucion',
                'ventas'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR DEVOLUCIÓN
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {

        $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
            'fecha_devolucion' => 'required|date',
        ]);


        $devolucion = Devolucion::findOrFail($id);


        $devolucion->update([
            'id_venta' => $request->id_venta,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'motivo' => $request->motivo,
            'estado' => $request->estado,
            'fecha_devolucion' => $request->fecha_devolucion,
        ]);


        return redirect()
            ->route('devoluciones.index')
            ->with(
                'success',
                'Devolución actualizada correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR DEVOLUCIÓN
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $devolucion = Devolucion::findOrFail($id);

        $devolucion->delete();


        return redirect()
            ->route('devoluciones.index')
            ->with(
                'success',
                'Devolución eliminada correctamente.'
            );
    }
}