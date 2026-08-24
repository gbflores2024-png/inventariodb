<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
 public function index()
{
    $categorias = Categoria::all();

    return view('categorias.index', compact('categorias'));
}

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        Categoria::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('categorias.index');
    }

 public function edit($id)
{
    $categoria = Categoria::findOrFail($id);

    return view('categorias.edit', compact('categoria'));
}

   public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required'
    ]);

    $categoria = Categoria::findOrFail($id);

    $categoria->update([
        'nombre' => $request->nombre
    ]);

    return redirect()->route('categorias.index');
}

 public function destroy($id)
{
    $categoria = Categoria::findOrFail($id);

    if ($categoria->productos()->count() > 0)
    {
        return redirect()
            ->route('categorias.index')
            ->with(
                'error',
                'No se puede eliminar la categoría porque tiene productos asociados.'
            );
    }

    $categoria->delete();

    return redirect()
        ->route('categorias.index')
        ->with(
            'success',
            'Categoría eliminada correctamente.'
        );
}
}