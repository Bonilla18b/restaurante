<?php

namespace App\Http\Controllers;

use App\Models\CuentaPorPagar;
use App\Models\OrdenDeCompra;
use App\Models\MetodoDePago;
use Illuminate\Http\Request;

class CuentaPorPagarController extends Controller
{
    public function index()
    {
        $cuentas = CuentaPorPagar::with('ordenDeCompra.proveedor', 'metodoDePago')->get();
        return view('cuentas_pagar.index', compact('cuentas'));
    }

    public function create()
    {
        $ordenes = OrdenDeCompra::all();
        $metodos = MetodoDePago::all();
        return view('cuentas_pagar.create', compact('ordenes', 'metodos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'metodo_de_pago_id' => 'required|exists:metodos_de_pagos,id',
            'orden_de_compra_id' => 'required|exists:ordenes_compras,id|unique:cuentas_por_pagar,orden_de_compra_id',
            'montoPagado' => 'required|numeric|min:0',
            'montoTotal' => 'required|numeric|min:0|gte:montoPagado',
            'fechaVencimiento' => 'required|date',
            'estado' => 'required|string|in:Pagada,Pendiente,Vencida',
            'descripcion' => 'nullable|string',
        ]);
        
        $validated['montoPendiente'] = $validated['montoTotal'] - $validated['montoPagado'];

        CuentaPorPagar::create($validated);
        return redirect()->route('cuentas-pagar.index')->with('success', 'Cuenta por pagar creada.');
    }

    public function show(CuentaPorPagar $cuenta_por_pagar)
    {
        return view('cuentas_pagar.show', compact('cuenta_por_pagar'));
    }

    public function edit(CuentaPorPagar $cuenta_por_pagar)
    {
        $ordenes = OrdenDeCompra::all();
        $metodos = MetodoDePago::all();
        return view('cuentas_pagar.edit', compact('cuenta_por_pagar', 'ordenes', 'metodos'));
    }

    public function update(Request $request, CuentaPorPagar $cuenta_por_pagar)
    {
        $validated = $request->validate([
            'montoPagado' => 'required|numeric|min:0',
            'montoTotal' => 'required|numeric|min:0|gte:montoPagado',
            'fechaVencimiento' => 'required|date',
            'estado' => 'required|string|in:Pagada,Pendiente,Vencida',
            'descripcion' => 'nullable|string',
        ]);
        
        $validated['montoPendiente'] = $validated['montoTotal'] - $validated['montoPagado'];

        $cuenta_por_pagar->update($validated);
        return redirect()->route('cuentas-pagar.index')->with('success', 'Cuenta por pagar actualizada.');
    }

    public function destroy(CuentaPorPagar $cuenta_por_pagar)
    {
        $cuenta_por_pagar->delete();
        return redirect()->route('cuentas-pagar.index')->with('success', 'Cuenta por pagar eliminada.');
    }
}