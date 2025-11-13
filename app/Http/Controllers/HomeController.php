<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio o el dashboard de la aplicación.
     */
    public function index()
    {
        // En una aplicación de restaurante, podrías cargar aquí datos resumidos,
        // como pedidos pendientes, stock bajo o un gráfico de ventas del día.
        
        // return view('home'); // Si quieres una vista estática
        
        // Si quieres un dashboard que cargue datos:
        /*
        $pedidosPendientes = \App\Models\Pedido::where('estado', 'Pendiente')->count();
        $productosBajoStock = \App\Models\Producto::whereColumn('stock', '<=', 'stockMinimo')->count();
        
        return view('dashboard', compact('pedidosPendientes', 'productosBajoStock'));
        */
        
        // Por ahora, usaremos una vista simple de bienvenida o dashboard
        return view('dashboard');
    }
}