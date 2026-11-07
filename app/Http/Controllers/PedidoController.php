<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Reserva;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR PEDIDOS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pedidos = Pedido::with([
            'reserva.cliente'
        ])
        ->orderBy('id_pedido', 'desc')
        ->get();

        return view('pedidos.index', compact('pedidos'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREAR PEDIDO
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $reservas = Reserva::with('cliente')
            ->orderBy('id_reserva', 'desc')
            ->get();

        return view('pedidos.create', compact('reservas'));
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR PEDIDO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'id_reserva' => 'required|exists:reservas,id_reserva',
            'fecha_pedido' => 'required|date',
            'estado' => 'required|in:PREPARANDO,LISTO_RECOJO,ENTREGADO,CANCELADO',
        ]);

        Pedido::create([
            'id_reserva' => $request->id_reserva,
            'fecha_pedido' => $request->fecha_pedido,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('pedidos.index')
            ->with(
                'success',
                'Pedido registrado correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR PEDIDO
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);

        $reservas = Reserva::with('cliente')
            ->orderBy('id_reserva', 'desc')
            ->get();

        return view(
            'pedidos.edit',
            compact('pedido', 'reservas')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR PEDIDO
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_reserva' => 'required|exists:reservas,id_reserva',
            'fecha_pedido' => 'required|date',
            'estado' => 'required|in:PREPARANDO,LISTO_RECOJO,ENTREGADO,CANCELADO',
        ]);

        $pedido = Pedido::findOrFail($id);

        $pedido->update([
            'id_reserva' => $request->id_reserva,
            'fecha_pedido' => $request->fecha_pedido,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('pedidos.index')
            ->with(
                'success',
                'Pedido actualizado correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR PEDIDO
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->delete();

        return redirect()
            ->route('pedidos.index')
            ->with(
                'success',
                'Pedido eliminado correctamente.'
            );
    }
}