<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreCelular' => 'required|string|max:255',
            'email' => 'required|email|unique:proveedores,email|max:255',
            'documento' => 'required|string|unique:proveedores,documento|max:50',
            'registradoPor' => 'nullable|string|max:100',
        ]);

        Proveedor::create($validated);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado.');
    }

    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombreCelular' => 'required|string|max:255',
            'email' => 'required|email|unique:proveedores,email,' . $proveedor->id . '|max:255',
            'documento' => 'required|string|unique:proveedores,documento,' . $proveedor->id . '|max:50',
        ]);

        $proveedor->update($validated);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado.');
    }
}   