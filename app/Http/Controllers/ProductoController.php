<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'talla' => 'required',
            'color' => 'required',
            'precio' => 'required',
            'id_categoria' => 'required'
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'talla' => $request->talla,
            'color' => $request->color,
            'precio' => $request->precio,
            'id_categoria' => $request->id_categoria
        ]);

        return redirect()->route('productos.index');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        $categorias = Categoria::all();

        return view(
            'productos.edit',
            compact('producto', 'categorias')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'talla' => 'required',
            'color' => 'required',
            'precio' => 'required',
            'id_categoria' => 'required'
        ]);

        $producto = Producto::findOrFail($id);

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'talla' => $request->talla,
            'color' => $request->color,
            'precio' => $request->precio,
            'id_categoria' => $request->id_categoria
        ]);

        return redirect()->route('productos.index');
    }

    public function destroy($id)
    {
        Producto::destroy($id);

        return redirect()->route('productos.index');
    }
}