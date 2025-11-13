<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Menu;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        // En una aplicación real, esto manejaría una interfaz de punto de venta (POS)
        $menus = Menu::where('disponibilidad', true)->get();
        return view('pedidos.create', compact('menus')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // En una aplicación real, los detalles se guardarían juntos en una transacción
            'mesa' => 'required|integer|min:1',
            'estado' => 'required|string|in:Pendiente,En Cocina,Entregado,Cancelado',
            'subtotal' => 'required|numeric|min:0',
            'registradoPor' => 'nullable|string|max:100',
        ]);

        Pedido::create($validated);
        return redirect()->route('pedidos.index')->with('success', 'Pedido creado.');
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('detallesPedido.menu'); 
        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        $menus = Menu::all();
        return view('pedidos.edit', compact('pedido', 'menus'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'mesa' => 'required|integer|min:1',
            'estado' => 'required|string|in:Pendiente,En Cocina,Entregado,Cancelado',
            // El subtotal debería recalcularse a partir de los detalles, no tomarse directamente.
        ]);

        $pedido->update($validated);
        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado.');
    }
}