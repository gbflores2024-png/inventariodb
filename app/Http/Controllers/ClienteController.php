<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required'
        ]);

        Cliente::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion
        ]);

        return redirect()->route('clientes.index');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        $cliente->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion
        ]);

        return redirect()->route('clientes.index');
    }

    public function destroy($id)
    {
        Cliente::destroy($id);

        return redirect()->route('clientes.index');
    }
}