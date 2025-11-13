<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use App\Models\OrdenDeCompra;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    // Muestra los detalles de una orden específica (usando Route Model Binding anidado)
    public function index(OrdenDeCompra $orden_compra)
    {
        $detalles = $orden_compra->detallesCompra()->with('producto')->get();
        return view('detalles_compra.index', compact('orden_compra', 'detalles'));
    }

    public function create(OrdenDeCompra $orden_compra)
    {
        $productos = Producto::all();
        return view('detalles_compra.create', compact('orden_compra', 'productos'));
    }

    public function store(Request $request, OrdenDeCompra $orden_compra)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0.01',
        ]);

        $total = $validated['cantidad'] * $validated['precio'];

        $orden_compra->detallesCompra()->create([
            'producto_id' => $validated['producto_id'],
            'cantidad' => $validated['cantidad'],
            'precio' => $validated['precio'],
            'total' => $total,
            // 'registradoPor' y timestamps se manejan automáticamente
        ]);
        
        return redirect()->route('ordenes-compra.show', $orden_compra)->with('success', 'Detalle agregado.');
    }
    
    // ... show, edit, update, destroy manejarían el detalle específico ...
    // La sintaxis de las rutas anidadas es: route('ordenes-compra.detalles-compra.show', [orden_compra, detalle_compra])

    public function show(OrdenDeCompra $orden_compra, DetalleCompra $detalles_compra)
    {
        // Se asegura que el detalle pertenece a la orden_compra correcta
        if ($detalles_compra->orden_de_compra_id !== $orden_compra->id) {
            abort(404);
        }
        return view('detalles_compra.show', ['detalle' => $detalles_compra, 'orden_compra' => $orden_compra]);
    }
    
    // Y así sucesivamente para edit, update, y destroy
    public function destroy(OrdenDeCompra $orden_compra, DetalleCompra $detalles_compra)
    {
        if ($detalles_compra->orden_de_compra_id !== $orden_compra->id) {
            abort(404);
        }
        $detalles_compra->delete();
        return redirect()->route('ordenes-compra.show', $orden_compra)->with('success', 'Detalle eliminado.');
    }
}