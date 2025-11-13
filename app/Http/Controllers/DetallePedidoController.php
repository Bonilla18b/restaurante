<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Menu;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function index(Pedido $pedido)
    {
        $detalles = $pedido->detallesPedido()->with('menu')->get();
        return view('detalles_pedido.index', compact('pedido', 'detalles'));
    }

    public function store(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:menus,id',
            'cantidad' => 'required|integer|min:1',
        ]);
        
        $menuItem = Menu::find($validated['producto_id']);
        $subtotal = $validated['cantidad'] * $menuItem->precio;

        $pedido->detallesPedido()->create([
            'menu_id' => $validated['producto_id'], // Usando id_productos en tu modelo
            'cantidad' => $validated['cantidad'],
            'subtotal' => $subtotal,
            // 'registradoPor' y timestamps
        ]);
        
        // **IMPORTANTE**: Recalcular el subtotal del Pedido después de agregar el detalle
        $pedido->subtotal = $pedido->detallesPedido()->sum('subtotal');
        $pedido->save();

        return redirect()->route('pedidos.show', $pedido)->with('success', 'Ítem agregado al pedido.');
    }
    
    // ... show, edit, update, destroy con lógica anidada similar a DetalleCompraController ...
    public function destroy(Pedido $pedido, DetallePedido $detalle)
    {
        if ($detalle->pedido_id !== $pedido->id) {
            abort(404);
        }
        $detalle->delete();
        
        // Recalcular el subtotal del Pedido después de eliminar
        $pedido->subtotal = $pedido->detallesPedido()->sum('subtotal');
        $pedido->save();
        
        return redirect()->route('pedidos.show', $pedido)->with('success', 'Ítem eliminado del pedido.');
    }
}