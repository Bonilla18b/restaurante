<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('cliente.persona')->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $clientes = Cliente::with('persona')->get();
        return view('facturas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'nFactura' => 'required|string|unique:facturas,nFactura|max:50',
            'estado' => 'required|string|in:Emitida,Pagada,Anulada',
            'descuentoTotal' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'pago' => 'required|string|in:Contado,Crédito',
            'metodoDePago' => 'required|string|max:100',
            'registradoPor' => 'nullable|string|max:100',
        ]);

        Factura::create($validated);
        return redirect()->route('facturas.index')->with('success', 'Factura creada.');
    }

    public function show(Factura $factura)
    {
        $factura->load('detallesFactura');
        return view('facturas.show', compact('factura'));
    }

    public function edit(Factura $factura)
    {
        $clientes = Cliente::with('persona')->get();
        return view('facturas.edit', compact('factura', 'clientes'));
    }

    public function update(Request $request, Factura $factura)
    {
        $validated = $request->validate([
            'estado' => 'required|string|in:Emitida,Pagada,Anulada',
            'descuentoTotal' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'pago' => 'required|string|in:Contado,Crédito',
            'metodoDePago' => 'required|string|max:100',
        ]);

        $factura->update($validated);
        return redirect()->route('facturas.index')->with('success', 'Factura actualizada.');
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada.');
    }
}