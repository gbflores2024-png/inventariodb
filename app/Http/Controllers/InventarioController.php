<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::with('producto')->get();

        return view('inventarios.index', compact('inventarios'));
    }

    public function create()
    {
        $productos = Producto::all();

        return view('inventarios.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required',
            'inventario_fisico' => 'required',
            'stock_disponible' => 'required',
            'stock_reservado' => 'required',
            'stock_minimo' => 'required',
            'fecha_actualizacion' => 'required'
        ]);

        Inventario::create($request->all());

        return redirect()->route('inventarios.index');
    }

    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);

        $productos = Producto::all();

        return view(
            'inventarios.edit',
            compact('inventario', 'productos')
        );
    }

    public function update(Request $request, $id)
    {
        $inventario = Inventario::findOrFail($id);

        $inventario->update($request->all());

        return redirect()->route('inventarios.index');
    }

    public function destroy($id)
    {
        Inventario::destroy($id);

        return redirect()->route('inventarios.index');
    }
}