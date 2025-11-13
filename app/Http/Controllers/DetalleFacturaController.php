<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use App\Models\Factura;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function index(Factura $factura)
    {
        $detalles = $factura->detallesFactura;
        return view('detalles_factura.index', compact('factura', 'detalles'));
    }

    public function store(Request $request, Factura $factura)
    {
        $validated = $request->validate([
            'cantidad' => 'required|integer|min:1',
            'precioUnitario' => 'required|numeric|min:0.01',
            'descuento' => 'nullable|numeric|min:0',
            // No validar subtotal, se calcula
        ]);
        
        $subtotal = $validated['cantidad'] * $validated['precioUnitario'];

        $factura->detallesFactura()->create([
            'cantidad' => $validated['cantidad'],
            'precioUnitario' => $validated['precioUnitario'],
            'subtotal' => $subtotal,
            'descuento' => $validated['descuento'] ?? 0,
            // 'registradoPor'
        ]);
        
        // **IMPORTANTE**: Recalcular el total de la Factura
        // Lógica para actualizar factura.total...
        $factura->recalculateTotal(); // Asumiendo que agregas este método al modelo Factura

        return redirect()->route('facturas.show', $factura)->with('success', 'Detalle agregado a la factura.');
    }

    // ... show, edit, update, destroy con lógica anidada y recalculo de total ...
    public function destroy(Factura $factura, DetalleFactura $detalle)
    {
        if ($detalle->factura_id !== $factura->id) {
            abort(404);
        }
        $detalle->delete();
        
        $factura->recalculateTotal(); // Asumiendo que agregas este método al modelo Factura
        
        return redirect()->route('facturas.show', $factura)->with('success', 'Detalle eliminado de la factura.');
    }
}