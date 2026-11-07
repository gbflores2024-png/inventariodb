<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Auditoria;

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
        // VALIDACIÓN DE ENTRADAS - OWASP
        $datos = $request->validate([
            'nombre'       => 'required|string|max:150',
            'descripcion'  => 'required|string|max:500',
            'talla'        => 'required|string|max:10',
            'color'        => 'required|string|max:50',
            'precio'       => 'required|numeric|min:0|max:999999.99',
            'id_categoria' => 'required|integer|exists:categorias,id_categoria',
        ]);

        Producto::create($datos);

        Auditoria::create([
    'user_id' => auth()->id(),
    'accion' => 'CREAR',
    'modulo' => 'Productos',
    'descripcion' => 'Creó el producto: ' . $datos['nombre'],
    'ip' => $request->ip(),
]); 
        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto registrado correctamente.');
    
    
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
        // VALIDACIÓN DE ENTRADAS - OWASP
        $datos = $request->validate([
            'nombre'       => 'required|string|max:150',
            'descripcion'  => 'required|string|max:500',
            'talla'        => 'required|string|max:10',
            'color'        => 'required|string|max:50',
            'precio'       => 'required|numeric|min:0|max:999999.99',
            'id_categoria' => 'required|integer|exists:categorias,id_categoria',
        ]);

        $producto = Producto::findOrFail($id);

        $producto->update($datos);

        Auditoria::create([
    'user_id' => auth()->id(),
    'accion' => 'MODIFICAR',
    'modulo' => 'Productos',
    'descripcion' => 'Modificó el producto: ' . $producto->nombre,
    'ip' => $request->ip(),
]);
        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
{
    $producto = Producto::findOrFail($id);

    // Guardamos el nombre antes de eliminarlo
    $nombreProducto = $producto->nombre;

    // Eliminamos el producto
    $producto->delete();

    // AUDITORÍA DE SEGURIDAD
    Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ELIMINAR',
        'modulo' => 'Productos',
        'descripcion' => 'Eliminó el producto: ' . $nombreProducto,
        'ip' => request()->ip(),
    ]);

    return redirect()
        ->route('productos.index')
        ->with('success', 'Producto eliminado correctamente.');
}
}