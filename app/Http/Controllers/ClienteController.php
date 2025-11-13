<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('persona')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $personas = Persona::doesntHave('cliente')->get(); // Personas que aún no son clientes
        return view('clientes.create', compact('personas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'persona_id' => 'required|exists:personas,id|unique:clientes,persona_id',
            'direccion' => 'required|string|max:255',
            'registradoPor' => 'nullable|string|max:100', // Asumiendo que es el nombre del usuario logueado
        ]);

        Cliente::create($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $personas = Persona::all(); // En caso de que se necesite reasignar la persona
        return view('clientes.edit', compact('cliente', 'personas'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'direccion' => 'required|string|max:255',
        ]);

        $cliente->update($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }
}