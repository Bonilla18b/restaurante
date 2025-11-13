<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('proveedor')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('productos.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'nombre' => 'required|string|max:255',
            'unidadMedida' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'stockMinimo' => 'required|integer|min:0',
            'registradoPor' => 'nullable|string|max:100',
        ]);

        Producto::create($validated);
        return redirect()->route('productos.index')->with('success', 'Producto creado.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $proveedores = Proveedor::all();
        return view('productos.edit', compact('producto', 'proveedores'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'nombre' => 'required|string|max:255',
            'unidadMedida' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'stockMinimo' => 'required|integer|min:0',
        ]);

        $producto->update($validated);
        return redirect()->route('productos.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}