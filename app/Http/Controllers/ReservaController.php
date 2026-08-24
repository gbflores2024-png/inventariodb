<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('cliente')->get();

        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $clientes = Cliente::all();

        return view('reservas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required',
            'fecha_reserva' => 'required',
            'estado' => 'required',
            'total' => 'required'
        ]);

        Reserva::create([
            'id_cliente' => $request->id_cliente,
            'fecha_reserva' => $request->fecha_reserva,
            'estado' => $request->estado,
            'total' => $request->total
        ]);

        return redirect()->route('reservas.index');
    }

    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);

        $clientes = Cliente::all();

        return view('reservas.edit',
            compact('reserva', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required',
            'fecha_reserva' => 'required',
            'estado' => 'required',
            'total' => 'required'
        ]);

        $reserva = Reserva::findOrFail($id);

        $reserva->update([
            'id_cliente' => $request->id_cliente,
            'fecha_reserva' => $request->fecha_reserva,
            'estado' => $request->estado,
            'total' => $request->total
        ]);

        return redirect()->route('reservas.index');
    }

    public function destroy($id)
    {
        Reserva::destroy($id);

        return redirect()->route('reservas.index');
    }
}