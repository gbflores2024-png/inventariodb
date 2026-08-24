<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Pedido;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('pedido')->get();

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $pedidos = Pedido::all();

        return view('ventas.create', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required',
            'fecha_venta' => 'required',
            'total' => 'required'
        ]);

        Venta::create($request->all());

        return redirect()->route('ventas.index');
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);

        $pedidos = Pedido::all();

        return view('ventas.edit', compact('venta', 'pedidos'));
    }

    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);

        $venta->update($request->all());

        return redirect()->route('ventas.index');
    }

    public function destroy($id)
    {
        Venta::destroy($id);

        return redirect()->route('ventas.index');
    }
}