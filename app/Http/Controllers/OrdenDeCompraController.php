<?php

namespace App\Http\Controllers;

use App\Models\OrdenDeCompra;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class OrdenDeCompraController extends Controller
{
    public function index()
    {
        $ordenes = OrdenDeCompra::with('proveedor')->get();
        return view('ordenes_compra.index', compact('ordenes'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('ordenes_compra.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'nOrden' => 'required|string|unique:ordenes_compras,nOrden|max:50',
            'estado' => 'required|string|in:Pendiente,Recibida,Cancelada',
            'registradoPor' => 'nullable|string|max:100',
        ]);

        OrdenDeCompra::create($validated);
        return redirect()->route('ordenes-compra.index')->with('success', 'Orden de compra creada.');
    }

    public function show(OrdenDeCompra $orden_compra)
    {
        // Carga los detalles de la orden
        $orden_compra->load('detallesCompra.producto'); 
        return view('ordenes_compra.show', compact('orden_compra'));
    }

    public function edit(OrdenDeCompra $orden_compra)
    {
        $proveedores = Proveedor::all();
        return view('ordenes_compra.edit', compact('orden_compra', 'proveedores'));
    }

    public function update(Request $request, OrdenDeCompra $orden_compra)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'nOrden' => 'required|string|unique:ordenes_compras,nOrden,' . $orden_compra->id . '|max:50',
            'estado' => 'required|string|in:Pendiente,Recibida,Cancelada',
        ]);

        $orden_compra->update($validated);
        return redirect()->route('ordenes-compra.index')->with('success', 'Orden de compra actualizada.');
    }

    public function destroy(OrdenDeCompra $orden_compra)
    {
        $orden_compra->delete();
        return redirect()->route('ordenes-compra.index')->with('success', 'Orden de compra eliminada.');
    }
}