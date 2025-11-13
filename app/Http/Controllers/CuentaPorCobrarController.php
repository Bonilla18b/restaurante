<?php

namespace App\Http\Controllers;

use App\Models\CuentaPorCobrar;
use App\Models\Factura;
use App\Models\MetodoDePago;
use Illuminate\Http\Request;

class CuentaPorCobrarController extends Controller
{
    public function index()
    {
        $cuentas = CuentaPorCobrar::with('factura.cliente.persona', 'metodoDePago')->get();
        return view('cuentas_cobrar.index', compact('cuentas'));
    }

    public function create()
    {
        $facturas = Factura::where('estado', 'Emitida')->get(); // Solo facturas emitidas
        $metodos = MetodoDePago::all();
        return view('cuentas_cobrar.create', compact('facturas', 'metodos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'metodo_de_pago_id' => 'required|exists:metodos_de_pagos,id',
            'factura_id' => 'required|exists:facturas,id|unique:cuentas_por_cobrar,factura_id',
            'montoPagado' => 'required|numeric|min:0',
            'montoTotal' => 'required|numeric|min:0|gte:montoPagado',
            'fechaVencimiento' => 'required|date',
            'estado' => 'required|string|in:Cobrada,Pendiente,Vencida',
            'descripcion' => 'nullable|string',
        ]);
        
        $validated['montoPendiente'] = $validated['montoTotal'] - $validated['montoPagado'];

        CuentaPorCobrar::create($validated);
        return redirect()->route('cuentas-cobrar.index')->with('success', 'Cuenta por cobrar creada.');
    }

    public function show(CuentaPorCobrar $cuenta_por_cobrar)
    {
        return view('cuentas_cobrar.show', compact('cuenta_por_cobrar'));
    }

    public function edit(CuentaPorCobrar $cuenta_por_cobrar)
    {
        $facturas = Factura::all();
        $metodos = MetodoDePago::all();
        return view('cuentas_cobrar.edit', compact('cuenta_por_cobrar', 'facturas', 'metodos'));
    }

    public function update(Request $request, CuentaPorCobrar $cuenta_por_cobrar)
    {
        $validated = $request->validate([
            'montoPagado' => 'required|numeric|min:0',
            'montoTotal' => 'required|numeric|min:0|gte:montoPagado',
            'fechaVencimiento' => 'required|date',
            'estado' => 'required|string|in:Cobrada,Pendiente,Vencida',
            'descripcion' => 'nullable|string',
        ]);
        
        $validated['montoPendiente'] = $validated['montoTotal'] - $validated['montoPagado'];

        $cuenta_por_cobrar->update($validated);
        return redirect()->route('cuentas-cobrar.index')->with('success', 'Cuenta por cobrar actualizada.');
    }

    public function destroy(CuentaPorCobrar $cuenta_por_cobrar)
    {
        $cuenta_por_cobrar->delete();
        return redirect()->route('cuentas-cobrar.index')->with('success', 'Cuenta por cobrar eliminada.');
    }
}