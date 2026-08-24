<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Reserva;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('reserva')->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $reservas = Reserva::all();

        return view('pedidos.create', compact('reservas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_reserva' => 'required',
            'fecha_pedido' => 'required',
            'estado' => 'required'
        ]);

        Pedido::create($request->all());

        return redirect()->route('pedidos.index');
    }

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);

        $reservas = Reserva::all();

        return view('pedidos.edit', compact('pedido', 'reservas'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index');
    }

    public function destroy($id)
    {
        Pedido::destroy($id);

        return redirect()->route('pedidos.index');
    }
}