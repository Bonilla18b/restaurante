<?php

namespace App\Http\Controllers;

use App\Models\MetodoDePago;
use Illuminate\Http\Request;

class MetodoDePagoController extends Controller
{
    public function index()
    {
        $metodos = MetodoDePago::all();
        return view('metodos_pago.index', compact('metodos'));
    }

    public function create()
    {
        return view('metodos_pago.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:metodos_de_pagos,nombre|max:100',
        ]);

        MetodoDePago::create($validated);
        return redirect()->route('metodos-pago.index')->with('success', 'Método de pago creado.');
    }

    public function show(MetodoDePago $metodo_pago)
    {
        return view('metodos_pago.show', compact('metodo_pago'));
    }

    public function edit(MetodoDePago $metodo_pago)
    {
        return view('metodos_pago.edit', compact('metodo_pago'));
    }

    public function update(Request $request, MetodoDePago $metodo_pago)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:metodos_de_pagos,nombre,' . $metodo_pago->id . '|max:100',
        ]);

        $metodo_pago->update($validated);
        return redirect()->route('metodos-pago.index')->with('success', 'Método de pago actualizado.');
    }

    public function destroy(MetodoDePago $metodo_pago)
    {
        $metodo_pago->delete();
        return redirect()->route('metodos-pago.index')->with('success', 'Método de pago eliminado.');
    }
}