<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    public function index()
    {
        $devoluciones = Devolucion::with(['venta','producto'])->get();

        return view('devoluciones.index', compact('devoluciones'));
    }

    public function create()
    {
        $ventas = Venta::all();
        $productos = Producto::all();

        return view('devoluciones.create', compact('ventas','productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_venta' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'motivo' => 'required',
            'estado' => 'required',
            'fecha_devolucion' => 'required'
        ]);

        Devolucion::create($request->all());

        return redirect()->route('devoluciones.index');
    }

    public function edit($id)
    {
        $devolucion = Devolucion::findOrFail($id);

        $ventas = Venta::all();
        $productos = Producto::all();

        return view('devoluciones.edit',
            compact('devolucion','ventas','productos'));
    }

    public function update(Request $request, $id)
    {
        $devolucion = Devolucion::findOrFail($id);

        $devolucion->update($request->all());

        return redirect()->route('devoluciones.index');
    }

    public function destroy($id)
    {
        Devolucion::destroy($id);

        return redirect()->route('devoluciones.index');
    }
}